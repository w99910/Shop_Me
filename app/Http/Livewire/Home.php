<?php

namespace App\Http\Livewire;

use App\Cart;
use App\Category;
use App\Favourite;
use App\Product;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

class Home extends Component
{
    public $carts=[];
    public $select;
    public $products;
    public $search;
    public $text;
    public $messages=[];

    public function getListeners()
    {
        return [
            "echo-private:message,.message-event.".auth()->id() => 'updateMessage',
            'new'=>'newest',
            'discount'=>'discount','home'=>'home'
        ];
    }
    public function favourite($id){
        $favourite=Favourite::where('user_id',auth()->id())->where('product_id',$id)->first();
        if ($favourite === null)
        {
            Favourite::create(['user_id'=>auth()->id(),'product_id'=>$id]);
        }
        else {
            $favourite->delete();
            $this->products=Product::all();
        }

    }
    public function updateMessage($message){

        $this->messages=\App\Message::where('from',auth()->id())->orWhere('to',auth()->id())->get();
    }
    public function sendMessage(){
        $id=auth()->id();
        if($this->text==''){
            return null;
        }
        else {
            $send_message = \App\Message::create(['from' => $id, 'to' => 2, 'message' => $this->text]);
            broadcast(new \App\Events\Message($send_message));
            $this->messages = \App\Message::where('from', auth()->id())->orWhere('to', auth()->id())->get();

            $this->text = '';
        }
    }
    public function updatedSearch(){
       $products=Product::where('name', 'like', '%'.$this->search.'%')->get();
       $this->products=$products;
       $this->emit('refresh');
    }
//    protected $listeners=['new'=>'newest','discount'=>'discount','home'=>'home'];

    public function home(){
        $this->products=Product::all();
        $this->emit('refresh');
    }
    public function purchase_page($id){
        return redirect('/purchase/'.$id);
    }
    public function deleteCart($id){
        $user=auth()->user();
        $selectedcart=Cart::find($id);
        $selectedcart->delete();
        $this->carts=$user->carts;
    }
    public function newest(){
        $products=Product::whereHas('categories',function(Builder $query){
            $query->where('name','like','%'.$this->select.'%');
        })->get();
        $now=Carbon::today()->subDays(5);
        $this->products=$products->intersect(Product::where('created_at','>=',$now)->get());
        return redirect()->back();
    }
    public function updatedSelect(){
        $this->products=Product::whereHas('categories',function(Builder $query){
           $query->where('name','like','%'.$this->select.'%');
        })->get();
    }
    public function render()
    {
        return view('livewire.home',[
            'categories'=>Category::all(),
        ]);
    }
    public function mount(){
        $this->products=Product::all();
        $user = auth()->user();
        $carts=$user->carts;
        $this->carts=$carts;
        $this->messages=\App\Message::where('from',auth()->id())->orWhere('to',auth()->id())->get();


    }
    public function discount(){
        $this->products=Product::has('discounts')->get();
        $this->emit('refresh');
    }
    public function clearFilter(){
        $this->products=Product::all();
    }

}
