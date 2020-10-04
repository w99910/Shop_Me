<div class="flex flex-col h-full px-2 sm:px-5 py-10 w-full" x-data="{isOpen:false}" x-data>
    @if (session()->has('message'))
        <div class="bg-red-400 px-2 py-1 z-100 fixed w-full sm:w-1/4 right-0 top-0 flex justify-between items-center rounded-lg mx-2 my-2 shadow-xl" id="model-toast1">
            <p class="text-xs"> {{ session('message') }}</p>
            <button onclick="document.getElementById('model-toast1').style.display='none'"  class="px-3 py-2 focus:outline-none " id="button_click"><i class="fas fa-times"></i></button>
        </div>
        {{session()->forget('message')}}
    @elseif(session()->has('toast'))
        <div class="bg-green-400 px-2 py-1 z-100 fixed w-full sm:w-1/4 right-0 top-0 flex justify-between items-center rounded-lg mx-2 my-2 shadow-xl" id="model-toast2">
            <p class="text-xs"> {{ session('toast') }}</p>
            <button onclick="document.getElementById('model-toast2').style.display='none'"  class="px-3 py-2 focus:outline-none " id="button_click"><i class="fas fa-times"></i></button>
        </div>
        {{session()->forget('toast')}}
    @endif
    <div class="flex justify-between items-center">
      <div class="flex flex-col sm:flex-row w-full sm:justify-between">
          <div class="flex w-full sm:w-auto justify-between my-4 sm:my-0">
        <button wire:click="$emit('createpost')" class="px-2 py-1 sm:px-3 sm:py-2 bg-green-500 rounded-lg sm:rounded-custom text-white focus:outline-none sm:mx-2">Create Product</button>
           <a href="{{route('product_export')}}"class="px-2 py-1 sm:px-3 sm:py-2 bg-yellow-500 rounded-lg sm:rounded-custom text-white focus:outline-none" >Export</a>
       </div>
           <input type="text" wire:model="search" placeholder="Search by Name" class="border-b-2 border-gray-300 focus:outline-none">  </div>
    </div>
     <div class="w-full h-full mt-2">
        <table class="w-full flex flex-wrap">
    <thead class="flex w-full">
    <tr class="flex w-full">
        <th class="px-1 py-2 w-1/12 tb-data  text-center" >ID</th>
        <th class="px-1 sm:px-4 py-2  w-2/12 text-center" >Name</th>
        <th class="px-1 sm:px-4 py-2 w-2/12  sm:w-1/12 text-center" >Price</th>
        <th class="px-1 sm:px-4 py-2 w-1/12 sm:w-2/12 truncate tb-data text-center" >Quantity</th>
        <th class="px-1 sm:px-4 py-2 w-3/12 truncate tb-data text-center" >Image_Path</th>
        <th class="px-1 sm:px-4 py-2 w-4/12 sm:w-3/12 sm:w-auto truncate text-center" >Discount</th>
        <th class="px-1 sm:px-4 py-2 w-3/12  text-center" >Action</th>
    </tr>
    </thead>
    <tbody class="flex flex-col w-full mt-4">
    @foreach($products as $product)
        <tr class="flex w-full">
            <td class="border px-1 py-2  sm:w-1/12 text-center h-16 tb-data">{{$product->id}}</td>
            <td class="border px-1 py-2 w-2/12 overflow-auto text-center  h-16">{{$product->name}}</td>
            <td class="border px-1 py-2 w-2/12 sm:w-1/12 text-center h-16">{{$product->price}}</td>
{{--            <td class="border px-1 py-2 truncate w-2/12 text-center h-16">{!! $product->available?'<span class="text-green-300">Available</span>':'<span class="text-red-300" >Not Available</span>'!!}</td>--}}
            <td class="border px-1 py-2 w-1/12 sm:w-2/12 text-center h-16 tb-data">{{$product->quantity}}</td>
            <td class="border px-1 py-2 overflow-auto w-3/12 h-16 tb-data">{{$product->image_path ?? ''}}</td>
            <td class="border px-1 py-2 text-center h-16 flex flex-col sm:flex-row w-4/12 sm:w-3/12">
                <span class="sm:px-2 sm:py-1 bg-alert rounded-lg" >{{$product->discounts->first()->name?? 'No Discount'}}
            </span><button class="focus:outline-none text-red-400 text-sm sm:text-md {{$product->discounts->first() === null ?'hidden':''}}" wire:click="removeDiscount({{$product->id}})">Remove?</button></td>
            <td class="border px-1 py-2 flex  justify-center text-white h-16">
             <div class="flex items-center justify-center flex-col">
                 @if($product->id==$confirmid)
                   <div class="flex justify-center items-center">
                       <button wire:click="delete({{$product->id}})" class="border bg-orange-400 px-3 py-1 rounded-lg focus:outline-none">Yes</button>
                       <button wire:click="unconfirmed({{$product->id}})" class="border bg-orange-400 px-3 py-1 rounded-lg  focus:outline-none">No</button>
                   </div>
                       @else
                    <button wire:click="confirm({{$product->id}})" class="border bg-red-400 px-2 py-2 rounded-lg focus:outline-none">Delete</button>
                @endif
             </div>
               @if ($product->id !== $confirmid)
                  <div class="flex items-center justify-center"> <button x-on:click="{isOpen = !isOpen}" class="sm:px-4 bg-orange-500 rounded-lg px-2 py-2 focus:outline-none" wire:click="$emit('editform',{{$product->id}})"  >Edit</button>
                  </div>
               @endif
               </td>
        </tr>
    @endforeach
    <tr> <td>{{$products->links()}} </td></tr>
    </tbody>
</table>
     </div>
</div>
@push('scripts')
    <script>
        window.livewire.on('export',function(){
            axios.get('/export/product_excel').then(resp=>{

            })
        })
    </script>
@endpush
@push('styles')
        <style>
            @media only screen and (max-width: 640px){
                .tb-data{
                    display: none;
                }
            }
        </style>
    @endpush


