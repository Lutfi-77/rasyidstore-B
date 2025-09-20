@extends('pages.layouts.app')

@section('title', 'Our Product')
@section('css')
<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
@endsection
@section('content')
<section class="md:mt-32 bg-container">
    @if (request()->has('c'))
    <div class='w-full h-32 md:h-56 bg-no-repeat object-cover bg-cover relative after:content after:w-full after:h-full after:bg-overlay after:block after:top-0 after:absolute'
        style="background: url({{$ProductBycategories->first() ? asset('storage/'.$ProductBycategories->first()->category->banner) : ''}})">
        <div class="container mx-auto h-full relative">
            <h3 class="font-semibold text-lg md:text-4xl text-white absolute top-1/2 z-10">
                {{$ProductBycategories->first() ? request()->c : 'Product Not Found'}}</h3>
        </div>
    </div>
    @else
    <div class="container mx-auto">
        <div class="swiper mySwiper w-full py-10 px-5">
            <div class="swiper-wrapper">
                @foreach ($newArrival as $newArrivalSlider)
                <div class="swiper-slide">
                    <div class="flex flex-wrap w-full">
                        <div class="w-full self-center md:w-1/2">
                            <img src="{{asset('storage/'.$newArrivalSlider->medias[0]->file_path)}}"
                                alt="best Seller" class="w-full">
                        </div>
                        <div class="w-full self-end md:w-1/2 my-auto">
                            <h3 class="text-2xl mb-5">{{$newArrivalSlider->title}}</h3>
                            <div class="text-lg mb-5">
                                {{$newArrivalSlider->desc}}
                            </div>
                            <a href="{{route('product.detail', $newArrivalSlider->id)}}" class="bg-primary px-10 py-1 rounded-lg">Detail</a>
                        </div>
                    </div>
                    <div class="flex"></div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
        @endif
    </div>
</section>

<section class="w-full mt-10">
    <div class="container mx-auto flex flex-wrap md:flex-nowrap md:flex-row justify-center px-0 lg:px-7 ">
        <div class="mr-3 w-full md:w-[150px] mx-3 md:mx-0 order-2 md:-order-none mt-5 md:mt-0">
            <div class="dropdown inline-block relative w-full">
                <button
                    class="bg-primary text-white font-semibold py-2 px-4 rounded inline-flex items-center justify-center w-full">
                    <span class="mr-1">Category</span>
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /> </svg>
                </button>
                <ul class="dropdown-menu absolute hidden text-gray-700 pt-1 overflow-y-scroll text-center h-32">
                    <li>
                        <a href="{{route('product')}}"
                            class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap">All</a>
                    </li>
                    @foreach ($categories as $item)
                    <li>
                        <a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                            href="{{request()->fullUrlWithQuery(['c' => $item->title])}}">{{$item->title}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
        <div class="text-slate-400 ml-2 relative w-full flex justify-center">
            <form action="{{request()->fullUrlWithQuery(array_merge(request()->query(), ['c' => request()->c]))}}"
                class="w-full">
                {{-- @csrf --}}
                <input type="search"
                    class="w-full mx-3 md:mx-0 bg-white rounded-lg py-1 focus:outline-none pl-10 pr-2 border border-input"
                    placeholder="Search..." name="q">
                <span class="absolute inset-y-0 left-0 pl-5 md:pl-2 flex items-center">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </span>
            </form>
        </div>
    </div>
</section>

<section class="container mx-auto mt-11">
    @if (request()->get('q') || request()->get('c'))
    <div class="grid grid-cols-2 md:grid-cols-3 mb-11">
        @foreach ($ProductBycategories as $prod)
        <div class="w-full">
            <img src="{{asset('storage/'.$prod->medias[0]->file_path)}}"
                alt="product" class="w-full object-cover p-10">
            <h4 class="font-semibold text-center">{{$prod->title}}</h4>
            <h5 class="text-center text-sm text-slate-600">Rp. {{number_format($prod->variants[0]->price, 2, ",", ".")}}
            </h5>
            <div class="flex mt-3">
                <a href="{{route('product.detail', $prod->id)}}"
                    class="mx-auto bg-primary px-10 py-1 text-white rounded-lg">
                    See Detail
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    @foreach ($ProductBycategories as $product)
    <h3
        class="text-2xl font-semibold text-black text-center pt-5 pb-5 after:content-[''] after:block after:w-24 after:h-1 after:bg-primary after:mx-auto after:mt-2">
        {{$product->title}}</h3>

    <div class="grid grid-cols-2 md:grid-cols-3 mb-11">
        @foreach ($product->products as $item)
        <div class="w-full">
            <img src="{{asset('storage/'.$item->medias[0]->file_path)}}"
                alt="product" class="w-full object-cover p-10">
            <h4 class="font-semibold text-center">{{$item->title}}</h4>
            <h5 class="text-center text-sm text-slate-600">Rp. {{number_format($item->variants[0]->price, 2, ",", ".")}}
            </h5>
            <div class="flex mt-3">
                <a href="{{route('product.detail', $item->id)}}"
                    class="mx-auto bg-primary px-10 py-1 text-white rounded-lg">
                    See Detail
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
    @endif
</section>
@endsection
@push('scripts')
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script>
    // Swipper js
var swiper = new Swiper(".mySwiper", {
    autoHeight: true,
    spaceBetween: 20,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});
</script>
<script>
    const dropdown = document.querySelector(".dropdown");
    const dropdownMenu = document.querySelector(".dropdown-menu");
    dropdown.addEventListener("click", function () {
        dropdownMenu.classList.toggle("hidden");
    });

</script>
@endpush
