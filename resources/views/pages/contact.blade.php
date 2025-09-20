@extends('pages.layouts.app')

@section('title', 'About Us')
@section('css')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection
@section('content')
<section class="mt-11 md:mt-32">
    <div class="container mx-auto mb-5">
        <h3 class="text-2xl text-center font-semibold after:content after:block after:w-24 after:h-1 after:bg-primary after:mx-auto after:mb-2">Contact Us</h3>
        <h5 class="text-sm text-center">For all enquiries, please email us using the form below</h5>
    </div>

    <div class="container mx-auto py-5 mx-5 px-7">
        <h3 class="text-2xl font-semibold mb-5">How can we help you?</h3>
        <div class="w-full">
            <div class="flex flex-col justify-center">
                <h4 class="font-semibold mb-2">Fullname: </h4>
                <input type="text" class="w-11/12 border border-slate-300 rounded-md focus:outline-none py-2 px-2" name="fullname" id="fullname">
            </div>
            <div class="flex flex-col justify-center">
                <h4 class="font-semibold mb-2">Email: </h4>
                <input type="text" class="w-11/12 border border-slate-300 rounded-md focus:outline-none py-2 px-2" name="email" id="email">
            </div>
            <div class="flex flex-col justify-center">
                <h4 class="font-semibold mb-2">Message: </h4>
                <textarea name="message" class="w-11/12 border border-slate-300 rounded-md focus:outline-none h-40 py-2 px-2" id="message"></textarea>
            </div>
            
            <button class="w-32 py-1 bg-primary rounded-md mt-5 text-white" id="sendEmail">Send</button>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script>
        let fullname = document.getElementById('fullname')
        let email = document.getElementById('email')
        let message = document.getElementById('message')
        const send = document.getElementById('sendEmail')

        send.addEventListener('click', function(){
            window.location = `mailto:${'lutfi@gmail.com'}?body=Message from:${fullname.value}, ${message.value}`
        })
        
    </script>
@endpush