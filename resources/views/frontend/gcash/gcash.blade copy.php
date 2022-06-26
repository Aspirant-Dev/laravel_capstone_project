@extends('new-frontend.layouts.front')
<head>
    <title>
        Checkout | GCash
    </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/adminlte.min.css') }}">

<!-- Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

</head>

@section('content')

{{-- <main class="main bg-light"> --}}
    <nav aria-label="breadcrumb" class="breadcrumb-nav bg-white">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/checkout') }}">Checkout</a></li>
                <li class="breadcrumb-item active" aria-current="page">GCash</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="container-fluid mb-3">
        <div class="row justify-content-center">
            <div style="width: 100%;  max-width: 50rem;">
                <h2 class="text-center">
                    <b>Pay via <span > GCash </span></b>
                </h2>
                <div class="card shadow-lg py-5" style="border: 1px solid rgb(172, 170, 170)">
                    <div class="card-body login-card-body">
                        <h4 class="login-box-msg">Amount Due : <b style="color: #2962ff"> PHP {{ number_format(Session::get('total'),2) }}</b></h4>

                        <form method="post" action="{{ route('payment.gcash') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-12 mb-3" style="width: 100%">
                                    <label for="acc-img mt-1">Upload the Image including a receipt.</label>
                                    <br>
                                    <a><strong>Step 1: </strong>Open GCash Application.</a><br>
                                    <a><strong>Step 2: </strong>Select Send Money.</a><br>
                                    <a><strong>Step 3: </strong>Select Express Send.</a><br>
                                    <a><strong>Step 4: </strong>Input Mobile Number.</a><br>
                                    <a><strong>Step 5: </strong>Input Exact Amount.</a><br>
                                    <a><strong>Step 6: </strong>Click Send Now.</a><br>
                                    <a><strong>Step 7: </strong>Download or Screenshot your Receipt.</a>



                                    <input class="form-control mt-2 @error('gcash_image') is-invalid @enderror" type="file" accept="image/png, image/gif, image/jpeg" name="gcash_image">
                                    @error('gcash_image')
                                    <span class="invalid-feedback " role="alert">
                                            <strong>Please upload your gcash receipt</strong>
                                        </span>
                                    @enderror
                                    <input type="hidden" name="fname" value="{{ $deliveryAdresses['fname'] }}">
                                    <input type="hidden" name="lname" value="{{ $deliveryAdresses['lname'] }}">
                                    <input type="hidden" name="phone_no" value="{{ $deliveryAdresses['phone_no'] }}">
                                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                    <input type="hidden" name="address" value="{{ $deliveryAdresses['detailed_address'] }}">
                                    <input type="hidden" name="barangay" value="{{ $deliveryAdresses['barangay'] }}">
                                    <input type="hidden" name="city" value="{{ $deliveryAdresses['city'] }}">
                                    <input type="hidden" name="postal_code" value="{{ $deliveryAdresses['postal_code'] }}">
                                    <input type="hidden" name="total_price" value="{{ number_format(Session::get('total'),2) }}">
                                    <small class="text-muted mt-2">
                                        <b>Note:</b> Please send a payment to this gccash account: <strong>0938-348-3592.</strong>
                                        <br>
                                        If the image provided is invalid and if the payment is insufficient, your order status will remain pending.
                                    </small>
                                    <br>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit"class="btn bg-gradient-success col-md-12">Submit <i class="icon-long-arrow-right"></i> </button>
                            </div>
                        </form>
                        <a href="{{ route('checkout') }}" type="button" class="btn btn-sm btn-warning text-dark float-left">
                            <i class="icon-long-arrow-left"></i> Back to Checkout
                        </a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-info float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
                           <i class="fas fa-eye"></i> View Sample Receipt
                        </button>

                        <!-- Modal -->
                        <div class="modal fade"  id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                <div class="modal-content" style="border-radius: 0px!important;">
                                    <div class="modal-header text-center">
                                        <h5 class="modal-title w-100" id="exampleModalLabel" style="color: #ee4d2d">Sample Screenshots</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body" style="background-color:#616364">
                                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                                <center>

                                                    <div class="carousel-inner">
                                                      <div class="carousel-item active">
                                                        <img src="{{ asset('assets/image/gcash_sample.jpg') }}" width="300px" height="450px" alt="" srcset="">
                                                      </div>
                                                      <div class="carousel-item">
                                                        <img src="{{ asset('assets/image/gcash_sample2.jpg') }}" width="320px" height="220px" alt="" srcset="">
                                                      </div>
                                                    </div>
                                                </center>
                                                <a class="carousel-control-prev " href="#carouselExampleControls" role="button" data-slide="prev">
                                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                  <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next " href="#carouselExampleControls" role="button" data-slide="next">
                                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                  <span class="sr-only">Next</span>
                                                </a>
                                            </div>

                                            {{-- <div class="row">
                                                <div class="col-md-12 mb-3">


                                                    <center>
                                                        <span><img src="{{ asset('assets/image/gcash_sample.jpg') }}" width="300px" height="450px" alt="" srcset=""></span>
                                                    </center>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- </main> --}}
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
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



