@extends('new-frontend.layouts.front')
@section('title')
    Checkout | GCash
@endsection
<head>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>

@section('content')
<div class="modal fade" id="sample-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close"></i></span>
                </button>

                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="sample-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sample Screenshots</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="tab-content-1">
                            <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="sample-tab">
                                    <div class="tab-content tab-content-carousel">
                                        <div class="tab-pane tab-pane-shadow p-0 fade show active" id="new-all-tab" role="tabpanel" aria-labelledby="new-all-link">
                                            <div class="owl-carousel owl-simple carousel-equal-height" data-toggle="owl"
                                                data-owl-options='{
                                                    "nav": false,
                                                    "dots": true,
                                                    "margin": 0,
                                                    "loop": false,
                                                    "responsive": {
                                                        "0": {
                                                            "items":1
                                                        },
                                                        "480": {
                                                            "items":1
                                                        },
                                                        "768": {
                                                            "items":1
                                                        },
                                                        "992": {
                                                            "items":1
                                                        },
                                                        "1200": {
                                                            "items":1,
                                                            "nav": true
                                                        }
                                                    }
                                                }'>
                                                <div class="product product-3 text-center">
                                                    <figure class="product-media">
                                                        <a href="">
                                                            <img src="{{ asset('assets/image/gcash_sample.jpg') }}" alt="Product image" class="product-image" width="100%" style="background-size: cover!important; height: 480px;">
                                                        </a>
                                                    </figure><!-- End .product-media -->
                                                    <div class="banner-content banner-content-overlay text-center">
                                                        <h3 class="banner-title font-weight-normal">GCash Payment Receipt</h3><!-- End .banner-title -->
                                                    </div><!-- End .banner-content -->
                                                </div><!-- End .product -->
                                                <div class="product product-3 text-center" >
                                                    <figure class="product-media">
                                                        <a href="">
                                                            <img src="{{ asset('assets/image/gcash_sample2.jpg') }}" alt="Product image" class="product-image" width="100%" style="background-size: cover!important; height: 420px;" >
                                                        </a>
                                                    </figure><!-- End .product-media -->
                                                    <h3 class="banner-title font-weight-normal">SMS Confirmation</h3><!-- End .banner-title -->
                                                </div><!-- End .product -->
                                            </div><!-- End .owl-carousel -->
                                        </div><!-- .End .tab-pane -->
                                    </div><!-- End .tab-content -->
                                <div class="form-choice">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="#" class="btn btn-login bg-danger text-white btn-g" class="close" data-dismiss="modal" aria-label="Close">
                                                <i class="icon-close text-white"></i>
                                                Close
                                            </a>
                                        </div><!-- End .col-6 -->
                                    </div><!-- End .row -->
                                </div><!-- End .form-choice -->
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .form-tab -->
                </div><!-- End .form-box -->
            </div><!-- End .modal-body -->
        </div><!-- End .modal-content -->
    </div><!-- End .modal-dialog -->
</div><!-- End .modal -->
<nav aria-label="breadcrumb" class="breadcrumb-nav bg-white">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/checkout') }}">Checkout</a></li>
            <li class="breadcrumb-item active" aria-current="page">GCash</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->
<div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-color: #d1dfff!important; margin-top: -40px;">
    <div class="container " style="margin-top: -60px">
        <div class="form-box" >
            <div class="form-tab">
                <ul class="nav nav-pills nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="email-tab" data-toggle="tab" href="#email" role="tab" aria-controls="email" aria-selected="true">Pay via <strong>GCash</strong></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="email" role="tabpanel" aria-labelledby="email-tab">
                        <h3 class="text-center">
                            Amount Due : <b style="color: #55739d"> PHP {{ number_format(Session::get('total'),2) }}</b>
                        </h3>
                        <form method="post" action="{{ route('payment.gcash') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                            {{ csrf_field() }}
                            <div class="mt-1"></div>
                            <strong>{{ __('Upload the Image including a receipt.') }}</strong>
                            <br>
                            <strong>Step 1: </strong>{{ __('Open GCash Application.') }} <br>
                            <strong>Step 2: </strong>{{ __('Select Pay QR.') }} <br>
                            <strong>Step 3: </strong>{{ __('Scan QR Code below. If you are using mobile device, please download the provided QR Code and upload it on GCash.') }} <br>
                            <center>
                                <img src="{{ asset('frontend/assets/images/qr_code.jpg') }}" alt="Product image" class="product-image"  style="background-size: cover!important; height: 250px; width: 250px;">
                                <a href="{{ route('gcash.download') }}" class="text-primary btn btn-link p-0 m-0 align-baseline" style="font-weight: bold;">
                                    {{ __('click here to download the QR Code') }}
                                </a>.
                            </center>
                            <strong>Step 4: </strong>{{ __('Input Exact Amount.') }} <br>
                            <strong>Step 5: </strong>{{ __('Click Next and Send Now.') }} <br>
                            <strong>Step 6: </strong>{{ __('Download or Screenshot your Receipt.') }} <br>

                            <input type="hidden" name="fname" value="{{ $deliveryAdresses['fname'] }}">
                            <input type="hidden" name="lname" value="{{ $deliveryAdresses['lname'] }}">
                            <input type="hidden" name="phone_no" value="{{ $deliveryAdresses['phone_no'] }}">
                            <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                            <input type="hidden" name="address" value="{{ $deliveryAdresses['detailed_address'] }}">
                            <input type="hidden" name="barangay" value="{{ $deliveryAdresses['barangay'] }}">
                            <input type="hidden" name="city" value="{{ $deliveryAdresses['city'] }}">
                            <input type="hidden" name="postal_code" value="{{ $deliveryAdresses['postal_code'] }}">
                            <input type="hidden" name="total_price" value="{{ number_format(Session::get('total'),2) }}">
                            {{-- <br> --}}
                            <div class="mt-1"></div>
                            <strong >Note:</strong> {{ __('If the image provided is invalid and if the payment is insufficient, your order will cancel.') }}
                            <br>
                            <br>
                            <input style="border: 1px solid #797979; color: #000;" class="form-control @error('gcash_image') is-invalid @enderror" type="file" required accept="image/png, image/gif, image/jpeg" name="gcash_image">
                            <div class="invalid-feedback text-start fw-bold mb-1" style="margin-top: -15px; "><strong>Please upload your receipt here.</strong></div>

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                </div>
                            </div>
                            <div class="form-footer"></div><!-- End .form-footer -->
                            <div class="form-choice">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="{{ url('/checkout') }}" class="btn btn-login bg-warning btn-g">
                                            <i class="icon-long-arrow-left"></i>
                                            Back To Checkout
                                        </a>
                                    </div><!-- End .col-6 -->
                                    <div class="col-sm-6">
                                        <a href="#sample-modal" data-toggle="modal" class="btn btn-login bg-success text-white btn-f">
                                            <i class="fas fa-eye text-white"></i>
                                            View Sample Receipt
                                        </a>
                                    </div><!-- End .col-6 -->
                                </div><!-- End .row -->
                            </div>
                        </form>
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .form-tab -->
        </div><!-- End .form-box -->
    </div><!-- End .container -->
</div><!-- End .login-page section-bg -->

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

<!-- JQuery CDN-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

{{-- <script src="{{ asset('assets/js/custom.js') }}"></script> --}}
@if(session('status'))
    <script>
            swal(" ",{
                title: "{{ session('status') }}",
                icon: 'success',
                closeOnClickOutside: false,
                });
    </script>
@endif
@endsection
