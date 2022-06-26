@extends('new-frontend.layouts.front')
@section('title')
    Reset Password
@endsection

@section('content')
<div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-color: #e2e2e2">
    <div class="container">
        <div class="form-box">
            <div class="form-tab">
                <ul class="nav nav-pills nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="email-tab" data-toggle="tab" href="#email" role="tab" aria-controls="email" aria-selected="true">Reset Password</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="email" role="tabpanel" aria-labelledby="email-tab">
                            <center>
                                {{ __('You forgot your password? Here you can easily retrieve a new password.') }}
                            </center>
                            <br>
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible mb-1">
                                    <button type="button" class="close btnclose" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                                {{ session('status')}}
                                </div>
                        @endif

                        @error('email')
                            <div class="alert alert-danger alert-dismissible mb-1">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5 class="text-white"><i class="icon fas fa-times"></i> Oops!</h5>
                                {{ $message }}
                            </div>
                        @enderror

                        <form method="POST" action="{{ route('password.email') }}" class="needs-validation" novalidate>
                            @csrf

                            <div class="input-group mb-3">
                                <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Email Address" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                <div class="invalid-feedback text-start fw-bold"><strong>Enter your email address to proceed.</strong></div>

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
                                </div>
                            </div>
                            <div class="form-footer"></div><!-- End .form-footer -->

                            <a href="{{ route('login') }}" class="forgot-link"><i class="icon-long-arrow-left"></i> Login</a>
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
