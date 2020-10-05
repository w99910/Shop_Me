<div class="w-full h-full" x-data="{password:'',confirm:''}">
    <div class="bg-white w-full rounded-lg h-full flex items-center justify-center">
        <form class="flex flex-col w-10/12 sm:w-6/12 bg-soft_pink p-2">
            <span class="px-2 py-2 bg-yellow-300 flex items-center"><i class="fas fa-exclamation-circle text-xl mx-4"></i>Please set your new Password</span>
            <div class="flex flex-col w-full">
                <input x-model="password" class="focus:outline-none border focus:border-blue-500 my-5 px-3 py-1 rounded-xl w-full" wire:model="password" type="text" placeholder="New Password">
                @error('password')
                <span class="text-red-600">{{$message}}</span>
                @enderror
            </div>
            <div class="flex flex-col w-full">
                <input x-model="confirm" class="focus:outline-none border focus:border-blue-500 mb-5 px-3 py-1 rounded-xl w-full" wire:model="confirm_password" type="text"  placeholder="Confirm Password">
                @error('confirm_password')
                <span class="text-red-600">{{$message}}</span>
                @enderror
            </div>
            <button class="px-2 py-1 focus:outline-none" wire:click="login" :class="password.trim()==='' || confirm.trim()==='' || password !== confirm || password.length<7 ?'bg-red-500':'bg-green-400'" x-bind:disabled="password.trim()==='' || confirm.trim()==='' || password !== confirm || password.length<7">Login</button>
        </form>
    </div>
</div>
