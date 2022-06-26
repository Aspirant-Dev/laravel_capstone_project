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
                }
                .note-editable {
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
                        <h1 class="m-0">Add Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a style="text-decoration: none" href="{{ url('/admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Product</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-12">
                            <div class="card shadow-lg" style="border-radius: 0px;">
                                <div class="card-body">
                                     <!-- form start -->
                                    <form action="{{ url('/admin/insert-product') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                        @csrf

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
                                                  <label>Select Category</label>
                                                  <select required class="select2bs4 form-control"  name="cate_id">
                                                    <option value="" disabled hidden selected>Please Select...</option>
                                                    @foreach ($category as $item )
                                                        <option value="{{ $item->id }}" {{ old('cate_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}  </option>
                                                    @endforeach
                                                  </select>
                                                  <div class="invalid-feedback">
                                                    <strong>Please select a category from the list.</strong>
                                                  </div>
                                                </div>
                                              </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="CategoryName">Product Code</label>
                                                    <input type="text" readonly  class="form-control" name="pcode" value="{{ $unique_code }}" id="exampleInputEmail1" placeholder="Enter Product Code">
                                                </div>
                                            </div>
                                            </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="CategoryName">Product Name</label>
                                                    <input type="text" required class="form-control" name="name" value="{{ old('name') }}" id="exampleInputEmail1" placeholder="Enter Product Name">
                                                    <div class="invalid-feedback">
                                                        <strong>Please enter the product name.</strong>
                                                      </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                  <label>Product Type</label>
                                                  <input class="form-control" required name="type" value="{{ old('type') }}" placeholder="Enter product type...">
                                                  <div class="invalid-feedback">
                                                      <strong>Please enter the product type.</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                              <!-- Small Description -->
                                              <div class="form-group">
                                                <label>Brand</label>
                                                <input class="form-control" required name="brand" value="{{ old('brand') }}" placeholder="Enter product brand...">
                                                <div class="invalid-feedback">
                                                  <strong>Please enter the product brand. If no brand, just type 'No Brand'.</strong>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                  <label>Select Unit</label>
                                                  <select required class="select2bs4_units form-control"  name="unit">
                                                    <option value="" disabled hidden selected>Please Select...</option>
                                                    @foreach ($units as $item )
                                                        <option value="{{ $item->unit_name }}"  {{ old('unit') == $item->unit_name ? 'selected' : '' }}>{{ $item->unit_name }}</option>
                                                    @endforeach
                                                  </select>
                                                  <div class="invalid-feedback">
                                                    <strong>Please select product unit in the list.</strong>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="CategoryName">Product Price</label>
                                                    <input type="number" min="1" value="{{ old('price') }}" class="form-control" name="price" required  placeholder="Enter Product Price">
                                                    <div class="invalid-feedback">
                                                        <strong>Please enter the product price.</strong>
                                                      </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Product Stocks</label>
                                                    <input type="number" required class="form-control" name="stocks" value="{{ old('stocks') }}"  min="1" placeholder="Enter Product Stocks">
                                                    <div class="invalid-feedback">
                                                        <strong>Please enter the product stocks.</strong>
                                                      </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Critical Level</label>
                                                    <input type="number" required class="form-control" name="critical_level" value="{{ old('critical_level') }}"  min="1" placeholder="Enter Critical Level">
                                                    <div class="invalid-feedback">
                                                        <strong>Please enter the product critical level.</strong>
                                                      </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Product Status</label>
                                                <div class="row">
                                                    <!-- checkbox Status-->
                                                    <div class="col-sm-4">
                                                      <div class="form-group">
                                                        <div class="form-check">
                                                          <input class="form-check-input" name="status" type="checkbox">
                                                          <label class="form-check-label" >Active</label>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!-- checkbox Popular-->
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <div class="form-check">
                                                            <input class="form-check-input" name="trending" type="checkbox">
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
                                                          <input class="form-check-input" name="returnable" type="checkbox">
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
                                                <textarea required id="summernote" class="form-control" rows="1" name="description">{{ old('description') }}</textarea>
                                                <div class="invalid-feedback">
                                                    <strong>Please enter the product descriptions.</strong>
                                                  </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <img id="output" style="display:none; background-size: cover; width: 100%; height: 500px;"/>
                                            <br>
                                            <div class="col-sm-12">
                                              <!-- Product Image -->
                                              <div class="form-group">
                                                <label>Upload Product Image</label>
                                                <input required class="form-control" type="file" onchange="loadFile(event)" accept="image/png, image/gif, image/jpeg" name="image">
                                                <div class="invalid-feedback">
                                                    <strong>Please upload product image.</strong>
                                                  </div>
                                            </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success btn-block">Submit <i class="fas fa-arrow-right"></i></button>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


<!-- SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<script src="{{ asset('assets/admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/admin/js/adminlte.js') }}"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets/admin/js/demo.js') }}"></script>

    <script>
        $(function () {
       //Initialize Select2 Elements
       $('.select2bs4').select2({
         theme: 'bootstrap4',
         placeholder: 'Search category here... '
       });
       $('.select2bs4_units').select2({
         theme: 'bootstrap4',
         placeholder: 'Search units here... '
       });
        });
   </script>

<script>
  $(".needs-validation").on('submit', function (event) {
  $(this).addClass('was-validated');

  if ($(this)[0].checkValidity() === false) {
    event.preventDefault();
    event.stopPropagation();
    return false;
  } else {
      $('form').submit();
    event.preventDefault();
    event.stopPropagation();
    return true;
  };
});
</script>
    <script>
        $(function () {
            // Summernote
            // var gArrayFonts = ['Amethysta','Poppins','Poppins-Bold','Poppins-Black','Poppins-Extrabold','Poppins-Extralight','Poppins-Light','Poppins-Medium','Poppins-Semibold','Poppins-Thin'];
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
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'hr']],
                ],
            });
        })
    </script>

<script>
    var loadFile = function(event) {
        document.getElementById("output").style.display = "inline-block";
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>

    <!-- SweetAlert -->
    {{-- <script src="{{ asset('http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    <!-- Custom Script -->
    @if(session('alert'))
            <script>
                swal(" ",{
                    title: "{{ session('alert') }}",
                    icon: 'info',
                    closeOnClickOutside: false,
                    });
            </script>
        @endif
<!-- END SCRIPTS -->
</body>
</html>
