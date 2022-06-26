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

        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.css') }}">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <style>
            @media all and (min-width: 992px) {
                .navbar .nav-item .dropdown-menu{ display: none; }
                .navbar .nav-item:hover .nav-link{   }
                .navbar .nav-item:hover .dropdown-menu{ display: block; }
                .navbar .nav-item .dropdown-menu{ margin-top:0; }
                }.note-editable {
                    font-family: 'Poppins' !important;
                    font-size: 16px !important;
                    text-align: left !important;

                    height: 350px !important;

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
                        <h1 class="m-0">Edit/Update Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Product</li>
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
                        <a href="{{ route('admin.products') }}" class="btn btn-success"><i class="fas fa-arrow-left"></i> Back </a>
                    </div>
                </div>
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                     <!-- form start -->
                                    <form action="{{ url('/admin/update-product/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <span><b>Note:</b> <span>Product Code is auto generated.</span></span>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label>Select a Category</label>
                                                  <select required class="select2bs4 form-control" name="cate_id">
                                                    @foreach ($categories as $item )
                                                        <option value="{{ $item->id }}" {{ $product->cate_id == $item->id  ? 'selected' : ''}}>{{ $item->name }}</option>
                                                    @endforeach
                                                  </select>
                                                </div>
                                              </div>
                                              <div class="col-sm-6">
                                                  <div class="form-group">
                                                      <label for="CategoryName">Product Code</label>
                                                      <input type="text" required class="form-control" name="pcode" readonly value="{{ $product->p_code }}" id="exampleInputEmail1" placeholder="Enter Product Code">
                                                  </div>
                                              </div>
                                            </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="CategoryName">Product Name</label>
                                                    <input type="text" class="form-control" value="{{ $product->name }}" name="name" required id="exampleInputEmail1" placeholder="Enter Category Name">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <!-- Product Type -->
                                                <div class="form-group">
                                                  <label>Product Type</label>
                                                  <input class="form-control" name="type" value="{{ $product->product_type }}" required placeholder="Enter product type...">
                                                </div>
                                              </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                              <!-- Brand  -->
                                              <div class="form-group">
                                                <label>Brand</label>
                                                <input class="form-control" required name="brand" value="{{ $product->brand }}" placeholder="Enter product brand...">
                                              </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                  <label>Select Unit</label>
                                                  <select required class="select2bs4 form-control" name="unit">
                                                    @foreach ($units as $item )
                                                        <option value="{{ $item->unit_name }}" {{ $product->unit == $item->unit_name  ? 'selected' : ''}}>{{ $item->unit_name }}</option>
                                                    @endforeach
                                                  </select>
                                                </div>
                                              </div>
                                        </div>
                                        <div class="row">
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="CategoryName">Product Price</label>
                                                    <input type="number" class="form-control" name="price" value="{{ $product->price }}"  required id="exampleInputEmail1" placeholder="Enter Product Price">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Product Stocks</label>
                                                    @if ($product->stocks <= 0)
                                                        <input type="number" class="form-control" name="stocks" value="0" required id="exampleInputEmail1" placeholder="Enter Product Stocks">
                                                    @else
                                                        <input type="number" class="form-control" name="stocks" value="{{ $product->stocks }}" required id="exampleInputEmail1" placeholder="Enter Product Stocks">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Critical Level</label>
                                                    <input type="number" class="form-control" name="critical_level" value="{{ $product->critical_level }}" required min="1" placeholder="Enter Critical Level">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Product Status</label>
                                                <div class="row">
                                                    <!-- checkbox Status-->
                                                    <div class="col-sm-4">
                                                      <div class="form-group">
                                                        <div class="form-check">
                                                          <input class="form-check-input" name="status" {{ $product->status  == "1" ? 'checked':'' }} type="checkbox">
                                                          <label class="form-check-label" >Active</label>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!-- checkbox Popular-->
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <div class="form-check">
                                                            <input class="form-check-input" name="trending" {{ $product->trending  == "1" ? 'checked':'' }} type="checkbox">
                                                            <label class="form-check-label">Featured</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Is Returnable Product?</label>
                                                <div class="row">
                                                    <!-- checkbox Status-->
                                                    <div class="col-sm-12">
                                                      <div class="form-group">
                                                        <div class="form-check">
                                                          <input class="form-check-input" name="returnable" {{ $product->returnable  == "1" ? 'checked':'' }} type="checkbox">
                                                          <label class="form-check-label" >Check if it 'YES'</label>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                              <!-- textarea -->
                                              <div class="form-group">
                                                <label>Product Description</label>
                                                <textarea id="summernote" class="form-control" rows="1" name="description" required placeholder="Enter description...">{{ $product->description }}</textarea>
                                              </div>
                                            </div>
                                        </div>
                                        @if($product->image)

                                        <label for="">Current Image</label>
                                        <center>
                                            <img src="{{ asset('uploads/products/'.$product->image) }}" width="480px" height="480px"  alt="Product Img" >
                                        </center>
                                        @endif
                                        <div class="form-group">
                                            <label>Upload Product Image</label>
                                            <input onchange="loadFile(event)" class="form-control" type="file" accept="image/png, image/gif, image/jpeg" name="image">
                                        </div>

                                        <label style="magin-top: 10px; display:none" id="label-output">New Uploaded Image</label>
                                        <img id="output" style="display:none;  margin-bottom: 10px; background-size: cover; width: 100%; height: 500px;"/>
                                        <button type="submit" class="btn btn-success btn-block">Update</button>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<!-- ./wrapper -->

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
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/admin/js/adminlte.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/admin/js/demo.js') }}"></script>
<script>
    $(function () {
        // Summernote
        var gArrayFonts = ['Poppins'];

            $('#summernote').summernote({
                placeholder: 'Enter product description here...',
                spellcheck: true,
                tabsize: 2,
                required: true,
                height: 200,
            // toolbar
            fontNames: gArrayFonts,
    fontNamesIgnoreCheck: gArrayFonts,
    fontSizes: ['16'],
    followingToolbar: false,
    dialogsInBody: true,

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
<script>
    $(function () {
   //Initialize Select2 Elements
   $('.select2bs4').select2({
     theme: 'bootstrap4',
     placeholder: 'Search product here... '
   });
    });
</script>
</body>
</html>
