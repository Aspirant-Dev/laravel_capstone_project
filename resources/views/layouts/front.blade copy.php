<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')
    </title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="@yield('meta_description')" />
    <meta name="author" content="" />
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/landing_page/assets/logo.png') }}" />

     <!-- Scripts -->
     <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('assets/landing_page/css/styles.css') }}" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('assets/css/front-end.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/star.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/new-style.css') }}">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">

    {{-- <link rel="stylesheet" href="{{asset('https://use.fontawesome.com/releases/v5.11.2/css/all.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css')}}">

    <!-- ICON NEEDS FONT AWESOME FOR CHEVRON UP ICON -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js')}}" crossorigin="anonymous"></script>

    {{-- SweetAlert --}}
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>

    <!-- ALERTIFY CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- ALERTIFY Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>

    <style>
        a{
            text-decoration: none!important;
            color: black;
        }
        @media all and (min-width: 992px) {
            .navbar .nav-item .dropdown-menu{ display: none; }
            .navbar .nav-item:hover .nav-link{   }
            .navbar .nav-item:hover .dropdown-menu{ display: block; }
            .navbar .nav-item .dropdown-menu{ margin-top:0; }
        }
    </style>
</head>
{{-- <body style="background-color:#f9fbfc"> --}}
@if (Request::is('password/reset') || Request::is('login') || Request::is('register') || Route::is('password.reset') || Request::is('email/verify') || Route::is('contact-us'))
<body style="background-color:#e9ecef">
@elseif (Route::is('checkout'))
<body style="background-color:#f7f4f4">
@else
<body style="background-color:#f7f4f4">
@endif

    @include('layouts.inc.front-navbar')

    <div class="content">
        @yield('content')
    </div>

    <!-- Return to Top -->
    <a href="javascript:" id="return-to-top"><i class="icon-chevron-up"></i></a>

    <div class="mt-5">
        @include('layouts.inc.modified-footer')
    </div>

     <!-- JQuery CDN-->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
     <!-- Bootstrap core JS-->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     <!-- Core theme JS-->

     <script src="{{ asset('assets/js/custom.js') }}"></script>
     <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
     <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>

    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

     <script>
        var owl = $('.owl-carousel');
            owl.owlCarousel({
            loop:true,
            nav:true,
            margin:10,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                960:{
                    items:5
                },
                1200:{
                    items:4
                }
            }
            });
    </script>
     @yield('scripts')
</body>
</html>
