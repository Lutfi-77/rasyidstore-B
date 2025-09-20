{{-- @extends('pages.layouts.app') --}}

@section('title', 'Detail Product')
@section('css')
<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
@livewireStyles
@endsection
<div>
    <section class="md:mt-32">
        <div class="container mx-auto">
            <div class="flex flex-wrap w-full mb-28">
                <div class="w-full self-center md:self-start md:h-[450px] md:w-1/2 px-3 md:sticky md:top-24">
                    <div class="swiper mainThumb h-full">
                        <div class="swiper-wrapper">
                            @foreach ($images as $item)
                            <div class="swiper-slide">
                                <img src="{{asset('storage/'.$item['file_path'])}}" alt="detail product"
                                    class="w-full object-cover">
                            </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
            <div class="hidden md:block swiper gallery-thumbs w-80 float-left" wire:ignore>
                <div class="swiper-wrapper">
                    @foreach ($images as $thumbs)
                    <div class="swiper-slide">
                        <img src="{{asset('storage/'.$thumbs['file_path'])}}" alt="thumb" class="w-full">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="w-full self-start md:w-1/2 px-3">
            <form method="post" wire:submit.prevent="addToCart">
                @csrf
                <h3 class="text-2xl font-semibold mb-1">{{$products->title}}</h3>
                <h3 class="text-red-500 text-lg font-bold mb-5">Rp. {{number_format($productVariant->price)}}</h3>
                <div class="text-lg mb-5">
                    {{$products->desc}}
                </div>
                {{-- Pisahin Component Untuk Nanti Nya --}}

                @if(in_array("motif",$variantChoose))
                    <div class="text-base font-semibold mt-5">
                        Select Motif
                    </div>
                    <div class="flex mt-2">

                        @foreach ($child as $item)
                        <label>
                            <input type="radio" id="{{$item->title}}" name="size" class="hidden peer"
                                value="{{$item->id}}" />
                            <div
                                class="peer-checked:border-black peer-checked:bg-secondary peer-checked:text-white w-9 h-9 border border-slate-300 flex items-center justify-center"  wire:click="setOption('motif',{{$item->id}})">
                                {{$item->title}}
                            </div>
                        </label>
                        @endforeach
                    </div>
                @endif

                @if(in_array("color",$variantChoose))
                    <div class="text-base font-semibold">
                        Select Color
                    </div>

                    <div class="flex mt-2">
                        @foreach ($parent as $color)
                        <label>
                            <input type="radio" id="{{$color->title}}" name="color" value="{{$color->id}}"
                                class="peer hidden" />
                            <div class="peer-checked:border-black w-9 h-9 border border-slate-300 rounded-full mx-1 cursor-pointer"
                                style="background-color: {{$color->meta_attr->color}}"
                                wire:click="setOption('color',{{$color->id}})"></div>
                        </label>

                        @endforeach
                    </div>
                @endif

                @if(in_array("size",$variantChoose))
                    <div class="text-base font-semibold mt-5">
                        Select Size
                    </div>
                    <div class="flex mt-2">
                            @foreach ($isChild ? $child : $parent as $item)
                            <label>
                                <input type="radio" id="{{$item->title}}" name="size" class="hidden peer"
                                    value="{{$item->id}}" />
                                <div
                                    class="peer-checked:border-black peer-checked:bg-secondary peer-checked:text-white w-9 h-9 border border-slate-300 flex items-center justify-center" wire:click="setOption('size',{{$item->id}})">
                                    {{$item->title}}
                                </div>
                            </label>
                            @endforeach
                    </div>
                @endif

                <div class="flex mt-5">
                    <button href="#" class="border bg-secondary text-white px-7 py-1 rounded-lg" type="submit">Add To
                        Cart</button>
                    <a href="{{route('transaction.create','variant_id='.$productVariant->id)}}" class="bg-primary px-7 py-1 rounded-lg text-white ml-5">Buy Now</a>
                </div>
            </form>
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
        {{-- {{dd($comments)}} --}}
        @foreach ($comments->comments as $item)
        <div class="w-full md:w-1/2 shadow-lg rounded-lg mt-5">
            <div class="w-full px-5 py-2">
                <div class="flex my-3 items-center">
                    <div class="mr-5 w-12 h-12">
                        <img src="https://i.pinimg.com/originals/7c/c7/a6/7cc7a630624d20f7797cb4c8e93c09c1.png"
                            class="w-full md:w-28">
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-base font-bold">{{$item->fullname}}</h3>
                        <div class="text-sm">
                            {{$item->pivot->comment}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="comment">
            <form action="{{route('store.comment')}}" method="POST">
                @csrf
                <input type="hidden" name="prod_variant_id" value="{{$productVariant->id}}">
                <textarea name="comment"
                    class="w-full rounded-md py-1 border border-slate-300 focus:outline-none pl-2 mt-5"
                    placeholder="Comment Here..."></textarea>
                <button class="bg-secondary text-white px-8 py-1 rounded-md mt-2">Post</button>
            </form>
        </div>
    </div>

    <div id="product" class="tabcontent" style="display: none">
        <div class="grid grid-cols-2 md:grid-cols-3 mb-11">
            @foreach ($productByCategory as $similar)
            <div class="w-full">
                <img src="{{asset('storage/'.$similar->medias[0]->file_path)}}"
                    alt="product" class="w-full object-cover p-10">
                <h4 class="font-semibold text-center">{{$similar->title}}</h4>
                <h5 class="text-center text-sm text-slate-600">Rp. {{number_format($similar->variants[0]->price, 2, ",", ".")}}</h5>
                <div class="flex mt-3">
                    <a href="{{route('product.detail', $similar->id)}}" class="mx-auto bg-primary px-10 py-1 text-white rounded-lg">
                        See Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

</div>
</section>
</div>
@push('scripts')
@livewireScripts
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="{{asset('js/pages/detail.js')}}"></script>
<script>

    var mainThumb = new Swiper(".mainThumb", {
        autoHeight: true,
        spaceBetween: 20,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    var thumbs = new Swiper('.gallery-thumbs', {
        slidesPerView: 3,
        spaceBetween: 10,
        centeredSlides: true,
        loop: false,
        slideToClickedSlide: true,
    });
    mainThumb.controller.control = thumbs;
    thumbs.controller.control = mainThumb;

</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    window.addEventListener('alert', event => { 
        toastr[event.detail.type](event.detail.message, 
        event.detail.title ?? ''), toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
    });
</script>
@endpush
