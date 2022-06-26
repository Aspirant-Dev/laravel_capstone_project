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
        <title>Admin | Online Transactions</title>

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
                            <h1 class="m-0">View Online Orders</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">View Online Orders</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @php
                use App\Order;
                $all = Order::all()->count();
                $pending = Order::where('status','0')->count();
                $process = Order::where('status','1')->count();
                $for_delivery = Order::where('status','2')->count();
                $delivered = Order::where('status','3')->count();
                $cancelled = Order::where('status','4')->count();
            @endphp
            <!-- Main content -->
            <section class="content noPrint">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="card border-0">
                                <div class="card-header">
                                    <div>
                                        <div class="table-responsive">
                                            <div class="btn-group w-100 mb-3 mt-3">
                                                <a class="btn @if(Route::is('admin.orders'))  bg-info fw-bold active @endif"  href="{{ route('admin.orders') }}" > All <span id="allOrders"><strong>{{ $all > 0 ? '('.$all.')' : '' }}</strong></span></a>
                                                <a class="btn @if(Route::is('admin.view-order.pending'))  bg-info fw-bold active @endif" href="{{ route('admin.view-order.pending') }}"> Pending <span id="pendingOrders"><strong>{{ $pending > 0 ? '('.$pending.')' : '' }}</strong></span></a>
                                                <a class="btn @if(Route::is('admin.view-order.processing'))  bg-info fw-bold active @endif" href="{{ route('admin.view-order.processing') }}" > Processing Orders <span id="processingOrders"><strong>{{ $process > 0 ? '('.$process.')' : '' }}</strong></span></a>
                                                <a class="btn @if(Route::is('admin.view-order.for-delivery'))  bg-info fw-bold active @endif" href="{{ route('admin.view-order.for-delivery') }}" > For Delivery <span id="deliveryOrders"><strong>{{ $for_delivery > 0 ? '('.$for_delivery.')' : '' }}</strong></span></a>
                                                <a class="btn @if(Route::is('admin.view-order.delivered'))  bg-info fw-bold active @endif" href="{{ route('admin.view-order.delivered') }}" > Delivered <span id="completedOrders"><strong>{{ $delivered > 0 ? '('.$delivered.')' : '' }}</strong></span></a>
                                                <a class="btn @if(Route::is('admin.view-order.cancelled-returned'))  bg-info fw-bold active @endif" href="{{ route('admin.view-order.cancelled-returned') }}" > Cancelled <span id="cancelOrders"><strong>{{ $cancelled > 0 ? '('.$cancelled.')' : '' }}</strong></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Online Orders Information</h3>
                                </div>
                                <div class="card-body">
                                    <table id="onlineOrders" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Order Date</th>
                                                <th>Tracking Number</th>
                                                <th>Total Price</th>
                                                <th>Payment Method</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
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
{{-- <script src="{{ asset('assets/admin/js/demo.js') }}"></script> --}}


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
{{-- <script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "lengthMenu": [ 5, 10, 20, 50, 100, 200, 500],
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      "buttons": ["colvis"]
    });
  });
</script> --}}
@php
    if(Route::is('admin.orders'))
    {
        $route = 'admin.ajax.table.orders';
    }
    elseif(Route::is('admin.view-order.pending'))
    {
        $route = 'admin.ajax.table.pending.orders';
    }
    elseif(Route::is('admin.view-order.processing'))
    {
        $route = 'admin.ajax.table.processing.orders';
    }
    elseif(Route::is('admin.view-order.for-delivery'))
    {
        $route = 'admin.ajax.table.delivery.orders';
    }
    elseif(Route::is('admin.view-order.delivered'))
    {
        $route = 'admin.ajax.table.delivered.orders';
    }
    elseif(Route::is('admin.view-order.cancelled-returned'))
    {
        $route = 'admin.ajax.table.cancelled.orders';
    }
@endphp
<script>
    $(document).ready(function () {

        $('#onlineOrders').DataTable({
            "paging": true,
            "lengthChange": true,
            "lengthMenu": [ 5, 10, 20, 50, 100, 200, 500],
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "emptyTable": "No orders available in table"
                },
            "serverSide":true,

            "ajax": '{{ route( $route) }}',
            "columns": [
                { mData: 'created_at'},
                { data: 'tracking_no', name: 'tracking_no' },
                { mData: 'total_price'},
                { mData: 'payment_method'},
                { data: 'status', name: 'status', render:function(data, type, row){
                    return "<span style='font-size:18px;' class='badge "+data.badge+"'>"+data.status+"</span>"
                }},
                { data: 'id', name: 'id', render:function(data, type, row){
                    return "<a class='btn btn-primary btn-sm' href='/admin/view-update-order/"+ row.id +"'>View</a>"
                }},
            ]
        });
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = false;

        var pusher = new Pusher('bdd702fa83485adf2106', {
        cluster: 'mt1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('new-orders', function(data) {
            $('#onlineOrders').DataTable().ajax.reload();
        });
        channel.bind('update', function(data) {
            $('#onlineOrders').DataTable().ajax.reload();
            $('#allOrders').css({"font-weight":"bold"});
            $('#allOrders').html(data.text);
            $('#pendingOrders').css({"font-weight":"bold"});
            $('#pendingOrders').html(data.text1);
            $('#processingOrders').css({"font-weight":"bold"});
            $('#processingOrders').html(data.text2);
            $('#deliveryOrders').css({"font-weight":"bold"});
            $('#deliveryOrders').html(data.text3);
            $('#completedOrders').css({"font-weight":"bold"});
            $('#completedOrders').html(data.text4);
            $('#cancelOrders').css({"font-weight":"bold"});
            $('#cancelOrders').html(data.text5);
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
</body>
</html>
