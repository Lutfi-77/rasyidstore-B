@extends('pages.layouts.app')

@section('title', 'Home')
@section('css')
<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.14.1/css/ol.css"
    type="text/css">
@endsection
@section('content')

{{-- Slideshow --}}
<div class="md:mt-[6.5rem]">
    <div class="swiper mySwiper w-full">
        <div class="swiper-wrapper">
            @foreach ($banners as $item)
            <div class="swiper-slide">
                <img src="{{asset('storage/'.$item->get('path'))}}" alt="carousel" class="w-full object-cover">
            </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>
{{-- End Of Slideshow --}}

{{-- New Arrival --}}
<section>
    <div class="bg-container relative md:px-10 pb-24 pt-16">
        <h3 data-aos="fade-up"
            class="text-2xl font-semibold text-center mb-5 after:content-[''] after:block after:w-24 after:h-1 after:bg-primary after:mx-auto">
            New Arrivals</h3>

        <div class="grid grid-cols-1 gap-7 md:grid-cols-2 lg:grid-cols-3 md:gap-1">
            {{-- <a href="#" data-aos="fade-right" data-aos-delay="100"
                class="relative flex justify-center w-[300px] h-[350px] rounded-xl m-auto shadow-md overflow-hidden transform hover:scale-110 duration-200 md:mt-10">
                <img src="https://images.unsplash.com/photo-1521093470119-a3acdc43374a?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=350&ixid=MnwxfDB8MXxyYW5kb218MHx8c2hvZXN8fHx8fHwxNjUwMDAzNTM5&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=300"
                    alt="newArrival" class="w-full object-cover">
                <div
                    class="overlay absolute bg-overlay w-full h-full text-white flex justify-center transition ease-in-out duration-300 opacity-0 hover:opacity-[1]">
                    <h3
                        class="absolute text-lg bottom-4 font-semibold after:content after:block after:w-12 after:h-[2px] after:bg-primary after:mx-auto">
                        View Detail</h3>
                </div>
            </a>
            <a href="#" data-aos="fade-right" data-aos-delay="200"
                class="relative flex justify-center w-[300px] h-[350px] rounded-xl m-auto shadow-md overflow-hidden transform hover:scale-110 duration-200 md:mt-10">
                <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=350&ixid=MnwxfDB8MXxyYW5kb218MHx8c2hvZXN8fHx8fHwxNjUwMDA2NDQy&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=300"
                    alt="newArrival" class="w-full object-cover">
                <div
                    class="overlay absolute bg-overlay w-full h-full text-white flex justify-center transition ease-in-out duration-300 opacity-0 hover:opacity-[1]">
                    <h3
                        class="absolute text-lg bottom-4 font-semibold after:content after:block after:w-12 after:h-[2px] after:bg-primary after:mx-auto">
                        View Detail</h3>
                </div>
            </a> --}}
            @foreach ($products as $product)
            <a href="{{route("product.detail",$product->id)}}"
                class="relative flex justify-center w-[300px] h-[350px] rounded-xl m-auto shadow-md overflow-hidden transform hover:scale-110 duration-200 md:mt-10 bg-secondary">
                <img src="{{asset('storage/'.$product->medias[0]->file_path)}}" alt="newArrival"
                    class="w-full object-cover">
                <div
                    class="overlay absolute bg-overlay w-full h-full text-white flex justify-center transition ease-in-out duration-300 opacity-0 hover:opacity-[1]">
                    <h3
                        class="absolute text-lg bottom-4 font-semibold after:content after:block after:w-12 after:h-[2px] after:bg-primary after:mx-auto">
                        View Detail</h3>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
{{-- End Of New Arrival --}}

{{-- Best Seller --}}
<section class="bg-secondary pb-24 pt-16">
    <div class="container mx-auto">
        <h3 data-aos="fade-down"
            class="text-2xl font-semibold text-gray-100 text-center pt-5 pb-5 after:content-[''] after:block after:w-24 after:h-1 after:bg-primary after:mx-auto after:mt-2">
            Best Seller
        </h3>
        <div class="flex flex-wrap w-full px-5">
            <div data-aos="fade-right" class="w-full self-center md:w-1/2">
                <img src="https://i.shgcdn.com/57b85c8d-aa3f-416c-b6e5-bb110620e924/-/format/auto/-/preview/3000x3000/-/quality/lighter/"
                    alt="Best seller" class="w-full">
            </div>
            <div data-aos="fade-left" data-aos-duration="900" class="w-full self-end md:w-1/2 my-auto text-white">
                <h3 class="text-2xl mb-5">Nike Air Max 90 SE</h3>
                <div class="text-lg mb-5">
                    Max Air changed the game in '87. Now, we honour its emerald anniversary (35 years!) with the Nike
                    Air Max 90 SE. Emerald graphics and colours highlight this big landmark, while its classic Waffle
                    outsole and exposed Air cushioning keep you living the legacy in comfort.
                </div>
                <a href="#" class="bg-primary px-10 py-1 rounded-lg">Detail</a>
            </div>
        </div>
    </div>
</section>
{{-- End of Best Seller --}}

