@extends('layouts.front')

<head>
    <title>Reset Password</title>


    <script src="{{ asset('js/app.js') }}" defer></script>

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
        <div style="width: 100%; margin-top: 10px; padding: 10px;  max-width: 30rem;">
            <div class="login-logo">
              <a><b>Reset</b> Password</a>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close btnclose" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> Success!</h5>
                            {{ session('status') }}
                            </div>
                    @endif

                    @error('email')
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-times"></i> Oops!</h5>
                            {{ $message }}
                        </div>
                    @enderror

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Email Address" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="input-group mb-3">
                            <label id="email" class=" @error('email') is-invalid @enderror"></label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div> --}}
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
                            </div>
                        </div>
                    </form>

                    <p class="mt-3 mb-1">
                        @if (Route::has('login'))
                            <a style="color: #0d6efd" href="{{ route('login') }}">

                                <span><i class="fas fa-arrow-left"></i></span>
                                {{ __('Login') }}
                            </a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


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
