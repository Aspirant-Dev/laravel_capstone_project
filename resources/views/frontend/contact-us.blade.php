@extends('new-frontend.layouts.front')

@section('title')
    Contact Us
@endsection
@section('content')
<nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0 bg-white">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact us</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->
<div class="container-fluid mt-2">
    <div class="page-header page-header-big text-center" style="background-image: url('{{ asset('frontend/assets/images/contact-us-wallpaper.jpg') }}')">
        <h1 class="page-title text-white">Contact us<span class="text-white">keep in touch with us</span></h1>
    </div><!-- End .page-header -->
</div><!-- End .container -->

<div class="page-content pb-0 pt-2" >
    <div class="container-fluid" >
        <div class="row pt-3" style="background-color: rgba(255, 255, 255, 0.685)">
            <div class="col-lg-6 mb-2 mb-lg-0">
                <h2 class="title mb-1">Business Information</h2><!-- End .title mb-2 -->
                <p><br></p>
                <div class="row" style="font-weight: 600;">
                    <div class="col-sm-7">
                        <div class="contact-info">
                            <ul class="contact-list">
                                <li>
                                    <i class="icon-map-marker"></i>
                                    <a href="https://goo.gl/maps/4zzGUdo4wKdCQUEX8" target="_blank" >
                                        Mc Arthur Highway, Saog, Marilao, Bulacan, Philippines, 3019
                                    </a>
                                </li>
                                <li>
                                    <i class="icon-phone"></i>
                                    <a href="tel:+0948-280-3931">09328567990</a>
                                </li>
                                <li>
                                    <i class="icon-envelope"></i>
                                    <a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=enterpriserealvalue@gmail.com" target="_blank"> enterpriserealvalue@gmail.com</a>
                                </li>
                            </ul><!-- End .contact-list -->
                        </div><!-- End .contact-info -->
                    </div><!-- End .col-sm-7 -->

                    <div class="col-sm-5">
                        <div class="contact-info">
                            <ul class="contact-list">
                                <li>
                                    <i class="icon-clock-o"></i>
                                    <span class="text-dark">Monday-Saturday</span> <br>7:00am - 5:00pm
                                </li>
                                <li>
                                    <i class="icon-calendar"></i>
                                    <span class="text-dark">Sunday</span> <br>8:00am - 3:00pm
                                </li>
                            </ul><!-- End .contact-list -->
                        </div><!-- End .contact-info -->
                    </div><!-- End .col-sm-5 -->
                </div><!-- End .row -->
            </div><!-- End .col-lg-6 -->
            <div class="col-lg-6">
                <h2 class="title mb-1">Got Any Questions?</h2><!-- End .title mb-2 -->
                <p class="mb-2">Use the form below to get in touch with our team</p>

                    <form method="POST" action="{{ route('save-contact') }}" class="contact-form mb-3 needs-validation" novalidate>
                        @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="cname" class="sr-only">Name</label>
                            <input type="text" class="form-control" id="cname" name="name" placeholder="Name *" required>
                            <div class="invalid-feedback text-start fw-bold" style="margin-top: -15px; margin-bottom: 5px;"><strong>This field is required.</strong></div>
                        </div><!-- End .col-sm-6 -->

                        <div class="col-sm-6">
                            <label for="cemail" class="sr-only">Email</label>
                            <input type="email" class="form-control" id="cemail" name="email" placeholder="Email *" required>
                            <div class="invalid-feedback text-start fw-bold" style="margin-top: -15px; margin-bottom: 5px;"><strong>This field is required.</strong></div>
                        </div><!-- End .col-sm-6 -->
                    </div><!-- End .row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <label for="cphone" class="sr-only">Phone</label>
                            <input type="tel" class="form-control" id="cphone" name="phone_number" placeholder="Phone">
                        </div><!-- End .col-sm-6 -->

                        <div class="col-sm-6">
                            <label for="csubject" class="sr-only">Subject</label>
                            <input type="text" class="form-control" id="csubject" name="subject" placeholder="Subject">
                        </div><!-- End .col-sm-6 -->
                    </div><!-- End .row -->

                    <label for="cmessage" class="sr-only">Message</label>
                    <textarea class="form-control" cols="30" rows="4" id="cmessage"  name="message"  placeholder="Message *" required></textarea>
                    <div class="invalid-feedback text-start fw-bold" style="margin-top: -15px; margin-bottom: 5px;"><strong>This field is required.</strong></div>
                    <button type="submit" class="btn btn-primary btn-minwidth-sm ">
                        <span>SUBMIT</span>
                        <i class="icon-long-arrow-right"></i>
                    </button>
                </form><!-- End .contact-form -->
            </div><!-- End .col-lg-6 -->
        </div><!-- End .row -->

        <hr class="mt-4 mb-5">

    </div><!-- End .container -->
    <div id="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1929.1046585077354!2d120.95262650718522!3d14.757234111897693!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b25cd18d6207%3A0x993570e0e3fddea2!2sReal%20Value%20Enterprise!5e0!3m2!1sen!2sph!4v1635050741061!5m2!1sen!2sph"
           width="100%" height="100%" frameborder="0" allowFullScreen loading="lazy">
        </iframe>
    </div><!-- End #map -->
    <br>
</div><!-- End .page-content -->

<!-- Google Map -->
{{-- <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCUXuNQ0HhE_LK0jjEXm_QtjfgMiEqHhvQ"></script> --}}

<!-- JQuery CDN-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
        })
    })()
</script>
@if(session('success'))
            <script>
                swal({
                    title: "{{ session('success') }}",
                    text: " ",
                    icon: 'success',
                    closeOnClickOutside: false,
                });
            </script>
        @endif
@endsection
