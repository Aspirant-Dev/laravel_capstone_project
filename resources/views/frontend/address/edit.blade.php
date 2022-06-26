@extends('new-frontend.layouts.front')

@section('title','My Address')
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3 bg-white">
        <div class="container-fluid ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.shop') }}">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    @include('new-frontend.layouts.inc.aside')

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-address" role="tabpanel" aria-labelledby="tab-address-link">
                                <div class="mb-1">
                                    <a class="btn btn-primary" href="{{ url('my-address') }}">
                                        <i class="icon-long-arrow-left"></i>
                                        <span>Back</span>
                                    </a>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card card-dashboard bg-white">
                                            <div class="card-body">
                                                <h3 class="card-title text-center">
                                                    Edit My Address
                                                </h3>
                                                <form action="{{ url('update-address/'.$address['id']) }}" method="POST" enctype="multipart/form-data" >
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label style="font-weight: 500;">First Name *</label>
                                                            <input id="fname" required placeholder="Ex. Juan" type="text"  class="form-control border @error('fname') is-invalid @enderror"
                                                                name="fname" @if(isset($address['fname'])) value="{{ $address['fname'] }}" @else value="{{ old('fname') }}" @endif autocomplete="off">
                                                            @error('fname')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ ('First name is required') }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div><!-- End .col-sm-6 -->

                                                        <div class="col-sm-6">
                                                            <label style="font-weight: 500;">Last Name *</label>
                                                            <input id="lname" required placeholder="Ex. Dela Cruz" type="text" class="form-control border @error('lname') is-invalid @enderror"
                                                            name="lname" @if(isset($address['lname'])) value="{{ $address['lname'] }}" @else value="{{ old('lname') }}" @endif autocomplete="off" >
                                                            @error('lname')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ ('Last name is required') }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div><!-- End .col-sm-6 -->
                                                    </div><!-- End .row -->
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <label style="font-weight: 500;" for="contact-no">Contact No *</label>
                                                            <input id="contact-no"  placeholder="Enter you contact no." type="tel" title="Format: 09xx-xxx-xxxx" pattern="[0]{1}[9]{1}[0-9]{2}-[0-9]{3}-[0-9]{4}" required maxlength="13" id="contact-no" type="text"
                                                                class="form-control border @error('phone_no') is-invalid @enderror" name="phone_no" @if(isset($address['phone_no'])) value="{{ $address['phone_no'] }}" @else value="{{ old('phone_no') }}" @endif  autocomplete="off">

                                                                @error('phone_no')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ ('Contact number is required') }}</strong>
                                                                    </span>
                                                                @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label style="font-weight: 500;" for="options">City *</label>
                                                            <select id="options" required class="custom-select border form-control @error('city') is-invalid @enderror"  name="city">
                                                                <option value="" disabled hidden selected>Please select...</option>
                                                                <option value="Bocaue">Bocaue</option>
                                                                <option value="Marilao">Marilao</option>
                                                                <option value="Meycauayan">Meycauayan</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label style="font-weight: 500;" for="choices">Barangay</label>
                                                            <select id="choices" required class="custom-select border form-control @error('barangay') is-invalid @enderror"  name="barangay">
                                                                <option value="" disabled selected>Please select city first...</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <select id="pc" style="display: none" class=" form-control @error('postal_code') is-invalid @enderror" name="postal_code">
                                                                <option value="" disabled hidden selected></option>
                                                              </select>
                                                              @error('postal_code')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ ('Postal code is required') }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <label style="font-weight: 500;" for="detailed-address">Detailed Address *</label>
                                                            <small class="form-text">Unit number, house number, building, street name</small>
                                                            <input required id="detailed-address" placeholder="Set Detailed Address" type="text" class="form-control @error('detailed_address') is-invalid @enderror" name="detailed_address" value="{{ old('detailed_address') }}"  autocomplete="off" >
                                                                @error('detailed_address')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ ('Please set your detailed address') }}</strong>
                                                                    </span>
                                                                @enderror
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">
                                                        <span>SAVE CHANGES</span>
                                                        <i class="icon-long-arrow-right"></i>
                                                    </button>
                                                </form>
                                            </div><!-- End .card-body -->
                                        </div><!-- End .card-dashboard -->
                                    </div><!-- End .col-lg-6 -->
                                </div><!-- End .row -->
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main><!-- End .main -->


<!-- JQuery CDN-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    var tele = document.querySelector('#contact-no');

    tele.addEventListener('keyup', function(e){
    if (event.key != 'Backspace' && (tele.value.length === 4 || tele.value.length === 8)){
    tele.value += '-';
    }
    });

</script>

<script src="{{ asset('assets/js/custom.js') }}"></script>

<script src="{{ asset('assets/js/auto-select.js') }}"></script>

@section('scripts')
        @if(session('success'))
        <script>
            swal("",{
                title: "{{ session('success') }}",
                icon: "success"
            });
        </script>
        @endif
    @endsection
@endsection
