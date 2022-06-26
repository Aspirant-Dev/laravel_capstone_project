@extends('new-frontend.layouts.front')
@section('title')
    Register
@endsection

<head>
    <style>
        .pw:focus
        {
            border: 1px solid #445f84 !important;
            /* border-right: 0px !important; */
        }
    </style>
</head>
@section('content')

<main class="main">
    @include('new-frontend.layouts.inc.modal-privacy')
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0 bg-white">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Register</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('{{ asset('assets/image/Real Value Enterprise 2.jpg') }}')">
        <div class="container">
            <div class="form-box ">
                <div class="form-tab">
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link @if(Route::is('login')) active @endif" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Route::is('register')) active @endif " id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">Register</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade  @if(Route::is('login')) show active @endif " id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
                            <form method="post" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label style="font-weight: 500;" for="singin-email-2">Username  *</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="singin-email-2" name="username" value="{{ old('username') }}"autofocus autocomplete="username"  placeholder="Enter your username">
                                    @error('username')
                                        <span class="invalid-feedback " role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div><!-- End .form-group -->

                                <label style="font-weight: 500;" for="password">Password *</label><br>
                                <div class="input-group">
                                    <input type="password" class="form-control border-right-0  bg-white pw @error('password') is-invalid @enderror" id="password" name="password"  autocomplete="off" placeholder="Enter your password" style="border: 1px solid #ebebeb;">
                                    <div class="input-group-append border-left-0">
                                        <div class="input-group-text" style="border: 1px solid #ebebeb; background-color:transparent !important;">
                                            <i style="cursor: pointer; font-size:20px;" id="togglePassword" class="bi bi-eye-slash-fill"></i>
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div><!-- End .input-group -->
                                <div class="form-footer mt-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="signin-remember-2"
                                                name="remember" {{ old('remember') ? 'checked' : '' }} style="cursor: pointer!important;">
                                        <label style="font-weight: 500;" class="custom-control-label" for="signin-remember-2">Remember Me</label>
                                    </div><!-- End .custom-checkbox -->

                                    <a style="font-weight: 500;" href="{{ route('password.request') }}" class="forgot-link">Forgot Your Password?</a>
                                </div><!-- End .form-footer -->
                                <div class="form-choice">
                                    <div class="row">
                                        <div class="col-12 col-lg-12 col-xl-12 col-lg-12">
                                            <center>
                                                <div class="w-100">
                                                    <button type="submit" class="btn btn-block btn-primary">
                                                        <span>LOG IN</span>
                                                        <i class="icon-long-arrow-right"></i>
                                                    </button>
                                                </div><!-- End .btn-wrap -->
                                            </center>
                                        </div><!-- End .col-md-4 col-lg-2 -->
                                    </div>
                                </div>
                            </form>
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade @if(Route::is('register')) show active @endif " id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
                            <form method="POST" action="{{ route('register') }}" oninput='password_confirmation.setCustomValidity(password_confirmation.value != password.value ? "Passwords do not match." : "")'>
                                @csrf

                                <!-- First Name && Last Name -->
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label style="font-weight: 500;" for="fname" class="col-md-6 col-form-label">{{ __('First Name *') }}</label>
                                        <input id="fname"  placeholder="Ex. Juan" type="text"  class="form-control @error('fname') is-invalid @enderror"
                                        name="fname" value="{{ old('fname') }}"  autocomplete="off" required>

                                        @error('fname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ ('First name is required') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label style="font-weight: 500;" for="lname" class="col-md-6 col-form-label">{{ __('Last Name *') }}</label>
                                        <input id="lname" placeholder="Ex. Dela Cruz" required type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}"  autocomplete="off" >
                                        @error('lname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ ('Last name is required') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: 500;" for="register-email-2">Your email address *</label>
                                    <input id="register-email-2"  placeholder="example@gmail.com" type="email" pattern="[a-z0-9._%+-]+@[gmail]+\.com" title="Format: example@gmail.com " class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div><!-- End .form-group -->
                                <div class="form-group">
                                    <label style="font-weight: 500;">Your username *</label>
                                    <input placeholder="Enter your username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="off" >

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div><!-- End .form-group -->

                                <div class="form-group row">
                                    <!-- Password -->
                                    <div class="col-md-6">
                                        <label style="font-weight: 500;" for="password1">Password *</label><br>
                                        <div class="input-group">
                                            <input type="password" required class="form-control border-right-0  bg-white pw @error('password') is-invalid @enderror" id="password1" name="password"  autocomplete="off" placeholder="Must be atleast 8 character" style="border: 1px solid #ebebeb;">
                                            <div class="input-group-append border-left-0">
                                                <div class="input-group-text" style="border: 1px solid #ebebeb; background-color:transparent !important;">
                                                    <i style="cursor: pointer; font-size:20px;" id="togglePassword1" class="bi bi-eye-slash-fill"></i>
                                                </div>
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div><!-- End .input-group -->
                                    </div>
                                    <!-- Confirm Password -->
                                    <div class="col-md-6">
                                        <label style="font-weight: 500;" for="password-confirm">{{ __('Confirm Password *') }}</label><br>
                                        <div class="input-group">
                                            <input type="password" class="form-control border-right-0  bg-white pw @error('password') is-invalid @enderror" id="password-confirm" name="password_confirmation" required autocomplete="off" placeholder="Confirm Password" style="border: 1px solid #ebebeb;">
                                            <div class="input-group-append border-left-0">
                                                <div class="input-group-text" style="border: 1px solid #ebebeb; background-color:transparent !important;">
                                                    <i style="cursor: pointer; font-size:20px;" id="togglepassword-confirm" class="bi bi-eye-slash-fill"></i>
                                                </div>
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div><!-- End .input-group -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label style="font-weight: 500;" for="contact-no" class="col-form-label">{{ __('Contact No. *') }}<small style="font-style: italic"> (09xx-xxx-xxxx)</small></label>
                                        <input id="contact-no"  placeholder="Enter you contact no." type="tel" pattern="[0]{1}[9]{1}[0-9]{2}-[0-9]{3}-[0-9]{4}" maxlength="13" required
                                         class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}"  autocomplete="off">

                                        @error('phone_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ ('Contact number is required') }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <!-- City -->
                                    <div class="col-md-6">
                                        <label style="font-weight: 500;" for="city" class=" col-form-label">{{ __('City *') }}</label>
                                        <select id="options" class=" form-control @error('city') is-invalid @enderror" name="city" required title="Please select a city.">
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
                                    <div class="col-md-6">
                                        <!-- Barangay -->
                                        <label style="font-weight: 500;" for="barangay"  class=" col-form-label">{{ __('Barangay *') }}</label>
                                        <select id="choices" required class=" form-control @error('barangay') is-invalid @enderror" name="barangay">
                                            <option value="" disabled hidden selected>Please select city first...</option>
                                          </select>
                                        @error('barangay')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ ('Please select a barangay in the list') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Postal Code -->
                                        <label  for="postal-code" style="display: none; font-weight: 500;" class=" col-form-label">{{ __('Postal Code') }}</label>
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

                                <!-- Detailed Address -->
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label style="font-weight: 500;" for="detailed-address" class="col-form-label">{{ __('Detailed Adress *') }}</label>
                                        <p style="margin-top: -8px; margin-bottom: 10px"><small>Unit number, house number, building, street name</small></p>
                                        <input id="detailed-address" required title="Please enter your detailed address." placeholder="Set Detailed Address" type="text" class="form-control @error('detailed_address') is-invalid @enderror" name="detailed_address" value="{{ old('detailed_address') }}"  autocomplete="off" >
                                        @error('detailed_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ ('Please set your detailed address') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                        <label style="font-weight: 500;" class="custom-control-label" for="register-policy-2">I agree to the <a href="#privacyModal" data-toggle="modal">privacy policy</a> *</label>
                                    </div><!-- End .custom-checkbox -->
                                </div><!-- End .form-footer -->
                                <div class="form-choice">
                                    <div class="row">
                                        <div class="col-12 col-lg-12 col-xl-12 col-lg-12">
                                            <center>
                                                <div class="w-100">
                                                    <button type="submit" class="btn btn-block btn-primary">
                                                        <span>SIGN UP</span>
                                                        <i class="icon-long-arrow-right"></i>
                                                    </button>
                                                </div><!-- End .btn-wrap -->
                                            </center>
                                        </div><!-- End .col-md-4 col-lg-2 -->
                                    </div>
                                </div>
                            </form>
                        </div><!-- .End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .form-tab -->
            </div><!-- End .form-box -->
        </div><!-- End .container -->
    </div><!-- End .login-page section-bg -->
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
<script>
    //login
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye / eye slash icon
        this.classList.toggle('bi-eye');
    });
    // register
    const togglePassword1 = document.querySelector('#togglePassword1');
    const password1 = document.querySelector('#password1');
    togglePassword1.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
        password1.setAttribute('type', type);
        // toggle the eye / eye slash icon
        this.classList.toggle('bi-eye');
    });
    const togglePasswordConfirm = document.querySelector('#togglepassword-confirm');
    const passwordConfirm = document.querySelector('#password-confirm');
    togglePasswordConfirm.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordConfirm.setAttribute('type', type);
        // toggle the eye / eye slash icon
        this.classList.toggle('bi-eye');
    });
</script>
@if(session('status'))
    <script>
            swal(" ",{
                title: "{{ session('status') }}",
                icon: 'success',
                closeOnClickOutside: false,
                });
    </script>
@endif
@section('scripts')
    <script src="{{ asset('assets/js/auto-select.js') }}"></script>
@endsection
@endsection



