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

        @php
            $mytime = Carbon\Carbon::now()->format('M-d-Y');
        @endphp
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/landing_page/assets/logo.png') }}" />
        <title>Walk-in Transaction Sales Report</title>

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
            [type="date"] {
                    background:#fff url(https://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/calendar_2.png)  97% 50% no-repeat ;
                }
            [type="date"]::-webkit-inner-spin-button {
                    display: none;
                }
            [type="date"]::-webkit-calendar-picker-indicator {
                    opacity: 0;
                }
            input {
                    border: 1px solid #c4c4c4;
                    border-radius: 5px;
                    background-color: #fff;
                    padding: 3px 5px;
                    box-shadow: inset 0 3px 6px rgba(0,0,0,0.1);
                    width: 190px;
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
                            <h1 class="m-0">Walk-in Transaction Sales Report</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Walk-in Sales Report</li>
                            </ol>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-sm-12">
                            <button onclick="generatePDF();" type="button" class="btn btn-default" style="margin-right: 5px;">
                                <i class="fas fa-file-pdf"></i> Generate PDF
                            </button>
                            <button onclick="window.print();" type="button" class="btn btn-default noPrint" style="margin-right: 5px;">
                                <i class="fas fa-print"></i> Print
                            </button>
                        </div>
                    </div> --}}
                </div>
            </div>
            <section class="content noPrint">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-8 col-12">
                                    <div class="form-group">
                                        <button  class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                            <span class="text-left"><i class="fas fa-poll"></i>  View Sales Report</span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <a href="{{ route('admin.reports.overall.sales') }}"><li class="dropdown-item"><i class="fas fa-poll"></i> Overall Sales Report</li></a>
                                            <a href="{{ route('admin.reports.online.sales') }}"><li class="dropdown-item"><i class="fas fa-globe-asia"></i> Online Sales Report</li></a>
                                            {{-- <a href="{{ route('admin.reports.walkin.sales') }}"><li class="dropdown-item"><i class="fas fa-walking"></i> Walk-in Sales Report</li></a> --}}
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <a onclick="generatePDF();" class="btn btn-success btn-block"><i class="fas fa-print"></i> Generate PDF</a>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-12">
                                    <div class="form-group">
                                        <a onclick="window.print();" type="button" style="margin-right: 10px;" class="btn btn-success  btn-block"><i class="fas fa-print"></i> Print</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content noPrint">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Search Sales Report</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.reports.walkin.sales.search-from-date') }}" method="post">
                                    @csrf
                                        <div class="row">

                                            <div class="col-md-2 col-12">
                                                <label for="">Filter By : </label>
                                                <div class="form-group">
                                                    <button type="button" width="100%" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                       <span class="text-left"><i class="fas fa-calendar-alt"></i> Date Picker</span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <a href="{{ route('admin.reports.walkin.sales') }}"><li class="dropdown-item">Today</li></a>
                                                        <a href="{{ route('admin.reports.walkin.sales.yesterday') }}"><li class="dropdown-item">Yesterday</li></a>
                                                        <a href="{{ route('admin.reports.walkin.sales.last-7-days') }}"><li class="dropdown-item">Last 7 Days</li></a>
                                                        <a href="{{ route('admin.reports.walkin.sales.this-month') }}"><li class="dropdown-item">This Month (30 Days)</li></a>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for="date-from">Date From : </label>
                                                    <input type="date" required name="fromDate" class="form-control" max="<?php echo date("Y-m-d"); ?>" id="date-from" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-12">
                                                <div class="form-group">
                                                <label for="date-to">Date To : </label>
                                                <input type="date" required name="toDate" class="form-control" max="<?php echo date("Y-m-d"); ?>"  id="date-to"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 col-12">
                                                <div class="form-group">
                                                <label ><br> </label>
                                                <button type="submit" class="btn bg-gradient-success btn-block"><span><i class="fas fa-search"></i> Search</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
                                <div class="card p-3"  style="border-radius: 0px!important">
                                    <div class="card-header" style="border-bottom: none!important">
                                        <h3 class="text-center mb-0">Walk-in Transaction Sales Report</h3>
                                        <br>
                                        <small class=" text-center">
                                            <strong>
                                                @php if(Route::is('admin.reports.walkin.sales.search-from-date'))
                                                        echo 'As of: '. Session::get('searched').'<br><span class="noPrint" style=font-style:italic> (Last Searched) </span>';
                                                     elseif(Route::is('admin.reports.walkin.sales.yesterday'))
                                                        echo 'As of: '.Carbon\Carbon::now()->subDays(1)->format('M/d/Y').'<br><span class="noPrint" style=font-style:italic> (Filtered by : Yesterday) </span>';
                                                     elseif(Route::is('admin.reports.walkin.sales.last-7-days'))
                                                        echo 'As of: '.$range.'<br><span class="noPrint" style=font-style:italic> (Filtered by : Last 7 Days) </span>';
                                                     elseif(Route::is('admin.reports.walkin.sales.this-month'))
                                                        echo 'As of: '.$range.'<br><span class="noPrint" style=font-style:italic> (Filtered by : This Month) </span>';
                                                     else
                                                        echo 'As of : '.Carbon\Carbon::now()->format('M/d/Y').'<span class="noPrint"> (Today)</span>';
                                                @endphp
                                            </strong>
                                        </small>
                                    </div>
                                    <div class="card-body p-2 m-0">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table id="example2" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>No.</th>
                                                                <th>Transaction Date</th>
                                                                <th>Invoice No.</th>
                                                                <th>Customer's Name</th>
                                                                <th>Phone</th>
                                                                <th>Transaction Amount</th>
                                                                <th>Paid Amount</th>
                                                                <th>Change Returned</th>
                                                            </tr>
                                                        </thead>
                                                        {{-- <tfoot>
                                                            <tr class="text-center">
                                                                <th>No.</th>
                                                                <th>Transaction Date</th>
                                                                <th>Invoice No.</th>
                                                                <th>Customer's Name</th>
                                                                <th>Phone</th>
                                                                <th>Transaction Amount</th>
                                                                <th>Paid Amount</th>
                                                                <th>Balance (-) / Change (+)</th>
                                                            </tr>
                                                        </tfoot> --}}
                                                        <tbody>
                                                            @php
                                                                $total = 0;
                                                            @endphp
                                                            @foreach ($query as $item)
                                                                <tr class="text-center">
                                                                    <td>{{ $item->id }}</td>
                                                                    <td>{{ date('M-d-Y', strtotime($item->transact_date)) }}</td>
                                                                    <td>#{{ $item->invoice_no }}</td>
                                                                    <td>{{ $item->name }}</td>
                                                                    <td>{{ $item->phone }}</td>
                                                                    <td>&#8369; {{ number_format($item->transact_amount,2) }}</td>
                                                                    <td>&#8369; {{ number_format($item->paid_amount,2) }}</td>
                                                                    <td>&#8369; {{ number_format($item->balance,2) }}</td>
                                                                </tr>
                                                                @php
                                                                    $total += $item->transact_amount;
                                                                @endphp
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <h3 class="float-right">Total Sales : <strong>&#8369; {{ number_format($total,2) }}</strong></h3>
                                        </div>
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
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": false,
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
                    filename:     'Walkin Sales Report | <?php echo $name; ?>',
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
