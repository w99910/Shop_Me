<?php

namespace App\Http\Livewire;

use App\Favourite;
use App\Revenue;
use Auth;
use Hash;
use Illuminate\Support\Facades\Storage;
use Laravolt\Avatar\Avatar;
use Livewire\Component;

class UserProfile extends Component
{
    public $invoices;
    public $user;
    protected function getListeners(){
        return [
          'changeName'=>'changeName',
          'changeEmail'=>'changeEmail',
          'changePassword'=>'changePassword',
          'changeImage'=>'changeImage',
        ];
}
    public function render()
    {
        return view('livewire.user-profile');
    }
    public function deleteFav($id){
        $fav=Favourite::find($id);
        $fav->delete();
    }
    public function mount(){
        $this->user=Auth::user();
        $this->invoices=$this->user->invoices;

    }
    public function changeName($name){
        $user=Auth::user();
        $user->name=$name;
        $user->save();
        $this->user=$user;
        $this->emit('message_change',['success','Name successfully changed']);


    }
    public function changeEmail($email){
        $user=Auth::user();
        $user->email=$email;
        $user->save();
        $this->user=$user;
        $this->emit('message_change',['success','Email successfully changed']);

    }
    public function changePassword($password){
        $user=Auth::user();
        if(Hash::check($password[0],$user->password)){

            $user->password=bcrypt($password[1]);
            $user->save();
           $this->emit('message_change',['success','Successfully Changed']);
        }
        else {
            $this->emit('message_change',['error','Incorrect old password']);
        }

    }
    public function changeImage($image){
        $user=auth()->user();
        if ($user->checkHasImage()){
            $filename= 'user'.$user->id;
            $dir = '/';
            $recursive = false; // Get subdirectories also?
            $contents = collect(Storage::cloud()->listContents($dir, $recursive));
            $file = $contents
                ->where('type', '=', 'file')
                ->where('filename', '=', pathinfo('user'.$user->id, PATHINFO_FILENAME))
                ->where('extension', '=', pathinfo('user'.$user->id, PATHINFO_EXTENSION))
                ->first();
            Storage::cloud()->delete($file['path']);
        }

            $ex=explode(',', $image);
            $decoded=base64_decode($ex[1]);
            Storage::disk('google')->put('user'.$user->id,$decoded);
            $dir = '/';
            $recursive = false; // Get subdirectories also?
            $contents = collect(Storage::cloud()->listContents($dir, $recursive));
            $file = $contents
                ->where('type', '=', 'file')
                ->where('filename', '=', pathinfo('user'.$user->id, PATHINFO_FILENAME))
                ->where('extension', '=', pathinfo('user'.$user->id, PATHINFO_EXTENSION))
                ->first(); // there can be duplicate file names!
            //return $contents->where('type', '=', 'dir'); // directories
            $service = Storage::cloud()->getAdapter()->getService();
            $permission = new \Google_Service_Drive_Permission();
            $permission->setRole('reader');
            $permission->setType('anyone');
            $permission->setAllowFileDiscovery(false);
            $permissions = $service->permissions->create($file['basename'], $permission);

            $url=Storage::cloud()->url($file['path']);

            $user->profile_url=$url;
            $user->save();
            $this->user=$user;
            $this->emit('message_change',['success','Profile successfully changed']);


    }
    public function delete(){
        $user=auth()->user();
        if ($user->checkHasImage()){
            $filename= 'user'.$user->id;
            $dir = '/';
            $recursive = false; // Get subdirectories also?
            $contents = collect(Storage::cloud()->listContents($dir, $recursive));
            $file = $contents
                ->where('type', '=', 'file')
                ->where('filename', '=', pathinfo('user'.$user->id, PATHINFO_FILENAME))
                ->where('extension', '=', pathinfo('user'.$user->id, PATHINFO_EXTENSION))
                ->first();
            Storage::cloud()->delete($file['path']);
        }
        $user->profile_url=null;
        $user->save();
        $this->user=$user;
        $this->emit('message_change',['success','Profile successfully deleted']);

    }


}
