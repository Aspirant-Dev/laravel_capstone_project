@extends('new-frontend.layouts.front')
@section('title')
    Verify Account
@endsection
@section('content')
<div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-color: #e2e2e2">
    <div class="container">
        <div class="form-box">
            <div class="form-tab">
                <ul class="nav nav-pills nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="verify-tab" data-toggle="tab" href="#verify" role="tab" aria-controls="verify" aria-selected="true">Verify Your Account</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="verify" role="tabpanel" aria-labelledby="verify-tab">
                        @if (session('resent'))
                                <div class="alert alert-success alert-dismissible mb-2 mt-2">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                            @endif
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            <br>
                            <br>
                            {{ __('If you did not receive the email') }},

                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf

                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline" style="font-weight: bold;">
                                    {{ __('click here to request another') }}
                                </button>.
                            </form>
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .form-tab -->
        </div><!-- End .form-box -->
    </div><!-- End .container -->
</div><!-- End .login-page section-bg -->
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection
<!-- </body> -->
<!-- </html> -->
