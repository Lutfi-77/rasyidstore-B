@extends('pages.layouts.app')

@section('title', 'Testimonial')
@section('css')
<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
<link rel="stylesheet" href="{{asset('css/pages/testimoni.css')}}" />
@endsection
@section('content')
<section class="md:mt-32">
    <h3
        class="text-2xl font-semibold text-center pt-5 pb-5 after:content-[''] after:block after:w-24 after:h-1 after:bg-primary after:mx-auto after:mt-2">
        Testimoni
    </h3>
</section>


<section class="container mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
        <div class="w-full rounded-md p-5 bg-secondary text-white">
            <div class="flex items-center">
                <img src="https://avatars.dicebear.com/api/human/123.svg" alt="avatar" class="w-14 h-14 rounded-full">

                <div class="ml-1 flex flex-col">
                    <div class="font-semibold text-sm">
                        John Doe
                    </div>

                    <div class="star-rating">
                        <input type="radio" id="5-stars" name="rating" value="5" />
                        <label for="5-stars" class="star">&#9733;</label>
                        <input type="radio" id="4-stars" name="rating" value="4" />
                        <label for="4-stars" class="star">&#9733;</label>
                        <input type="radio" id="3-stars" name="rating" value="3" />
                        <label for="3-stars" class="star">&#9733;</label>
                        <input type="radio" id="2-stars" name="rating" value="2" />
                        <label for="2-stars" class="star">&#9733;</label>
                        <input type="radio" id="1-star" name="rating" value="1" />
                        <label for="1-star" class="star">&#9733;</label>
                    </div>
                </div>
            </div>
            <div class="text-base mt-5">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias molestiae rem voluptatum nostrum
                fugiat amet harum excepturi repellat, minus laudantium autem optio eum fuga sed fugit perspiciatis
                perferendis earum vel.
            </div>
        </div>
        <div class="w-full rounded-md p-5 bg-secondary text-white">
            <div class="flex items-center">
                <img src="https://avatars.dicebear.com/api/human/123.svg" alt="avatar" class="w-14 h-14 rounded-full">

                <div class="ml-1 flex flex-col">
                    <div class="font-semibold text-sm">
                        John Doe
                    </div>

                    <div class="star-rating">
                        <input type="radio" id="5-stars" name="rating" value="5" />
                        <label for="5-stars" class="star">&#9733;</label>
                        <input type="radio" id="4-stars" name="rating" value="4" />
                        <label for="4-stars" class="star">&#9733;</label>
                        <input type="radio" id="3-stars" name="rating" value="3" />
                        <label for="3-stars" class="star">&#9733;</label>
                        <input type="radio" id="2-stars" name="rating" value="2" />
                        <label for="2-stars" class="star">&#9733;</label>
                        <input type="radio" id="1-star" name="rating" value="1" />
                        <label for="1-star" class="star">&#9733;</label>
                    </div>
                </div>
            </div>
            <div class="text-base mt-5">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias molestiae rem voluptatum nostrum
                fugiat amet harum excepturi repellat, minus laudantium autem optio eum fuga sed fugit perspiciatis
                perferendis earum vel.
            </div>
        </div>
        <div class="w-full rounded-md p-5 bg-secondary text-white">
            <div class="flex items-center">
                <img src="https://avatars.dicebear.com/api/human/123.svg" alt="avatar" class="w-14 h-14 rounded-full">

                <div class="ml-1 flex flex-col">
                    <div class="font-semibold text-sm">
                        John Doe
                    </div>

                    <div class="star-rating">
                        <input type="radio" id="5-stars" name="rating" value="5" />
                        <label for="5-stars" class="star">&#9733;</label>
                        <input type="radio" id="4-stars" name="rating" value="4" />
                        <label for="4-stars" class="star">&#9733;</label>
                        <input type="radio" id="3-stars" name="rating" value="3" />
                        <label for="3-stars" class="star">&#9733;</label>
                        <input type="radio" id="2-stars" name="rating" value="2" />
                        <label for="2-stars" class="star">&#9733;</label>
                        <input type="radio" id="1-star" name="rating" value="1" />
                        <label for="1-star" class="star">&#9733;</label>
                    </div>
                </div>
            </div>
            <div class="text-base mt-5">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias molestiae rem voluptatum nostrum
                fugiat amet harum excepturi repellat, minus laudantium autem optio eum fuga sed fugit perspiciatis
                perferendis earum vel.
            </div>
        </div>
    </div>
</section>
@endsection
