<!DOCTYPE html>
<html lang="en">
    <head>
         <!-- CSRF Token -->
         <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/landing_page/assets/logo.png') }}" />
        <title>Admin | Products</title>

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
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/admin/css/adminlte.min.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.css') }}">
        <!-- summernote -->
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.css') }}">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <style>

            @media all and (min-width: 992px) {
                .navbar .nav-item .dropdown-menu{ display: none; }
                .navbar .nav-item:hover .nav-link{   }
                .navbar .nav-item:hover .dropdown-menu{ display: block; }
                .navbar .nav-item .dropdown-menu{ margin-top:0; }
            }
            /* .scrollbar::-webkit-scrollbar {
                background-color: transparent;
                display: none;
            }
            .scrollbar::-webkit-scrollbar-thumb {
                border-radius: 3px;
                background-color: transparent;
                display: none;
            } */
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
                            <h1 class="m-0">Products</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Products</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row mt-1 mb-3">
                        <div class="col-md-4">
                            <a href="{{ url('/admin/add-product') }}" class="btn btn-success">Add Product</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info" style="border-radius: 0px;">
                                <div class="card-header">
                                    <h3 class="card-title">Products Information</h3>
                                </div>
                                <div class="card-body" >
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead class="text-center">
                                            <tr>
                                                <th>Category</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Brand</th>
                                                <th>Type</th>
                                                <th>Unit</th>
                                                <th>Price</th>
                                                <th>Stocks</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th width="15%">Actions</th>
                                            </tr>
                                        </thead>
                                        {{-- <tfoot class="text-center">
                                            <tr>
                                                <th>Category</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Brand</th>
                                                <th>Type</th>
                                                <th>Unit</th>
                                                <th>Price</th>
                                                <th>Stocks</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th width="15%">Actions</th>
                                            </tr>
                                        </tfoot> --}}
                                        <tbody>
                                            @foreach ($products as $item)
                                                <tr class="text-center">
                                                    <input type="hidden" class="del_val_id" value="{{ $item->id }}">
                                                    <input type="hidden" class="del_val_name" value="{{ $item->name }}">
                                                    <td>{{ $item->category->name }}</td>
                                                    <td>{{ $item->p_code}}</td>
                                                    <td>{{ $item->name}}</td>
                                                    <td>{{ $item->brand }}</td>
                                                    <td>{{ $item->product_type == NULL ? 'No Data' : $item->product_type }}</td>
                                                    <td>{{ $item->unit }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    @if ($item->stocks <= 0)
                                                        <td class="text-danger"><b>Out of Stock</b></td>
                                                    @else
                                                        <td>{{ $item->stocks }}</td>
                                                    @endif
                                                    <td><img src="{{ asset('uploads/products/'.$item->image) }}" height="75px" width="75px" alt="" srcset=""></td>
                                                    @if ($item->status == 1)
                                                    <td>Active</td>
                                                    @else
                                                        <td><span class="badge badge-danger badge-pill">Inactive</span></td>
                                                    @endif
                                                    <td>
                                                        <a href="{{ url('/admin/edit-product/'.$item->id) }}" type="button" class="btn btn-sm btn-primary ">Update</a>
                                                        <a  type="button" class="btn btn-sm btn-danger deletebtn" data-remote="/products/' .{{ $item->id }} . '">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
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


<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $('#example2').DataTable({
      "paging": false,
      "lengthChange": false,
    //   "lengthMenu": [ 2, 10, 20, 50, 100, 200, 500],
    scrollY:        500,
    deferRender:    true,
    scroller:       true,
    initComplete: function (settings, json) {
                    $('body').find('.dataTables_scrollBody').addClass("scrollbar");},
      "searching": true,
      "ordering": false,
      "autoWidth": false,
      "info":false,
      "responsive": true,
    });
  });
</script>
<!-- SweetAlert -->
<script src="{{ asset('assets/js/sweetalert.js') }}"></script>

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
    <!-- Custom Script -->
@if(session('invalid'))
<script>
     swal(" ",{
          title: "{{ session('invalid') }}",
          icon: 'error',
          buttons: false,
          timer: 2000,
          closeOnClickOutside: false,
          });
</script>
@endif
<script>
    $(document).ready(function () {

        $('.deletebtn').click(function (e) {
            e.preventDefault();

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            var del_id = $(this).closest("tr").find('.del_val_id').val();
            var del_name = $(this).closest("tr").find('.del_val_name').val();
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not able to recover this "+del_name+".",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        url: "delete-product",
                        method: "POST",
                        data: {
                            "id":del_id,
                    },
                        success: function (response)
                        {
                            swal(" ",{
                                    title: response.status,
                                    icon: response.icon,
                                })
                                .then((willDelete) => {
                                    location.reload();
                                });
                        },
                    });
                }
            });
        });
    });
</script>
</body>
</html>
