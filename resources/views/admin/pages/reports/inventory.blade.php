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
        <title>Inventory | Stocks Report</title>

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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <style>
            @media all and (min-width: 992px) {
                .navbar .nav-item .dropdown-menu{ display: none; }
                .navbar .nav-item:hover .nav-link{   }
                .navbar .nav-item:hover .dropdown-menu{ display: block; }
                .navbar .nav-item .dropdown-menu{ margin-top:0; }
                }
            @media print {
                .noPrint{
                    display:none;
                }
                .printMe
                {
                    display:inline;
                }
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
                            <h1 class="m-0">Inventory Report</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Inventory Report</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content noPrint mb-2">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <a onclick="generatePDF();" type="button" class="btn btn-success" style="margin-right: 5px;">
                                        <i class="fas fa-file-pdf"></i> Generate PDF
                                    </a>
                                    <button onclick="window.print();" type="button" class="btn btn-success noPrint" style="margin-right: 5px;">
                                        <i class="fas fa-print"></i> Print
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <hr style="display: none" class="printMe">
            <!-- Main content -->
            <section class="content printMe">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="invoice">
                                <div class="card"  style="border-radius: 0px!important">
                                    <div class="card-header" style="border-bottom: none!important">
                                        <h3 class="text-center mb-0">Inventory Report</h3>
                                    </div>
                                    <div class="card-body  m-0">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table id="example2" class="table table-bordered table-striped">
                                                        <thead class="text-center">
                                                            <tr>
                                                                <th>Category</th>
                                                                <th>Code</th>
                                                                <th>Name</th>
                                                                <th>Brand</th>
                                                                <th>Type</th>
                                                                <th>Price</th>
                                                                <th>Stocks</th>
                                                                <th>Critical Level</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        {{-- <tfoot class="text-center">
                                                            <tr>
                                                                <th>Category</th>
                                                                <th>Code</th>
                                                                <th>Name</th>
                                                                <th>Brand</th>
                                                                <th>Type</th>
                                                                <th>Price</th>
                                                                <th>Stocks</th>
                                                                <th>Critical Level</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </tfoot> --}}
                                                        <tbody>
                                                            @foreach ($prods as $item)
                                                                <tr class="text-center">
                                                                    <input type="hidden" class="del_val_id" value="{{ $item->id }}">
                                                                    <input type="hidden" class="del_val_name" value="{{ $item->name }}">
                                                                    <td>{{ $item->category->name }}</td>
                                                                    <td>{{ $item->p_code}}</td>
                                                                    <td>{{ $item->name}}</td>
                                                                    <td>{{ $item->brand }}</td>
                                                                    <td>{{ $item->product_type }}</td>
                                                                    <td>&#8369; {{ number_format($item->price,2) }}</td>
                                                                    @if($item->stocks <= 0)
                                                                        <td>Out of Stocks</td>
                                                                    @else
                                                                        <td>{{ $item->stocks }}</td>
                                                                    @endif
                                                                    <td>{{ $item->critical_level }}</td>
                                                                    @if ($item->status == 1)
                                                                    <td>Active</td>
                                                                    @else
                                                                        <td><span class="badge badge-danger badge-pill">Inactive</span></td>
                                                                    @endif
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <p>
                                            <span>As of : <strong>{{ Carbon\Carbon::now()->format('F d, Y (l)') }}</strong> </span><br>
                                            <span>Total Products : <strong>{{ count($prods) }}</strong> </span><br>
                                            <span>Out of Stock(s) :
                                                <strong>
                                                    @php use App\Product;
                                                        $out_of_stocks = Product::where('stocks','<=','0')->get();

                                                        echo count($out_of_stocks);
                                                    @endphp
                                                </strong>
                                            </span><br>
                                            <span>Products under Critical Level :
                                                <strong>
                                                    @php
                                                        $crit_level = Product::whereRaw('critical_level >= stocks')->get();
                                                        echo count($crit_level);
                                                    @endphp
                                                </strong>
                                            </span>
                                        </p>
                                    </div>
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
      //   "lengthMenu": [ 10, 20, 50, 100, 200, 500],
        "searching": false,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
<!-- SweetAlert -->
<script src="{{ asset('assets/js/sweetalert.js') }}"></script>

<?php $name = Carbon\Carbon::now()->format('M-d-Y'); ?>
<script>
    function generatePDF()
    {
        const element = document.getElementById("invoice");
        var opt = {
                    margin:       0,
                    filename:     'Inventory Report | <?php echo $name; ?>',
                    image:        { type: 'jpeg', quality: 1 },
                    html2canvas:  { scale: 2 },
                    jsPDF:        {orientation: 'landscape' }
                    };
        html2pdf()
        .set(opt)
        .from(element)
        .save();
    }
</script>
</body>
</html>
