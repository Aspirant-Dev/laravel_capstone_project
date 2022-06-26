@extends('layouts.front')
<head>
    <title>
        RVE | Register
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

</head>
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div style="width: 100%; margin-top: 10px; padding: 10px;  max-width: 40rem;">
                <div class="login-logo">
                    <b>Account </b>Registration</a>
                </div>

                <div class="card">
                    <div class="card-body login-card-body">
                        <h5 class="login-box-msg" style="color: #0d6efd">Create a new account.</h5>

                        <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">


                            <!-- Email Address -->
                            <div class="col-md-6">
                                <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
                                <input id="email" placeholder="example@gmail.com" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Username -->
                            <div class="col-md-6">
                                <label for="username" class="col-form-label">{{ __('Username') }}</label>
                                <input id="username" placeholder="Enter username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="off" >

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <!-- Password -->
                            <div class="col-md-6">
                                <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                <input id="password" value="{{ old('password') }}" placeholder="Must be at least 8 characters " minlength="8" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Confirm Password -->
                            <div class="col-md-6">
                                <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" placeholder="Confirm password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <hr class="mt-3">
                            </div>
                        </div>

                        <!-- First Name && Last Name -->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="fname" class="col-md-6 col-form-label">{{ __('First Name') }}</label>
                                <input id="fname"  placeholder="Ex. Juan" type="text"  class="form-control @error('fname') is-invalid @enderror"
                                name="fname" value="{{ old('fname') }}"  autocomplete="off">

                                @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ ('First name is required') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="lname" class="col-md-6 col-form-label">{{ __('Last Name') }}</label>
                                <input id="lname" placeholder="Ex. Dela Cruz" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}"  autocomplete="off" >
                                @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ ('Last name is required') }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="contact-no" class="col-form-label">{{ __('Contact No.') }}<small style="font-style: italic"> (09xx-xxx-xxxx)</small></label>
                                <input id="contact-no"  placeholder="Enter you contact no." type="tel" pattern="[0]{1}[9]{1}[0-9]{2}-[0-9]{3}-[0-9]{4}" id="contact-no" required
                                 class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}"  autocomplete="off">

                                @error('phone_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ ('Contact number is required') }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row">
                            <p style="font-style:italic; margin-top: 2px; margin-bottom: -2px"><small><b>Note: </b>Please select first the city to choose barangay and the postal code will auto filled.</small></p>
                            <!-- City -->
                            <div class="col-md-4">
                                <label for="city" class=" col-form-label">{{ __('City') }}</label>
                                <select id="options" class="custom-select form-control @error('city') is-invalid @enderror" name="city">
                                    <option value="" disabled hidden selected>Please select...</option>
                                    <option value="Bocaue">Bocaue</option>
                                    <option value="Marilao">Marilao</option>
                                    <option value="Meycauayan">Meycauayan</option>
                                  </select>
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ ('Please select a city in the list') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <!-- Barangay -->
                                <label for="barangay" class=" col-form-label">{{ __('Barangay') }}</label>
                                <select id="choices" class="custom-select form-control @error('barangay') is-invalid @enderror" name="barangay">
                                    <option value="" disabled hidden selected>Please select...</option>
                                  </select>
                                @error('barangay')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ ('Please select a barangay in the list') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <!-- Postal Code -->
                                <label for="postal-code" class=" col-form-label">{{ __('Postal Code') }}</label>
                                <select id="pc" class=" form-control @error('postal_code') is-invalid @enderror" name="postal_code">
                                    <option value="" disabled hidden selected></option>
                                  </select>
                                  @error('postal_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ ('Postal code is required') }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Detailed Address -->
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="detailed-address" class="col-form-label">{{ __('Detailed Adress') }}</label>
                                <p style="margin-top: -8px; margin-bottom: 10px"><small>Unit number, house number, building, street name</small></p>
                                <input id="detailed-address" placeholder="Set Detailed Address" type="text" class="form-control @error('detailed_address') is-invalid @enderror" name="detailed_address" value="{{ old('detailed_address') }}"  autocomplete="off" >
                                @error('detailed_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ ('Please set your detailed address') }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" required name="terms" id="terms" {{ old('terms') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="terms">
                                        {{ __('I accept the terms and conditions.') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                            <div class="form-group">
                                <input type="submit" name="btn" value="Register" class="btn btn-success col-md-12">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('scripts')
    <script src="{{ asset('assets/js/auto-select.js') }}"></script>
@endsection
@endsection
