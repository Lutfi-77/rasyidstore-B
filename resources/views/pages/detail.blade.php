@extends('pages.layouts.app')

@section('title', 'Detail Product')
@section('css')
<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
@endsection
@section('content')
<section class="md:mt-32">
    <div class="container mx-auto">
        <div class="flex flex-wrap w-full mb-28">
            <div class="w-full self-center md:self-start md:h-[450px] md:w-1/2 px-3 md:sticky md:top-24">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="https://i.shgcdn.com/57b85c8d-aa3f-416c-b6e5-bb110620e924/-/format/auto/-/preview/3000x3000/-/quality/lighter/"
                                alt="detail product" class="w-full object-cover">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://i.shgcdn.com/57b85c8d-aa3f-416c-b6e5-bb110620e924/-/format/auto/-/preview/3000x3000/-/quality/lighter/"
                                alt="detail product" class="w-full object-cover">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://i.shgcdn.com/57b85c8d-aa3f-416c-b6e5-bb110620e924/-/format/auto/-/preview/3000x3000/-/quality/lighter/"
                                alt="detail product" class="w-full object-cover">
                        </div>
                    </div>
                </div>

                <div class="md:flex hidden">
                    <div class="aspect-square bg-blue-400 w-16 h-16 mx-1 flex items-center">
                        <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=350&ixid=MnwxfDB8MXxyYW5kb218MHx8c2hvZXN8fHx8fHwxNjUwMDA2NDQy&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=300"
                            alt="thumb" class="w-full">
                    </div>
                    <div class="aspect-square bg-blue-400 w-16 h-16 mx-1 flex items-center">
                        <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=350&ixid=MnwxfDB8MXxyYW5kb218MHx8c2hvZXN8fHx8fHwxNjUwMDA2NDQy&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=300"
                            alt="thumb" class="w-full">
                    </div>
                    <div class="aspect-square bg-blue-400 w-16 h-16 mx-1 flex items-center">
                        <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=350&ixid=MnwxfDB8MXxyYW5kb218MHx8c2hvZXN8fHx8fHwxNjUwMDA2NDQy&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=300"
                            alt="thumb" class="w-full">
                    </div>
                </div>
            </div>

            <div class="w-full self-start md:w-1/2 px-3">
                <h3 class="text-2xl font-semibold mb-1">Nike Air Max 90 SE</h3>
                <h3 class="text-red-500 text-lg font-bold mb-5">Rp. 3.500.000</h3>
                <div class="text-lg mb-5">
                    Max Air changed the game in '87. Now, we honour its emerald anniversary (35 years!) with the Nike
                    Air Max 90 SE. Emerald graphics and colours highlight this big landmark, while its classic Waffle
                    outsole and exposed Air cushioning keep you living the legacy in comfort.
                </div>
                <div class="text-base font-semibold">
                    Select Color
                </div>
                <div class="flex mt-2">
                    <div class="rounded-full bg-red-600 w-7 h-7 mx-2 border-2 border-slate-300"></div>
                    <div class="rounded-full bg-blue-600 w-7 h-7 mx-2 border-2 border-slate-300"></div>
                    <div class="rounded-full bg-green-600 w-7 h-7 mx-2 border-2 border-slate-300"></div>
                </div>

                <div class="text-base font-semibold mt-5">
                    Select Size
                </div>
                <div class="flex mt-2">
                    <div class="w-9 h-9 mx-2 border border-black flex items-center justify-center">45</div>
                    <div class="w-9 h-9 mx-2 border border-black flex items-center justify-center">45</div>
                    <div class="w-9 h-9 mx-2 border border-black flex items-center justify-center">45</div>
                    <div class="w-9 h-9 mx-2 border border-black flex items-center justify-center">45</div>
                    <div class="w-9 h-9 mx-2 border border-black flex items-center justify-center">45</div>
                </div>

                <div class="flex mt-5">
                    <a href="#" class="border bg-secondary text-white px-7 py-1 rounded-lg">Add To Cart</a>
                    <a href="#" class="bg-primary px-7 py-1 rounded-lg text-white ml-5">Buy Now</a>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-7">
            <div class="flex border-b-[1px] border-b-slate-300 items-center">
                <button class="mx-5 mb-3 tablinks text-slate-300" onclick="openTab(event, 'review')">
                    Review
                </button>
                <button class="mx-5 mb-3 tablinks text-slate-300" onclick="openTab(event, 'product')">
                    Similar Products
                </button>
            </div>

            <div id="review" class="tabcontent" style="display: block">
                <div class="w-1/2 shadow-lg rounded-lg mt-5">
                    <div class="w-full px-5 py-2">
                        <div class="flex my-3 items-center">
                            <div class="mr-5">
                                <img src="https://i.pinimg.com/originals/7c/c7/a6/7cc7a630624d20f7797cb4c8e93c09c1.png" class="w-28">
                            </div>
                            <div class="flex flex-col">
                                <h3 class="text-base font-bold">Lara Croft</h3>
                                <div class="text-sm">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate vel excepturi necessitatibus? Amet eius eaque quam pariatur molestias modi aut quas
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="product" class="tabcontent" style="display: none">
                <div class="grid grid-cols-2 md:grid-cols-3 mb-11">
                    <div class="w-full">
                        <img src="https://i.shgcdn.com/57b85c8d-aa3f-416c-b6e5-bb110620e924/-/format/auto/-/preview/3000x3000/-/quality/lighter/" alt="product" class="w-full object-cover p-10">
                        <h4 class="font-semibold text-center">Nike Air Max 90 SE</h4>
                        <h5 class="text-center text-sm text-slate-600">Rp.2.500.00</h5>
                        <div class="flex mt-3">
                            <a href="#" class="mx-auto bg-primary px-10 py-1 text-white rounded-lg">
                                See Detail
                            </a>
                        </div>
                    </div>
                    <div class="w-full">
                        <img src="https://i.shgcdn.com/57b85c8d-aa3f-416c-b6e5-bb110620e924/-/format/auto/-/preview/3000x3000/-/quality/lighter/" alt="product" class="w-full object-cover p-10">
                        <h4 class="font-semibold text-center">Nike Air Max 90 SE</h4>
                        <h5 class="text-center text-sm text-slate-600">Rp.2.500.00</h5>
                        <div class="flex mt-3">
                            <a href="#" class="mx-auto bg-primary px-10 py-1 text-white rounded-lg">
                                See Detail
                            </a>
                        </div>
                    </div>
                    <div class="w-full">
                        <img src="https://i.shgcdn.com/57b85c8d-aa3f-416c-b6e5-bb110620e924/-/format/auto/-/preview/3000x3000/-/quality/lighter/" alt="product" class="w-full object-cover p-10">
                        <h4 class="font-semibold text-center">Nike Air Max 90 SE</h4>
                        <h5 class="text-center text-sm text-slate-600">Rp.2.500.00</h5>
                        <div class="flex mt-3">
                            <a href="#" class="mx-auto bg-primary px-10 py-1 text-white rounded-lg">
                                See Detail
                            </a>
                        </div>
                    </div>
                    <div class="w-full">
                        <img src="https://i.shgcdn.com/57b85c8d-aa3f-416c-b6e5-bb110620e924/-/format/auto/-/preview/3000x3000/-/quality/lighter/" alt="product" class="w-full object-cover p-10">
                        <h4 class="font-semibold text-center">Nike Air Max 90 SE</h4>
                        <h5 class="text-center text-sm text-slate-600">Rp.2.500.00</h5>
                        <div class="flex mt-3">
                            <a href="#" class="mx-auto bg-primary px-10 py-1 text-white rounded-lg">
                                See Detail
                            </a>
                        </div>
                    </div>
                    <div class="w-full">
                        <img src="https://i.shgcdn.com/57b85c8d-aa3f-416c-b6e5-bb110620e924/-/format/auto/-/preview/3000x3000/-/quality/lighter/" alt="product" class="w-full object-cover p-10">
                        <h4 class="font-semibold text-center">Nike Air Max 90 SE</h4>
                        <h5 class="text-center text-sm text-slate-600">Rp.2.500.00</h5>
                        <div class="flex mt-3">
                            <a href="#" class="mx-auto bg-primary px-10 py-1 text-white rounded-lg">
                                See Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
@push('scripts')
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="{{asset('js/pages/detail.js')}}"></script>
@endpush
