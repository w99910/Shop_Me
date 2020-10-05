<div class="flex flex-col h-full px-1 sm:px-5 py-10 w-full sm:w-10/12">
    @if (session()->has('message'))

        <div class="bg-red-400 px-2 py-1 z-2 fixed w-1/4 right-0 top-0 flex justify-between items-center rounded-lg mx-2 my-2 shadow-xl"
             id="model-toast">
            <p class="text-xs"> {{ session('message') }}</p>
            <button onclick="document.getElementById('model-toast').style.display='none'"  class="px-3 py-2 focus:outline-none " id="button_click"><i class="fas fa-times"></i></button>

        </div>
        {{session()->forget('message')}}
    @endif
    <div class="flex justify-end items-center w-full">
        <input type="text" wire:model="search" placeholder="Search" class="border-b-2 border-gray-300 focus:outline-none"> </div>
<table class="flex w-full relative mb-10 flex-col">
    <thead>

        <tr class="w-full flex">
            <th class="px-4 py-2 w-2/12 sm:w-1/12 text-center">ID</th>
            <th class="px-4 py-2 w-3/12 text-center">Name</th>
            <th class="px-4 py-2 w-3/12 text-center">Email</th>
            <th class="px-4 py-2 tb-data w-2/12 text-center">Role</th>
              <th class="px-4 py-2 w-4/12 sm:w-3/12 text-center">Action</th>
        </tr>
    </thead>
    <tbody class="w-full">
        @foreach($users as $user)
            <tr class="w-full flex">
                <td class="border sm:px-4 sm:py-2 w-2/12 sm:w-1/12">{{$user->id}}</td>
                <td class="border sm:px-4 sm:py-2 w-3/12 ">{{$user->name}}</td>
                <td class="border sm:px-4 sm:py-2 w-3/12 truncate">{{$user->email}}</td>
                <td class="border sm:px-4 sm:py-2 tb-data w-2/12">{{$user->role}}</td>
                <td class="border sm:px-4 sm:py-2 w-4/12 sm:w-3/12 flex items-center flex-col ">
                    @if($user->id==$confirmid)
                        <p>Are You Sure?</p>
                        <div class="flex justify-center items-center">
                            <button wire:click="delete({{$user->id}})" class="border bg-orange-400 px-3 py-1 rounded-lg">Yes</button>
                            <button wire:click="unconfirm({{$user->id}})" class="border bg-orange-400 px-3 py-1 rounded-lg">No</button>
                        </div>
                    @else
                        <button wire:click="confirm({{$user->id}})" class="border bg-red-400 px-2 py-2 rounded-lg">Delete</button>
                    @endif
                </td>
            </tr>
        @endforeach
    <tr>{{$users->links()}}</tr>

    </tbody>
</table>
</div>
 @push('styles')
     <style>
         @media only screen and (max-width: 640px){
             .tb-data{
                 display: none;
             }
         }
     </style>
 @endpush
