@extends('new-frontend.layouts.front')

@section('title','My Profile')

@section('content')
{{-- <main class="main"> --}}
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container-fluid bg-white">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.shop') }}">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
<div class="container-fluid " style="margin-top: -30px">
    <div class="page-content p-5">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    @include('new-frontend.layouts.inc.aside')

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">

                                <form class=" p-4 bg-white shadow" style="border:1px solid rgb(184, 184, 184);" action="{{ route('user.update-account') }}" method="POST" oninput='password_confirmation.setCustomValidity(password_confirmation.value != password.value ? "Passwords do not match." : "");
                                email.setCustomValidity(current_email.value == email.value ? "You are inputted a same email." : "")'>
                                    @csrf
                                    @method('PUT')

                                    <ul class="nav nav-pills nav-fill mb-3" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" ><h3 class="text-primary">My Account</h3></a>
                                        </li>
                                    </ul>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>First Name *</label>
                                            <input autocomplete="off" type="text" class="form-control" name="fname" value="{{ Auth::user()->fname }}" required>
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Last Name *</label>
                                            <input autocomplete="off" type="text" class="form-control" name="lname" value="{{ Auth::user()->lname }}" required>
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <label>Contact No * (09xx-xxx-xxxx)</label>
                                    <input autocomplete="off" id="contact-no"  placeholder="Enter you contact no." type="tel" pattern="[0]{1}[9]{1}[0-9]{2}-[0-9]{3}-[0-9]{4}" maxlength="13" required
                                            class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ Auth::user()->phone_no }}"  autocomplete="off">

                                    <label>Current Email</label>
                                    <input readonly type="email" class="form-control" name="current_email" value="{{ Auth::user()->email }}" required>
                                    <hr>
                                    <label>New Email *  (leave blank to leave unchanged)</label>
                                    <input placeholder="example@gmail.com" value="{{ old('email') }}" type="email" pattern="[a-z0-9._%+-]+@[gmail]+\.com" title="Format: example@gmail.com " class="form-control @error('email') is-invalid @enderror" name="email">
                                    @error('email')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span> <br>
                                    @enderror
                                    @if(session('error_email'))
                                        <span class="text-danger">
                                            <strong>{{ session('error_email') }}</strong>
                                        </span> <br>
                                    @endif
                                    <label>Current password (leave blank to leave unchanged)</label>
                                    <input type="password" class="form-control @if(session('error')) is-invalid @endif @error('current_password') is-invalid @enderror" value="{{ old('current_password') }}" name="current_password">
                                    @error('current_password')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span> <br>
                                    @enderror
                                    @if(session('error'))
                                        <span class="text-danger">
                                            <strong>{{ session('error') }}</strong>
                                        </span> <br>
                                    @endif

                                    <label>New password (leave blank to leave unchanged)</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                    @error('password')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span> <br>
                                    @enderror

                                    <label>Confirm new password</label>
                                    <input type="password" value="{{ old('password_confirmation') }}" class="form-control @error('password_confirmation') is-invalid @enderror mb-2" name="password_confirmation">
                                    @error('password_confirmation')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span> <br>
                                    @enderror

                                    <button type="submit" class="btn btn-primary">
                                        <span>SAVE CHANGES</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form>
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</div>
{{-- </main><!-- End .main --> --}}


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
