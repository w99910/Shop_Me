<div class="flex h-full flex bg-redme shadow-lg px-2 py-1">
   <div class="flex flex-col overflow-x-auto bg-white overflow-y-hidden px-2">
       @foreach($users as $user)
           <span class="px-5 py-1 text-center my-2 block cursor-pointer {{$selected===$user->id?'bg-alert':'bg-blue-400'}}" wire:click="showMessage({{$user->id}})">{{$user->name}}</span>
       @endforeach
   </div>
    <div class="w-full h-full flex flex-col justify-between relative shadow-lg">
            <div class="w-full overflow-y-auto overflow-x-hidden px-3">
                @if($selected = !null)
               <ul class="flex flex-col inline-block">
                   @foreach($messages as $message)
                       <li class="inline-block relative my-3 {{$message->from==auth()->id()?'text-right ':'text-left'}}">
                                <span class="{{$message->from==auth()->id()?'px-2 py-1 bg-dribbble rounded-xl':'rounded-xl px-2 py-1 bg-alert'}}"> {{$message->message}}
                                </span>
                           <span class="text-xs text-gray-600 -mb-5 bottom-0 {{$message->from==auth()->id()?'right-0':'left-0'}}">{{$message->time}}</span>
                       </li>
                   @endforeach
               </ul>
               @endif
            </div>
                    <div class="flex justify-around items-center">
                        <input wire:model="text" placeholder="Type Here" class="focus:border-blue-500 border w-8/12 border-3 border-transparent focus:outline-none px-2 py-1 bg-gray-300" type="text"/>
                        @if($selected = !null)
                            <button class="px-2 py-1 bg-blue-400 mx-1 sm:mx-2" wire:click="sendMessage">Send</button>
                        @else
                            <button class="cursor-not-allowed" disabled>Send</button>
                        @endif
                    </div>
    </div>

</div>

