<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/admin/css/adminlte.min.css') }}">


  {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

</head>
<body class="login-page">
    <div style="width: 100%; margin-top: 130px; padding: 10px;  max-width: 30rem;">
        <div class="login-logo">
            <b>Admin</b>Panel</a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <h5 class="login-box-msg">Sign in to start your session.</h5>

                <form action="{{ route('admin.login.submit') }}" method="POST">
                   @csrf

                    @if (session('alert'))
                        <label class="text-danger">
                            {{ session('alert') }}
                        </label>
                        <br>
                    @endif
                    @error('username')
                        <label class="text-danger">
                            {{ $message }}
                        </label>
                        <br>
                    @enderror

                    <label for="showPassword">Username *</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control @if (session('alert')) is-invalid @endif" value="{{ old('username') }}" autocomplete="off"  autofocus placeholder="Enter Username" name="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <label class="text-danger">
                            {{ $message }}
                        </label>
                    @enderror
                    <label for="showPassword">Password *</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <input type="checkbox" id="showPassword" />
                    <label for="showPassword">Show password</label>

                    <div class="form-group">
                        <input type="submit" name="btn" value="Login" class="btn btn-success col-md-12">
                    </div>
                    <div class="form-group">
                        @if (Route::has('admin.password.request'))
                        <a class="btn btn-link" href="{{ route('admin.password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- jQuery -->
<script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/admin/js/adminlte.min.js')}}"></script>
<script>
    document.getElementById('showPassword').onclick = function() {
    if ( this.checked ) {
       document.getElementById('password').type = "text";
    } else {
       document.getElementById('password').type = "password";
    }
};
</script>
</body>
</html>
