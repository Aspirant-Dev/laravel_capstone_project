@extends('new-frontend.layouts.front')
@section('title')
    Change Password
@endsection

@section('content')
<div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-color: #e2e2e2">
    <div class="container">
        <div class="form-box">
            <div class="form-tab">
                <ul class="nav nav-pills nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="verify-tab" data-toggle="tab" href="#verify" role="tab" aria-controls="verify" aria-selected="true">Change Password</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="verify" role="tabpanel" aria-labelledby="verify-tab">
                            <center>
                                {{ __('You are only one step a way from your new password, recover your password now.') }}
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

                        <form method="POST" action="{{ route('password.update') }}"  oninput='password_confirmation.setCustomValidity(password_confirmation.value != password.value ? "Passwords do not match." : "")'>
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <!-- Email Address -->
                                <div class="input-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email">
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                      </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <label class=" @error('email') is-invalid @enderror"></label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" minlength="8" placeholder="Password" name="password" required>
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                      </div>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <label class=" @error('password') is-invalid @enderror"></label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="input-group">
                                    <label></label>
                                </div>
                                <div class="input-group mb-3">
                                    <input  type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" required>
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                      </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Reset Password') }}
                                        </button>
                                    </div>
                                </div>

                            </form>
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .form-tab -->
        </div><!-- End .form-box -->
    </div><!-- End .container -->
</div><!-- End .login-page section-bg -->
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
