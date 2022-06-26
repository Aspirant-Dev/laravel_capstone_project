<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/landing_page/assets/logo.png') }}" />

        <title>Admin | Maintenance</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jqvmap/jqvmap.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/admin/css/adminlte.min.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.css') }}">
        <!-- summernote -->
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.css') }}">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <style>
            @media all and (min-width: 992px) {
                .navbar .nav-item .dropdown-menu{ display: none; }
                .navbar .nav-item:hover .nav-link{   }
                .navbar .nav-item:hover .dropdown-menu{ display: block; }
                .navbar .nav-item .dropdown-menu{ margin-top:0; }
                }
        </style>
    </head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        @include('layouts.inc.admin.navbar')

        <!-- Main Sidebar Container -->
        @include('layouts.inc.admin.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit/Update Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Category</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-1 mb-3">
                    <div class="col-md-4">
                        <a href="{{ url('/admin/categories') }}" class="btn btn-success"><i class="fas fa-arrow-left"></i> Back </a>
                    </div>
                </div>
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                     <!-- form start -->
                                    <form action="{{ url('/admin/update-category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="CategoryName">Category Name</label>
                                                    <input type="text" class="form-control" name="name" value="{{ $category->name }}" required id="CategoryName" placeholder="Enter Category Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="">Category Status</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                              <!-- checkbox Status-->
                                              <div class="form-group">
                                                <div class="form-check">
                                                  <input class="form-check-input" name="status" {{ $category->status  == "1" ? 'checked':'' }} type="checkbox">
                                                  <label class="form-check-label">Active</label>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <!-- checkbox Popular-->
                                                <div class="form-group">
                                                  <div class="form-check">
                                                    <input class="form-check-input" name="popular" {{ $category->popular  == "1" ? 'checked':'' }}  type="checkbox">
                                                    <label class="form-check-label">Popular</label>
                                                  </div>
                                                </div>
                                              </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                              <!-- textarea -->
                                              <div class="form-group">
                                                <label>Category Description</label>
                                                <textarea id="summernote" class="form-control" rows="1" name="description" required >{!!  $category->description  !!}</textarea>
                                              </div>
                                            </div>
                                        </div>
                                        @if($category->image)
                                            <label for="">Current Image</label>
                                            <center>
                                                <img src="{{ asset('uploads/categories/'.$category->image) }}" width="480px" height="480px"  alt="Product Img" >
                                            </center>
                                        @endif

                                        <div class="form-group">
                                            <label >Upload file</label>
                                            <input onchange="loadFile(event)" type="file" name="image" class="form-control" >
                                        </div>

                                          <label style="magin-top: 10px; display:none" id="label-output">New Uploaded Image</label>
                                          <img id="output" style="display:none;  margin-bottom: 10px; background-size: cover; width: 100%; height: 500px;"/>
                                          <button type="submit" class="btn btn-success btn-block">Submit <i class="fas fa-arrow-right"></i></button>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


<!-- jQuery -->
<script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('assets/admin/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('assets/admin/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('assets/admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('assets/admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('assets/admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/admin/js/adminlte.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/admin/js/demo.js') }}"></script>

<!-- SweetAlert -->
{{-- <script src="{{ asset('http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js') }}"></script> --}}
<script src="{{ asset('assets/js/sweetalert.js') }}"></script>

<script>
    $(function () {
        // Summernote
        $('#summernote').summernote({
            placeholder: 'Enter category description here...',
            spellcheck: true,
            tabsize: 2,
            height: 200,
        // toolbar
            toolbar: [
                ['view', ['fullscreen','undo','redo']],
                ['style', ['style']],
                // ['font', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                // ['table', ['table']],
                ['insert', ['link', 'hr']],
            ],
        });
    })
</script>
<script>
    var loadFile = function(event) {
        document.getElementById("label-output").style.display = "inline-block";
        document.getElementById("output").style.display = "inline-block";
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
<!-- Custom Script -->
@if(session('alert'))
        <script>
             swal(" ",{
                  title: "{{ session('alert') }}",
                  icon: 'success',
                  buttons: false,
                  timer: 2000,
                  closeOnClickOutside: false,
                  });
        </script>
    @endif
</body>
</html>
