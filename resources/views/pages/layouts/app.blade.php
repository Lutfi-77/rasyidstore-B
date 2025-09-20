<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Home')</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('css')
</head>

<body>
    {{-- First Navbar --}}
    <nav class="md:fixed w-full z-10 bg-white top-0">
        <div class="container mx-auto py-1 px-7">
            <div class="w-full flex justify-between items-center py-3">
                <img src="{{asset('assets/logo/logo.png')}}" class="w-16">
                <div class="text-slate-400 relative w-1/2 hidden lg:block md:block">
                    <span class="absolute inset-y-0 left-0 pl-2 flex items-center">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="search" name="q" class="w-full bg-input rounded-lg py-1 focus:outline-none pl-10 pr-2"
                        placeholder="search..." autocomplete="off">
                </div>

                <div class="flex items-center px-4 z-40 md:hidden">
                    <button id="burgerButton">
                        <span class="hamburger transition duration-300 ease-in-out origin-top-left"></span>
                        <span class="hamburger duration-300 ease-in-out"></span>
                        <span class="hamburger duration-300 ease-in-out origin-bottom-left"></span>
                    </button>
                </div>

                <div class="items-center hidden md:flex">

                    <a href="{{route('cart.index')}}" class="text-primary text-2xl mr-7">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor"
                            class="bi bi-cart" viewBox="0 0 16 16">
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg>
                    </a>

                    @guest
                    <a href="{{route('login')}}" class="bg-primary px-8 py-1 rounded-lg text-white">
                        Login
                    </a>
                    @endguest

                    @auth
                    <div class="text-slate-300 relative">
                        <div class="navbar_dropdown flex items-center cursor-pointer">
                            <img src="https://avatars.dicebear.com/api/human/123.svg" alt="avatar"
                                class="w-8 h-8 rounded-full">
                            <h3 class="ml-2">{{Auth::user()->fullname}}</h3>
                        </div>

                        <div class="bg-white border border-slate-200 text-black flex flex-col absolute top-10 w-52 -left-10 rounded px-5 py-1 hidden"
                            id="navbar_dropdown_menu">
                            <a href="{{route('dashboard')}}" class="my-2">Dashboard</a>
                            <hr>
                            <a href="{{route('logout')}}" class="my-2">Logout</a>
                        </div>
                    </div>
                    @endauth

                </div>
            </div>
        </div>
        {{-- End of First Navbar --}}

        {{-- Second Navbar --}}
        @include('pages.layouts.menu')
    </nav>
    {{-- End of Second Navbar --}}

    @yield('content')

    @include('pages.layouts.footer')
    @stack('scripts')
    <script src="{{asset('js/pages/script.js')}}"></script>
    <script>
        const navbar_dropdown = document.querySelector(".navbar_dropdown");
        const navbar_dropdown_menu = document.querySelector("#navbar_dropdown_menu");
        
        if(navbar_dropdown != null){
            navbar_dropdown.addEventListener("click", function () {
                navbar_dropdown_menu.classList.toggle("hidden");
            });
        }
    </script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function () {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/62937ce67b967b117991d173/1g481vpq3';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();

    </script>
    <!--End of Tawk.to Script-->
    
</body>

</html>
