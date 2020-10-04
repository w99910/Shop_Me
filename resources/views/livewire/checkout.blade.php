
<div class="w-full justify-between flex flex-col  sm:w-8/12 md:w-8/12 lg:w-8/12 h-full items-center mt-4 sm:mt-0 sm:ml-4 bg-redme rounded sm:rounded-custom  p-1" x-data="{isMessage:false}">
  <div class="w-full justify-between flex flex-col h-full items-center bg-white rounded-custom">
    <table class="table-fixed w-full relative inline-block overflow-y-auto custom_scrollbar overflow-x-hidden">
        <thead>
        <tr>
            <th class="px-1 py-2"></th>
            <th class="px-1 py-2">Item Name</th>
            <th class="px-1 py-2">Quantity</th>
            <th class="px-1 py-2 ">Price</th>
            <th class="px-1 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if (!empty($carts))
            @foreach($carts as $cart)

                <tr>
                    <td class="border px-4 py-2 w-3/12"><img src="{{url($cart->product->image_path)}}" class="object-center object-cover"/></td>
                    <td class="border px-4 py-2">{{$cart->product->name}}</td>
                    <td class="border px-4 py-2"><button class="p-2  mx-2 bg-white rounded-lg focus:outline-none" wire:click="increment({{$cart->id}})">+</button>{{$cart->quantity}}
                        <button class="p-2 mx-2 bg-white rounded-lg focus:outline-none" wire:click="decrement({{$cart->id}})">-</button></td>
                    <td class="border px-4 py-2">{{$cart->price * $cart->quantity}} $</td>
                    <td class="border px-4 py-2"><button class="px-2 py-1 bg-red-600 focus:outline-none"  wire:click="deleteCart({{$cart->id}})"><i class="fas fa-times"></i></button></td>

            @endforeach
        @endif
        @if (auth()->user()->carts->count()==0)
            <tr class="w-full">
                <td>There is no product in your cart</td></tr>
        @endif

        </tbody>
    </table>
    <div class="flex w-full justify-around mt-1 bg-semi rounded-none sm:rounded-b-custom py-1 border-none text-white">
        <span>OrderTotal</span>
        <span>{{$total_price}} $</span>
    </div>
    <div class="fixed bottom-0 right-0 flex flex-col z-100" :class="{'h-5/7 w-11/12 sm:w-4/12':isMessage}" @click.away="isMessage = false">
        <div class="h-full w-full pr-10 pb-12" x-show="isMessage" :class="{'hidden':!isMessage}" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 origin-bottom-right transform  scale-0" x-transition:enter-end="opacity-100 origin-bottom-right transform scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 origin-bottom-right transform scale-100" x-transition:leave-end="opacity-0 origin-bottom-right transform scale-0">
            <div class="h-full w-full bg-white relative flex flex-col justify-between rounded-xl border border-4 border-green-400 px-2 py-2">
                <div class="h-full w-full overflow-hidden overflow-y-auto message_scrollbar">
                    <ul class="flex flex-col">
                        @foreach($messages as $message)
                            <li class="inline-block relative my-3 {{$message->from==auth()->id()?'text-right ':'text-left'}}">
                                <span class="{{$message->from==auth()->id()?'px-2 py-1 bg-dribbble rounded-xl':'rounded-xl px-2 py-1 bg-alert'}}"> {{$message->message}}
                                </span>
                                <span class="text-xs text-gray-600 -mb-5 bottom-0 {{$message->from==auth()->id()?'right-0':'left-0'}}">{{$message->time}}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="flex items-center justify-start w-full px-1 sm:px-2">
                    <input wire:model="text" class=" w-full focus:border-blue-500 sm:w-10/12 border border-3 border-transparent focus:outline-none px-1 sm:px-2 sm:py-1 bg-gray-300" type="text"/>
                    <button class="px-2 py-1 bg-blue-400 mx-1 sm:mx-2" wire:click="sendMessage">Send</button>
                </div>
            </div>


        </div>
        <button x-on:click="isMessage = !isMessage" class="p-3 rounded-full bg-white focus:outline-none absolute bottom-0 right-0"><i class="origin-center far fa-comment-alt fa-2x text-blue-600" x-show="!isMessage" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-100 origin-center transform rotate-0" x-transition:enter-end="opacity-0 origin-center transform rotate-90" ></i><i class="far fa-times-circle fa-2x text-red-500" x-show="isMessage" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-100 origin-center transform rotate-0" x-transition:enter-end="opacity-0 origin-center transform rotate-90" ></i></button>
    </div>
  </div>
</div>


