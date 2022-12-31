<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="{{asset ('image/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('template/bootstrap/css/font_awesome_5_free.min.css')}}">
    <!-- Scripts -->
    @vite(['resources/css/app-template.css'])
    <link rel="stylesheet" href="{{asset('template/owlcarousel/dist/assets/owl.carousel.min.css')  }}">
    <link rel="stylesheet" href="{{ asset('template/owlcarousel/dist/assets/owl.theme.default.min.css') }}">

    <!-- Swiper JS-->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
    </style>
</head>

<body>
    <div id="fb-root"></div>
    <script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>

    <div class="heading-area-container">
        @include('frontend.layout.partials.heading-area')
        @include('frontend.layout.partials.website-menu')
    </div>

    @yield('content')

    @include('frontend.layout.partials.footer')

    {{-- @include('frontend.layout.partials.scroll-top') --}}

    @include('frontend.layout.partials.buttons')

    <!-- All Javascripts -->
    <script defer src="{{ asset('template/bootstrap/js/jquery-3.6.0.min.js') }}"></script>
    <script defer src="{{ asset('template/bootstrap/js/jquery-ui.js') }}"></script>
    <script defer src="{{ asset('template/bootstrap/js/bootstrap.min.js') }}"></script>
    <script defer src="{{ asset('template/bootstrap/js/jquery.magnific-popup.min.js') }}"></script>
    <script defer src="{{ asset('template/owlcarousel/dist/owl.carousel.min.js') }}"></script>
    <script defer src="{{ asset('template/bootstrap/js/wow.min.js') }}"></script>
    <script defer src="{{ asset('template/bootstrap/js/select2.full.js') }}"></script>
    <script defer src="{{ asset('template/bootstrap/js/sweetalert2.min.js') }}"></script>
    <script defer src="{{ asset('template/bootstrap/js/jquery.waypoints.min.js') }}"></script>
    <script defer src="{{ asset('template/bootstrap/js/acmeticker.min.js') }}"></script>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script defer src="{{ asset('template/bootstrap/js/custom.min.js') }}"></script>
    @yield('scripts')
</body>

</html>