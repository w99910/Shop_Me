<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'E-Commerce') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/customcss/customcss.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
    @livewireStyles
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
</head>
<body class=" font-poppins h-0 max-h-screen min-h-screen overflow-hidden bg-redme antialiased "  >
@auth
    <div class="flex" x-data="mycomponent()">
        <div class="absolute top-0 right-0 mr-3 mt-3 px-5 py-3 bg-redme rounded-full block sm:hidden z-100" x-on:click="toggle">
            <i class="fa fa-bars"></i>
        </div>
        <header id="header" class="absolute top-0 z-50 sm:z-0 w-full transform -translate-y-full sm:translate-y-0 sm:relative flex bg-redme sm:bg-transparent flex-col justify-between items-center sm:mt-1 mb-1 sm:ml-1 text-white sm:w-2/12" >
{{--            <img src="{{url('storage/product.gaming_room.png')}}" class="inline object-cover w-12 h-12 rounded-full object-center visible self-end mt-5" alt="image1" >--}}

            <div class="flex h-full flex-col mt-3 ml-0 px-3 nav justify-between items-center">
                <h2 class="font-handwrite text-3xl">ShopMe</h2>
                <nav class="flex flex-col">

                    <ul class="text-md sm:text-lg">
                        <li class="flex items-center justify-start py-5 cursor-pointer border-b border-transparent hover:border-indigo-700" x-on:click="window.livewire.emit('home')"><img src="{{asset('images/browser.png')}}" alt="image" class="w-0 sm:w-2/12 h-auto  mr-3"/><p>Home</p> </li>
                        <li class="flex items-center justify-start py-5 cursor-pointer border-b border-transparent hover:border-indigo-700" x-on:click="window.livewire.emit('new')"><img src="{{asset('images/new.png')}}" alt="image" class="w-0 sm:w-2/12 h-auto  mr-3"/> Newest</li>
                        <li class="flex items-center justify-start py-5 cursor-pointer border-b border-transparent hover:border-indigo-700"><img src="{{asset('images/fire.png')}}" alt="image" class="sm:w-2/12 h-auto mr-3 w-0"/>Best Sellers </li>
                        <li class="flex items-center justify-start py-5 cursor-pointer border-b border-transparent hover:border-indigo-700" x-on:click="window.livewire.emit('discount')"><img src="{{asset('images/sale.png')}}" alt="image" class="w-0 sm:w-2/12 h-auto mr-3"/>Discount </li>
                    </ul>
                </nav>
                <form id="logout-form" action="{{ route('custom_logout') }}" method="POST" class=" flex items-center justify-start  pointer-cursor sm:py-5 bg-logout py-1 px-3 sm:px-10 rounded-br-custom_bg rounded-lg mb-3">
                    @csrf
                    <i class="fas fa-sign-out-alt pr-2"></i>
                    <button type="submit" class="focus:outline-none">Logout</button>
                </form>
            </div>

        </header>
        <div  class="h-screen bg-transparent flex justify-center items-center w-full py-2 px-1">
        <div class="w-full bg-soft_pink rounded-custom items-center flex justify-center h-full">
            @yield('content')

        </div>
        </div>
    </div>
@endauth

@livewireScripts
@include('sweetalert::alert')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/ScrollTrigger.min.js"></script>
<script>
    const tl=gsap.timeline({defaults:{ease:'power1.out'}})
    const mycomponent=function(){
              return {
                  isTrue:false,
                  toggle() {
                     if(this.isTrue){
                         console.log(this.isTrue)
                         tl.to('#header',{y:'0%',duration:0.5})

                     }
                      else {
                          tl.to('#header',{y:'-100%',duration:0.5})
                     }
                      this.isTrue = !this.isTrue;
                  }
              }
           }
   </script>
</body>
</html>
