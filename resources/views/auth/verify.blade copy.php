@extends('layouts.front')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Verify Email</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/landing_page/assets/logo.png') }}" />
    <!-- Scripts -->
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
<body>
    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div style="width: 100%; margin-top: 10px; padding: 10px;  max-width: 30rem;">
                    <div class="login-logo">
                        <b>Verify Account </b><span><i class="fas fa-user"></i> </span></a>
                    </div>

                    <div class="card">
                        <div class="card-body login-card-body">
                            <h5 class="login-box-msg">Verify Your Email Address</h5>

                            @if (session('resent'))
                                <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                            @endif

                                                        {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},

                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf

                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                                    {{ __('click here to request another') }}
                                </button>.
                            </form>
                            {{-- {{ __('If you did not receive the email') }}, <a style="color: blue !important" href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>. --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    @endsection
<!-- </body> -->
<!-- </html> -->
