@extends('new-frontend.layouts.front')
@section('title','My Account')

@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3 bg-white">
        <div class="container">
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
                        <div class="col-md-8 col-lg-9 py-5 bg-white" style=" border:1px solid rgb(184, 184, 184);">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                                    <p>Hello <span class="font-weight-normal text-dark">{{ Auth::user()->fname }},</span>
                                    <br>
                                    From your account dashboard you can view your <a href="{{ route('user.all.orders') }}" class=" link-underline">recent orders</a>,
                                    manage your <a href="{{ route('user.address') }}" class=" link-underline">shipping addresses</a>, and
                                    <a href="{{ route('user.profile') }}" class=" link-underline">edit your password and account details</a>.</p>
                                </div><!-- .End .tab-pane -->

                                @if(!Auth::user()->hasVerifiedEmail())
                                    @if (session('resent'))
                                                <div class="alert alert-success alert-dismissible mb-2 mt-2">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                                    </div>
                                            @endif
                                    <div class="row text-center">
                                        <div class="col-sm-12">

                                            <label><strong>Note: </strong>
                                                <span>
                                                    Your account is not yet verify. Please check your email for a verification link.

                                                    {{ __('If you did not receive the email') }},

                                                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                                        @csrf

                                                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline" style="font-weight: bold;">
                                                            {{ __('click here to request another') }}
                                                        </button>.
                                                    </form>
                                                </span>
                                            </label>
                                            {{-- <input type="text" class="form-control" name="fname" value="{{ Auth::user()->fname }}" required> --}}
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->
                                @endif

                            </div>
                        </div><!-- End .col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .dashboard -->
        </div>
    </div><!-- End .page-content -->
</main><!-- End .main -->
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection
