<div id="nav-menu"
    class="hidden z-30 h-full w-full px-4 absolute bg-white top-0 md:static md:flex md:justify-center md:py-2">
    <div class="nav-item text-center my-14 md:px-10 md:my-1">
        <a href="{{route('home')}}" class="text-black">Home</a>
    </div>
    <div class="nav-item text-center my-14 md:px-10 md:my-1">
        <a href="{{route('product')}}" class="text-black">Product</a>
    </div>
    <div class="nav-item text-center my-14 md:px-10 md:my-1">
        <a href="{{route('about')}}" class="text-black">About Us</a>
    </div>
    <div class="nav-item text-center my-14 md:px-10 md:my-1">
        <a href="{{route('contact')}}" class="text-black">Contact Us</a>
    </div>
    <div class="nav-item text-center my-14 md:px-10 md:my-1 md:hidden">
        @guest
        <button class="bg-primary px-3 py-1 rounded-lg text-white">
            Login/Sign Up
        </button>
        @endguest

        @auth
        <div class="flex w-full text-white">
            <a href="{{route('dashboard')}}" class="w-full bg-secondary block py-2">Dashboard</a>
            <a href="{{route('logout')}}" class="w-full bg-primary block py-2">Logout</a>
        </div>
        @endauth
    </div>
</div>