{{-- Category --}}
<section class="mt-11">
    <div class="grid grid-cols-2 md:grid-cols-6 md:grid-rows-2 md:gap-x-6 md:gap-y-3 gap-2">
        <div data-aos="fade-down" data-aos-duration="700" class="w-full md:col-span-3 md:h-[400px] relative">
            <img src="https://images.unsplash.com/photo-1605034313761-73ea4a0cfbf3?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&ixid=MnwxfDB8MXxyYW5kb218MHx8c2hvZXN8fHx8fHwxNjUwMDMwOTg2&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=700"
                alt="category" class="w-full md:h-full object-cover">
            <div
                class="absolute bg-overlay top-0 w-full h-full text-white flex justify-center transition ease-in-out duration-300 opacity-0 hover:opacity-[1]">
                <a href="#"
                    class="my-auto text-2xl border-2 border-primary px-5 py-2 hover:bg-primary transition duration-200">Sneakers</a>
            </div>
        </div>
        <div data-aos="fade-down" data-aos-duration="700" class="w-full md:col-span-3 md:h-[400px] relative">
            <img src="https://images.unsplash.com/photo-1603191659812-ee978eeeef76?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&ixid=MnwxfDB8MXxyYW5kb218MHx8c2hvZXN8fHx8fHwxNjUwMDQ2NDY1&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=700"
                alt="category" class="w-full md:h-full object-cover">
            <div
                class="absolute bg-overlay top-0 w-full h-full text-white flex justify-center transition ease-in-out duration-300 opacity-0 hover:opacity-[1]">
                <a href="#"
                    class="my-auto text-2xl border-2 border-primary px-5 py-2 hover:bg-primary transition duration-200">Pantofel</a>
            </div>
        </div>

        <div data-aos="fade-down" data-aos-duration="700"
            class="w-full md:col-start-1 md:col-span-2 md:h-[300px] relative">
            <img src="https://images.unsplash.com/photo-1551111293-20c9c0ae923c?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&ixid=MnwxfDB8MXxyYW5kb218MHx8Ym9vdHN8fHx8fHwxNjUwMDQ2NTY1&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=700"
                alt="category" class="w-full h-full object-cover">
            <div
                class="absolute bg-overlay top-0 w-full h-full text-white flex justify-center transition ease-in-out duration-300 opacity-0 hover:opacity-[1]">
                <a href="#"
                    class="my-auto text-2xl border-2 border-primary px-5 py-2 hover:bg-primary transition duration-200">Boot</a>
            </div>
        </div>
        <div data-aos="fade-down" data-aos-duration="700"
            class="w-full md:col-start-3 md:col-span-2 md:h-[300px] relative">
            <img src="https://images.unsplash.com/photo-1561808843-7adeb9606939?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&ixid=MnwxfDB8MXxyYW5kb218MHx8cnVubmluZyBzaG9lc3x8fHx8fDE2NTAwNDcwMTI&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=700"
                alt="category" class="w-full h-full object-cover">
            <div
                class="absolute bg-overlay top-0 w-full h-full text-white flex justify-center transition ease-in-out duration-300 opacity-0 hover:opacity-[1]">
                <a href="#"
                    class="my-auto text-2xl border-2 border-primary px-5 py-2 hover:bg-primary transition duration-200">Running</a>
            </div>
        </div>
        <div data-aos="fade-down" data-aos-duration="700"
            class="w-full md:col-start-5 col-span-2 h-[300px] md:h-[300px] relative">
            <img src="https://images.unsplash.com/photo-1524532787116-e70228437bbe?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&ixid=MnwxfDB8MXxyYW5kb218MHx8c2hvZXN8fHx8fHwxNjUwMDMxMDQ4&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=700"
                alt="category" class="w-full h-full object-cover">
            <div
                class="absolute bg-overlay top-0 w-full h-full text-white flex justify-center transition ease-in-out duration-300 opacity-0 hover:opacity-[1]">
                <a href="#"
                    class="my-auto text-2xl border-2 border-primary px-5 py-2 hover:bg-primary transition duration-200">Walking</a>
            </div>
        </div>
    </div>
</section>
{{-- End of Category --}}

{{-- Our Collection --}}
<section class="container mx-auto">
    <h3 data-aos="fade-down"
        class="text-2xl font-semibold text-center pt-5 pb-5 after:content-[''] after:block after:w-24 after:h-1 after:bg-primary after:mx-auto after:mt-2">
        Our Collection
    </h3>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:mx-0">
        @foreach ($products as $item)
        <div class="w-full">
            <img src="{{asset('storage/'.$item->medias[0]->file_path)}}" alt="product" class="w-full object-cover p-10">
            <h4 class="font-semibold text-center">{{$item->title}}</h4>
            <h5 class="text-center text-sm text-slate-600">Rp. {{number_format($item->variants[0]->price, 2, ",", ".")}}
            </h5>
            <div class="flex mt-3">
                <a href="{{route('product.detail', $item->id)}}"
                    class="mx-auto bg-primary px-10 py-1 text-white rounded-lg mb-5">
                    See Detail
                </a>
            </div>
        </div>
        @endforeach
    </div>
</section>
{{-- End Of Our Collection --}}

{{-- MAPS Section --}}
<section class="w-full mt-5">
    <div id="map" class="w-full" style="height: 400px"></div>
</section>
{{-- End of MAPS Section --}}

@push('scripts')
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.14.1/build/ol.js"></script>
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
<script type="text/javascript">
    var map = new ol.Map({
        target: 'map',
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM()
            })
        ],
        view: new ol.View({
            center: ol.proj.fromLonLat([37.41, 8.82]),
            zoom: 4
        })
    });

</script>
<script>
    // AOS
    AOS.init();

</script>
@endpush
@endsection
