@extends('pages.layouts.app')

@section('title', 'About Us')
@section('css')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection
@section('content')
<section class="mt-11 md:mt-32 px-4">
    {{-- <div class="">
        <div class="flex flex-wrap w-full relative">
            <div class="self-center text-justify w-full md:w-1/2">
                <h3 class="text-2xl font-bold mb-5">Get To Know Alrasyid Store</h3>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident dolore rem culpa, repellat laudantium
                nostrum iure eum maxime officiis. Voluptatem eum laboriosam reiciendis obcaecati? Qui corrupti ad
                voluptate possimus commodi. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque,
                reiciendis blanditiis totam quibusdam, nulla harum placeat, molestiae doloribus impedit vel cum! Nulla
                omnis voluptates sequi quidem pariatur aperiam sed non.
            </div>
            <div class="w-full md:w-1/2 self-end mt-7">
                <img src="https://images.unsplash.com/photo-1599012307530-d163bd04ecab?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&ixid=MnwxfDB8MXxyYW5kb218MHx8c3RvcmV8fHx8fHwxNjUwMTM1NzA0&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=500"
                    alt="Best seller" class="object-cover rounded ml-44">
            </div>
        </div>
    </div> --}}
    <div class="w-full relative">
        <img src="https://images.unsplash.com/photo-1599012307530-d163bd04ecab?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&ixid=MnwxfDB8MXxyYW5kb218MHx8c3RvcmV8fHx8fHwxNjUwMTM1NzA0&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=500" alt="Best seller" class="w-full h-80 object-cover">

        <h3 class="text-3xl text-white font-bold mb-5 absolute top-1/2 left-4">Get To Know Alrasyid Store</h3>
    </div>

    <div class="w-full mt-10 text-lg text-justify">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident dolore rem culpa, repellat laudantium
        nostrum iure eum maxime officiis. Voluptatem eum laboriosam reiciendis obcaecati? Qui corrupti ad
        voluptate possimus commodi. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque,
        reiciendis blanditiis totam quibusdam, nulla harum placeat, molestiae doloribus impedit vel cum! Nulla
        omnis voluptates sequi quidem pariatur aperiam sed non.
    </div>
</section>

<section class="px-4 mt-16">
    <div class="grid grid-cols-2 grid-rows-2 gap-16">
        <div class="w-full">
            <h3 class="font-semibold mb-5 text-xl">VISI</h3>
            <div class="w-full">
                <ul class="text-base">
                    <li class="pb-5">
                        1. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto aliquid et inventore,
                        facilis, rem blanditiis corrupti neque excepturi sed possimus mollitia unde animi adipisci nobis
                        a
                        fuga obcaecati nesciunt assumenda.
                    </li>
                    <li class="pb-5">
                        1. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto aliquid et inventore,
                        facilis, rem blanditiis corrupti neque excepturi sed possimus mollitia unde animi adipisci nobis
                        a
                        fuga obcaecati nesciunt assumenda.
                    </li>
                    <li class="pb-5">
                        1. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto aliquid et inventore,
                        facilis, rem blanditiis corrupti neque excepturi sed possimus mollitia unde animi adipisci nobis
                        a
                        fuga obcaecati nesciunt assumenda.
                    </li>
                    <li class="pb-5">
                        1. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto aliquid et inventore,
                        facilis, rem blanditiis corrupti neque excepturi sed possimus mollitia unde animi adipisci nobis
                        a
                        fuga obcaecati nesciunt assumenda.
                    </li>
                </ul>
            </div>
        </div>
        <div class="w-full">
            <img src="https://static.nike.com/a/images/f_auto/15feea01-6923-4310-a0d6-f4c3717b52b9/image.jpeg" alt="about" class="w-full rounded-lg">
        </div>


        <div class="w-full">
            <img src="https://static.nike.com/a/images/f_auto/15feea01-6923-4310-a0d6-f4c3717b52b9/image.jpeg" alt="about" class="w-full rounded-lg">
        </div>
        <div class="w-full">
            <h3 class="font-semibold mb-5 text-xl">MISI</h3>
            <div class="w-full">
                <ul class="text-base">
                    <li class="pb-5">
                        1. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto aliquid et inventore,
                        facilis, rem blanditiis corrupti neque excepturi sed possimus mollitia unde animi adipisci nobis
                        a
                        fuga obcaecati nesciunt assumenda.
                    </li>
                    <li class="pb-5">
                        1. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto aliquid et inventore,
                        facilis, rem blanditiis corrupti neque excepturi sed possimus mollitia unde animi adipisci nobis
                        a
                        fuga obcaecati nesciunt assumenda.
                    </li>
                    <li class="pb-5">
                        1. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto aliquid et inventore,
                        facilis, rem blanditiis corrupti neque excepturi sed possimus mollitia unde animi adipisci nobis
                        a
                        fuga obcaecati nesciunt assumenda.
                    </li>
                    <li class="pb-5">
                        1. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto aliquid et inventore,
                        facilis, rem blanditiis corrupti neque excepturi sed possimus mollitia unde animi adipisci nobis
                        a
                        fuga obcaecati nesciunt assumenda.
                    </li>
                </ul>
            </div>
        </div>
        {{-- <div class="w-full row-start-2 col-start-2">
            <h3 class="font-semibold mt-10 mb-5">MISI</h3>
            <div class="w-full">
                <ul class="w-[750px]">
                    <li>
                        1. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto aliquid et inventore,
                        facilis, rem blanditiis corrupti neque excepturi sed possimus mollitia unde animi adipisci nobis
                        a
                        fuga obcaecati nesciunt assumenda.
                    </li>
                    <li>
                        1. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto aliquid et inventore,
                        facilis, rem blanditiis corrupti neque excepturi sed possimus mollitia unde animi adipisci nobis
                        a
                        fuga obcaecati nesciunt assumenda.
                    </li>
                    <li>
                        1. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto aliquid et inventore,
                        facilis, rem blanditiis corrupti neque excepturi sed possimus mollitia unde animi adipisci nobis
                        a
                        fuga obcaecati nesciunt assumenda.
                    </li>
                    <li>
                        1. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto aliquid et inventore,
                        facilis, rem blanditiis corrupti neque excepturi sed possimus mollitia unde animi adipisci nobis
                        a
                        fuga obcaecati nesciunt assumenda.
                    </li>
                </ul>
            </div>
        </div> --}}
    </div>
</section>
@endsection
