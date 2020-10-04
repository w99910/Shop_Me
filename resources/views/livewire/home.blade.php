<div class="h-full w-full flex flex-col relative" x-data="my_component()">
    <div class="custom_filter fixed flex justify-around items-center sm:absolute bottom-0 left-0 w-full h-24 rounded-t-xl bg-redme z-120 transform translate-y-full text-white">
        <button class="focus:outline-none cursor-pointer flex justify-center items-center" wire:click="discount" x-on:click="toggleFilter"><img src="{{asset('images/sale.png')}}" alt="discount" class="w-8 h-8">Discount</button>
        <button class="focus:outline-none cursor-pointer flex justify-center items-center" wire:click="newest" x-on:click="toggleFilter"><img src="{{asset('images/new.png')}}" alt="new" class="w-8 h-8">Latest</button>
        <button class="focus:outline-none cursor-pointer flex justify-center items-center" wire:click="clearFilter" x-on:click="toggleFilter">Clear Filter</button>

    </div>
    <div class="flex flex-col px-5 py-5 justify-between items-center sm:flex-row ">
      <div class="flex">
          <div class="flex relative justify-center items-center">
        <input class="focus:outline-none border border-transparent focus:border-blue-300 px-4 py-1 rounded-custom w-full" wire:model="search" placeholder="Search by name">
           <i class="fas fa-search absolute right-0 mr-2 opacity-0 sm:opacity-50 " ></i>
       </div>

            <div class="flex mx-4 px-0 sm:px-2">
                <select wire:model="select" class="focus:outline-none px-0 sm:px-2 py-1 rounded-xl shadow-md">
                    <option value="">All</option>
                    @foreach($categories as $category)
                        <option value="{{$category->name}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

      </div>

        <div class="mt-3 sm:pr-5 flex sm:mt-0 justify-center items-center ">
            <span class="flex items-center justify-center cursor-pointer mr-3" x-on:click="toggleFilter">
              <img src="{{asset('images/filter.white.png')}}" alt="filter" class="w-6 h-6" x-on:click=" toggleFilter">
          </span>
            <span class="font-bold text-alert mr-2 tracking-wider">${{auth()->user()->total_charge}}.00</span>
            <div class="flex flex-col p-2 rounded-xl bg-white mr-3 pt-3" x-on:click="isDrop = !isDrop" x-on:click.away="isDrop = false" >

                <div class="flex cursor-pointer"> <i class="fas fa-shopping-cart"></i>
                    <span class="px-1  bg-orange-400 rounded-lg self-end text-xs">{{auth()->user()->carts->count()}}</span>
                </div>
                <div class="absolute w-56 bg-gray-600 right-0 mt-6 rounded-lg mr-4 px-2 py-1 text-white z-40 shadow-lg" x-show="isDrop">
                    @if (!empty($carts))
                        @foreach($carts as $cart)
                            <div class="block">
                                <div class="flex items-center justify-between">  <img src="{{url($cart->product->image_path)}}" class="object-center object-cover w-12 h-12" alt="{{$cart->product->name}}"/>
                                    {{$cart->product->name}}
                                    <button class="px-2 py-1 bg-red-500 rounded-lg" wire:click="deleteCart({{$cart->id}})"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @if (auth()->user()->carts->count()==0)
                            <div class="block"><p class="px-2 py-1">There is no product in your Cart</p></div>
                    @endif
                </div>
            </div>
            <div class="relative h-full mr-3 flex rounded">
                <img src="{{ auth()->user()->profile_url === null ? Avatar::create(auth()->user()->name)->toBase64() : auth()->user()->profile_url  }}" alt="{{auth()->user()->name}}" class=" rounded-full w-10 h-10" />
            </div>
        </div>
    </div>
    <div class="container flex flex-wrap overflow-auto  border-t-2 border-gray-100 px-2 custom_scrollbar rounded-custom">
        @foreach($products as $product)
            <div class="bg-transparent h-64 w-2/4 sm:w-1/3 md:w-1/4 lg:w-1/5 flex flex-col items-center  px-2 my-2 mt-4 mb-8 rounded-t-xl relative" >
                <div class="w-full rounded-t-lg flex flex-col items-end bg-white relative">
                    <img src="{{url($product->image_path)}}"  alt="{{$product->name}}" class="inline object-cover object-center"/>
                    @if(empty($product->discounts)!==null)
                        @foreach($product->discounts as $discount)
                            <div class="absolute top-0 right-0 sm:font-bold p-1 bg-alert sm:mx-1 rounded-lg text-xs sm:text-md">-{{$discount->name}}</div>
                        @endforeach
                    @endif
                </div>
                <div class="bg-semi w-full justify-start bg-white p-0 sm:p-2 rounded-lg text-white">
                    <div class="flex flex-col items-start sm:items-center justify-between sm:flex-row pl-2 sm:pl-0">
                        <div class="flex flex-col">
                            <p class="break-words">{{$product->name}}</p>
                            <p>{{$product->price}}$</p>
                        </div>

                        <div class="flex w-full justify-end px-2">
                            <button class="h-full rounded-lg p-1 sm:p-2 mx-2 focus:outline-none focus:border-blue-300 border shadow-inner z-40 bg-white" wire:click="favourite({{$product->id}})">
                                <i class="fas fa-heart text-md sm:text-md {{$product->is_favourite?'text-red-500':'text-black'}}"></i>
                            </button>
                            <button class="h-full rounded-lg p-1 sm:p-2 focus:outline-none focus:border-blue-300 border shadow-inner z-40 bg-white" wire:click="purchase_page({{$product->id}})">
                                <i class="fas fa-shopping-cart text-md sm:text-md text-orange-500"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
            @foreach($products as $product)
                <div class="bg-transparent h-64 w-2/4 sm:w-1/3 md:w-1/4 lg:w-1/5 flex flex-col items-center  px-2  mt-4 mb-8 rounded-t-xl relative" >
                    <div class="w-full rounded-t-lg flex flex-col items-end bg-white relative">
                        <img src="{{url($product->image_path)}}"  alt="{{$product->name}}" class="inline object-cover object-center"/>
                        @if(empty($product->discounts)!==null)
                            @foreach($product->discounts as $discount)
                                <div class="absolute top-0 right-0 sm:font-bold p-1 bg-alert sm:mx-1 rounded-lg text-xs sm:text-md">-{{$discount->name}}</div>
                            @endforeach
                        @endif
                    </div>
                    <div class="bg-semi w-full justify-start bg-white p-0 sm:p-2 rounded-lg text-white">
                        <div class="flex flex-col items-start sm:items-center justify-between sm:flex-row pl-2 sm:pl-0">
                            <div class="flex flex-col">
                                <p class="break-words">{{$product->name}}</p>
                                <p>{{$product->price}}$</p>
                            </div>

                            <div class="flex w-full justify-end px-2">
                                <button class="h-full rounded-lg p-1 sm:p-2 mx-2 focus:outline-none focus:border-blue-300 border shadow-inner z-40 bg-white" wire:click="favourite({{$product->id}})">
                                    <i class="fas fa-heart text-md sm:text-md {{$product->is_favourite?'text-red-500':'text-black'}}"></i>
                                </button>
                                <button class="h-full rounded-lg p-1 sm:p-2 focus:outline-none focus:border-blue-300 border shadow-inner z-40 bg-white" wire:click="purchase_page({{$product->id}})">
                                    <i class="fas fa-shopping-cart text-md sm:text-md text-orange-500"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
    <div class="fixed bottom-0 right-0 flex flex-col z-100" :class="{'h-5/7 w-11/12 sm:w-4/12':isMessage}" @click.away="isMessage = false">
        <div class="h-full w-full pr-10 pb-12" x-show="isMessage" :class="{'hidden':!isMessage}" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 origin-bottom-right transform  scale-0" x-transition:enter-end="opacity-100 origin-bottom-right transform scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 origin-bottom-right transform scale-100" x-transition:leave-end="opacity-0 origin-bottom-right transform scale-0">
            <div class="h-full w-full bg-white relative flex flex-col justify-between rounded-xl px-2 py-2 border border-4 border-redme">
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

@push('styles')
    <style>
        input#menu-toggle:checked ~ #menu {
            display: block;
        }
        @media only screen and (max-width: 640px) {
            div#menu{
                display: none;
            }
            div#png1{
                display:none;
            }
        }
        @media only screen and (min-width: 640px){
            /*.nav{*/
            /*    display: flex;*/

            /*}*/
            #header{
                transform:translateY(0) !important;
            }
        }
    </style>
    @endpush
    @push('scripts')
        <script>
            const tl2=gsap.timeline({defaults:{ease:'expo.out'}})
        const my_component=function(){
            return {
                isDrop:false,
                isMessage:false,
                isFilter:true,
                toggleFilter(){
                    if (this.isFilter){
                        tl2.to('.custom_filter',{y:'0%',duration:1})
                        this.isFilter=false;
                    }
                    else {
                      tl2.to('.custom_filter',{y:'100%',duration:1})
                        this.isFilter=true;
                    }

                }
            }
        }
        </script>
        @endpush
