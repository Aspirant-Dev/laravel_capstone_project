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
        <title>Admin | Delivery Details</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/admin/css/adminlte.min.css') }}">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
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
                            <h1 class="m-0">Delivery Details</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Delivery Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <h3 class="badge bg-gradient-success" style="font-size: 20px; border-radius: 0px; padding: 12px;">
                                Customer Name: {{ ucfirst($order->fname).' '.ucfirst($order->lname) }}
                            </h3>
                            <div class="float-right">
                                <h3 class="badge bg-gradient-success" style="font-size: 20px; border-radius: 0px; padding: 12px;">
                                    <span class="text-left">
                                        Tracking No.: {{ $order->tracking_no }}
                                    </span>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="border-radius: 0px!important; ">
                                <div class="card-header">
                                    <h3 class="card-title">Delivery Details</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table" id="example2">
                                        <thead class="text-center">
                                            <th>Products Ordered</th>
                                            <th>Unit Price</th>
                                            <th>Qty.</th>
                                            <th>Amount</th>
                                            <th>Total Amount</th>
                                            <th>Status</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->orderItems as $item)
                                            <tr class="text-center">
                                                <td>{{ $item->products->name }}</td>
                                                <td>&#8369; {{ number_format($item->products->price,2) }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>&#8369; {{ number_format($item->price,2) }}</td>
                                                <td>&#8369; {{ number_format($item->price * $item->qty,2) }}</td>
                                                <td>
                                                    @if($item->status == 1)
                                                        <span class="badge bg-info" style="font-size: 14px; border-radius: 0px; padding: 12px;">
                                                            Request Return Item
                                                        </span>
                                                    @elseif($item->status == 2)
                                                        <span class="badge bg-primary" style="font-size: 14px; border-radius: 0px; padding: 12px;">
                                                            Approved Request
                                                        </span>
                                                    @elseif($item->status == 3)
                                                        <span class="badge bg-warning" style="font-size: 14px; border-radius: 0px; padding: 12px;">
                                                            Returned
                                                            @if($returnedItem->quantity > 1)
                                                                ({{ $returnedItem->quantity  }} items
                                                            @else
                                                                ({{ $returnedItem->quantity  }} item
                                                            @endif
                                                        </span>
                                                    @elseif($item->status == 4)
                                                        <span class="badge bg-danger" style="font-size: 14px; border-radius: 0px; padding: 12px;">
                                                            Not Approved
                                                        </span>
                                                    @else
                                                        <span class="badge bg-success" style="font-size: 14px; border-radius: 0px; padding: 12px;">
                                                            OK!
                                                        </span>
                                                    @endif
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

<!-- SCRIPTS -->
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
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/admin/js/adminlte.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>
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
        "paging": true,
        "lengthChange": true,
        "lengthMenu": [ 10, 20, 50, 100, 200, 500],
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "buttons": ["colvis"]
        });
    });
    </script>
    <!-- SweetAlert -->
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>

    <script>
        $(function () {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4',
        placeholder: 'Please select here...'
    });
        });
    </script>

    <!-- Custom Script -->
    @if(session('success'))
        <script>
                swal(" ",{
                    title: "{{ session('success') }}",
                    icon: 'success',
                    buttons: false,
                    timer: 2000,
                    closeOnClickOutside: false,
                    });
        </script>
    @endif
<!-- END SCRIPTS -->
</body>
</html>
