@extends('new-frontend.layouts.front')
@section('title')
    About Us
@endsection

@section('content')
<nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0 bg-white">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">About us</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->
<div class="container-fluid mt-2">
    <div class="page-header page-header-big text-center" style="background-image: url('{{ asset('frontend/assets/images/about-us-wallpaper.jpeg') }}')">
        <h1 class="page-title text-white">About us</h1>
    </div><!-- End .page-header -->
</div><!-- End .container -->

<div class="page-content pb-0">
    <div class="container-fluid">
        <h2 class="title text-center mb-4">Our Company</h2><!-- End .title text-center mb-2 -->
        <div class="row">

            <div class="col-lg-6">
                <img class="img-fluid rounded mb-4 mb-lg-0" src="{{ asset('assets/landing_page/assets/Real Value Enterprise 2.jpg') }}" alt="..." />
            </div>
            <div class="col-lg-6">
                {{-- <h1 class="text-center">Real Value Enterprise</h1> --}}
                <p style="text-align: justify; font-size: 18px; font-weight: 400;" class="text-dark"><strong>Real Value Enterprise</strong>, a hardware targeted to be one of the best retailers of hardware products in Marilao, located in Mc Arthur hi-way, Saog, Marilao, Bulacan. It was established on January 20, 2008. Real Value Enterprise is one of the hardware product providers in the city that serves as a well supplier in house building, various construction, erection, house maintenance, house beautification, house tools, and some industrial tools. </p>
                {{-- <a class="btn btn-primary d-block"  href="{{ route('login') }}">Shop Now!</a> --}}
            </div>
            {{-- <div class="col-lg-6 mb-3 mb-lg-0">
                <h2 class="title">Our Vision</h2><!-- End .title -->
                <p>Test Vision</p>
            </div><!-- End .col-lg-6 -->

            <div class="col-lg-6">
                <h2 class="title">Our Mission</h2><!-- End .title -->
                <p>Test Mission</p>
            </div><!-- End .col-lg-6 --> --}}
        </div><!-- End .row -->

        <div class="mb-5"></div><!-- End .mb-4 -->
    </div><!-- End .container -->

    <div class="container-fluid">
        <hr class="mt-4 mb-6">

        <h2 class="title text-center mb-4">Meet Our Team</h2><!-- End .title text-center mb-2 -->
        <div class="row">
            <div class="col-md-4">
                <div class="member member-anim text-center">
                    <figure class="member-media">
                        <img src="{{ asset('frontend/assets/images/renz.JPG') }}" alt="member photo">

                        <figcaption class="member-overlay">
                            <div class="member-overlay-content">
                                <h3 class="member-title" style="font-weight: 600">Renz Joseph Castelo<span>Programmer / Developer</span></h3><!-- End .member-title -->
                                {{-- <p>Sed pretium, ligula sollicitudin viverra, tortor libero sodales leo, eget blandit nunc.</p> --}}
                                <div class="social-icons social-icons-simple">
                                    <a href="https://www.facebook.com/renzj.castelo" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                    <a href="https://www.linkedin.com/in/renz-joseph-castelo-4522021b9/" class="social-icon" title="LinkedIn" target="_blank"><i class="icon-linkedin"></i></a>
                                </div><!-- End .soial-icons -->
                            </div><!-- End .member-overlay-content -->
                        </figcaption><!-- End .member-overlay -->
                    </figure><!-- End .member-media -->
                    <div class="member-content">
                        <h3 class="member-title" style="font-weight: 600">Renz Joseph Castelo<span>Programmer / Developer</span></h3><!-- End .member-title -->

                    </div><!-- End .member-content -->
                </div><!-- End .member -->
            </div><!-- End .col-md-4 -->

            <div class="col-md-4">
                <div class="member member-anim text-center">
                    <figure class="member-media">
                        <img src="{{ asset('frontend/assets/images/eya.png') }}" alt="member photo">

                        <figcaption class="member-overlay">
                            <div class="member-overlay-content">
                                <h3 class="member-title" style="font-weight: 600">Ma. Andrea Nicolas<span>Project Manager</span></h3><!-- End .member-title -->
                                {{-- <p>Sed pretium, ligula sollicitudin viverra, tortor libero sodales leo, eget blandit nunc.</p> --}}
                                <div class="social-icons social-icons-simple">
                                    <a href="https://www.facebook.com/nicondrr" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                    <a href="https://www.linkedin.com/in/andrea-nicolas-9507641b9" class="social-icon" title="LinkedIn" target="_blank"><i class="icon-linkedin"></i></a>
                                </div><!-- End .soial-icons -->
                            </div><!-- End .member-overlay-content -->
                        </figcaption><!-- End .member-overlay -->
                    </figure><!-- End .member-media -->
                    <div class="member-content">
                        <h3 class="member-title" style="font-weight: 600">Ma. Andrea Nicolas<span>Project Manager</span></h3><!-- End .member-title -->
                    </div><!-- End .member-content -->
                </div><!-- End .member -->
            </div><!-- End .col-md-4 -->

            <div class="col-md-4">
                <div class="member member-anim text-center">
                    <figure class="member-media">
                        <img src="{{ asset('frontend/assets/images/ryan.jpg') }}" alt="member photo">

                        <figcaption class="member-overlay">
                            <div class="member-overlay-content">
                                <h3 class="member-title" style="font-weight: 600">Ryan Christian Gicale<span>Researcher</span></h3><!-- End .member-title -->

                                <div class="social-icons social-icons-simple">
                                    <a href="https://www.facebook.com/ryan.gicale.3" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                    <a href="https://www.linkedin.com/in/ryan-christian-gicale-5a57681b9" class="social-icon" title="LinkedIn" target="_blank"><i class="icon-linkedin"></i></a>
                                </div><!-- End .soial-icons -->
                            </div><!-- End .member-overlay-content -->
                        </figcaption><!-- End .member-overlay -->
                    </figure><!-- End .member-media -->
                    <div class="member-content">
                        <h3 class="member-title" style="font-weight: 600">Ryan Christian Gicale<span>Researcher</span></h3><!-- End .member-title -->
                    </div><!-- End .member-content -->
                </div><!-- End .member -->
            </div><!-- End .col-md-4 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div>



<!-- JQuery CDN-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/landing_page/js/scripts.js') }}"></script>
@endsection
