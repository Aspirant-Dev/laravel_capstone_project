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

        <title>Delivery | View Order {{ $orders->tracking_no }}</title>

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


        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.css') }}">

        {{-- <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"> --}}

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
<body class="hold-transition sidebar-mini layout-fixed">
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
                        <h1 class="m-0">Update Order Status</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">View/Update Order</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-1 mb-3">
                    <div class="col-md-12">
                        <a href="{{ url('/admin/view-orders') }}" class="btn btn-primary">View Orders</a>
                        @if($orders->status == 3 || $orders->status == 2)
                            <div class="float-right">

                                <a href="{{ url('/admin/delivery/generate-pdf-invoice/'.$orders->id) }}"  target="_blank" class="btn btn-success "><i class="fas fa-print"></i> Generate PDF Invoice</a>
                                <a href="{{ url('/admin/delivery/generate-invoice/'.$orders->id) }}" style="margin-right: 10px;" target="_blank" class="btn btn-success "><i class="fas fa-print"></i> Print Invoice</a>
                            </div>
                            @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card"  style="border-radius: 0px!important">
                            <div class="card-header">
                                <h3 class="card-title">Customer Details</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="mt-1">Full Name</label>
                                                <div class="border p-2 fw-bold">{{ $orders->fname.' '.$orders->lname }}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mt-1">Contact No.</label>
                                                <div class="border p-2 fw-bold">{{ $orders->phone_no }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 ">
                                        <label class="mt-1">Email</label>
                                        <div class="border p-2 fw-bold">{{ $orders->email }}</div>
                                        <label class="mt-1">Shipping Address</label>
                                        <div class="border p-2 fw-bold">{{ $orders->address.', '.$orders->barangay.', '.$orders->city.', '.$orders->postal_code }}</div>
                                        <label class="mt-1">Payment Method</label>
                                        @if($orders->payment_method == 'GCash')
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control rounded-0" style="background-color: white; cursor:text" disabled value="{{ $orders->payment_method  }}">
                                            <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-default"><i class="fas fa-receipt"></i> View Image</button>
                                            </span>
                                        </div>
                                            <div class="modal fade" id="modal-default">
                                                <div class="modal-dialog">
                                                    <div class="modal-content" style="border-radius: 0px!important">
                                                        <div class="modal-header text-center">
                                                            <h4 class="modal-title " style="color: #ee4d2d">GCash Payment</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12 mb-3">
                                                                    <center>
                                                                        <span><img src="{{ asset('uploads/gcash/'.$gcash->image ) }}" width="320px" height="480px" alt="" srcset=""></span>
                                                                    </center>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-end">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="border p-2 fw-bold">{{ $orders->payment_method }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" style="border-radius: 0px!important">
                            <div class="card-header">
                                <h3 class="card-title">Products Ordered</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- form start -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="example2" class="table table-bordered table-head-fixed table-striped">
                                            <thead>
                                                <th class="text-center">Image</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Total</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders->orderItems as $item )
                                                    <tr class="text-center">
                                                        <td><img src="{{ asset('uploads/products/'.$item->products->image) }}" alt="..." height="75px" width="75px"></td>
                                                        <td>{{ $item->products->name }}</td>
                                                        <td><small style="font-style: italic">x</small>{{ $item->qty }}</td>
                                                        <td>&#8369;{{ number_format($item->price,2) }}</td>
                                                        <td>&#8369;{{ number_format($item->price * $item->qty ,2) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3 class="m-0">Grand Total</h3>
                                            </div>
                                            <div class="col-sm-6">
                                                <h3 class="float-right" style="color:#fb5533!important;">
                                                    &#8369;{{ number_format($orders->total_price,2) }}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" style="border-radius: 0px!important">
                            <div class="card-header">
                                <h3 class="card-title">Order Logs</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Order Logs -->
                                <div class="row">
                                    <div class="col-md-12">
                                        @if($orders->payment_method == 'PayPal' || $orders->payment_method == 'GCash')

                                                @foreach ($orderLog as $log)
                                                    <div class="callout callout-success">
                                                        <h5 class="mt-1"><strong>&#8226; {{ $log->order_status }}</strong></h5>
                                                        <h5 class="ml-3">{{ date('j F, Y, g:i a', strtotime($log->created_at))}}</h5>
                                                        @if($log->order_status != 'In Process')
                                                            <strong class="text-muted ml-3">Updated by : {{ $log->updated_by }}</strong>
                                                        @else
                                                            <strong class="text-muted ml-3">Paid by {{ $orders->payment_method }}</strong>
                                                        @endif
                                                    </div>
                                                    <hr>
                                                @endforeach
                                            @else
                                            @foreach ($orderLog as $log)
                                                <div class="callout callout-success">
                                                    <h5 class="mt-1"><strong>&#8226; {{ $log->order_status }}</strong></h5>
                                                    <h5 class="ml-3">{{ date('j F, Y, g:i a', strtotime($log->created_at))}}</h5>
                                                    @if($log->order_status != 'Pending')
                                                        <strong class="text-muted ml-3">Updated by : {{ $log->updated_by }}</strong>
                                                    @endif
                                                </div>
                                                <hr>
                                            @endforeach
                                            @endif
                                        {{-- @foreach ($orderLog as $log)
                                            <div class="callout callout-success">
                                                <h6 class=""><strong>&#8226; {{ $log->order_status }}</strong></h6>
                                                <h6 class="ml-3">{{ date('j F, Y, g:i a', strtotime($log->created_at))}}</h6>
                                                @if($log->order_status != 'Pending')
                                                    <strong class="text-muted ml-3">Updated by : {{ $log->updated_by }}</strong>
                                                @endif
                                            </div>
                                            <hr>
                                        @endforeach --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" style="border-radius: 0px!important">
                            <div class="card-header">
                                <h3 class="card-title">Order Status :
                                    <b>
                                        @if ($orders->status == '0')
                                        Pending
                                    @elseif($orders->status == '1')
                                        Processing
                                    @elseif($orders->status == '2')
                                        For Delivery
                                    @elseif($orders->status == '3')
                                        Delivery / Completed
                                    @elseif($orders->status == '4')
                                        Cancelled
                                    @elseif($orders->status == '5')
                                        Returned
                                    @else
                                        Request for Order Cancellation
                                    @endif
                                    </b>
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            @if($orders->status == 2)
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <form action="{{ url('/admin/delivery/update-order/'.$orders->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                @if ($orders->status == 2)
                                                <div class="form-group">
                                                        <img id="output" style="display:none; background-size: cover; width: 100%; height: 250px;"/>

                                                        <label>Upload a photo proof that this order has been delivered.</label>
                                                        <input required class="form-control" type="file" onchange="loadFile(event)"
                                                               capture="camera" accept="image/png, image/gif, image/jpeg" name="image"
                                                                oninvalid="this.setCustomValidity('Please upload a proof photo to continue.')"
                                                                oninput="this.setCustomValidity('')"/>
                                                        <div class="invalid-feedback">
                                                            <strong>Please upload product image.</strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Select Order Status</label>
                                                        <select required class="select2bs4 form-control"  name="order_status">
                                                            @if($orders->status == 0)
                                                                <option value="" {{ $orders->status == '0' ? 'selected hidden':'' }}>Pending</option>
                                                                <option value="1">Processing Orders</option>
                                                                {{-- @if($orders->payment_method == 'COD')
                                                                <option value="4">Cancel Orders</option> @endif --}}
                                                            @elseif($orders->status == 1)
                                                                <option value="" {{ $orders->status == '1' ? 'selected hidden':'' }}>Processing Orders</option>
                                                                <option value="2">For Delivery</option>
                                                            @elseif($orders->status == 2)
                                                                <option value="" {{ $orders->status == '2' ? 'selected hidden':'' }}>For Delivery</option>
                                                                <option value="3">Delivered</option>
                                                            @elseif($orders->status == 3)
                                                                <option value="" {{ $orders->status == '3' ? 'selected hidden':'' }}>Delivered</option>
                                                                {{-- <option value="4">For Delivery</option> --}}
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-success btn-block">Update Status</button>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @elseif($orders->status == 0 || $orders->status == 1)
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 callout callout-warning">
                                            <h3 class="text-center"><strong><i class="fas fa-exclamation-circle"></i> You are not allowed to update status of order.</strong></h3 class="text-center">
                                        </div>
                                    </div>
                                </div>
                            @elseif($orders->status == 3)
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 callout callout-success">
                                            <h3 class="text-center"><strong><i class="fas fa-clipboard-check"></i> Order has been delivered</strong></h3 class="text-center">
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 callout callout-danger">
                                            <h3 class="text-center"><strong> Order has been cancelled</strong></h3 class="text-center">
                                        </div>
                                    </div>
                                </div>
                            @endif
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

<!-- Select2 -->
<script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>


<!-- Page specific script -->
<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "lengthMenu": [ 1, 5, 10, 20, 50, 100, 200, 500],
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
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
@php
            if($orders->status == 0)
                $stat = 'Pending';
            elseif($orders->status == 1)
                $stat = 'Processing Orders';
            elseif($orders->status == 2)
                $stat = 'For Delivery';
            elseif($orders->status == 3)
                $stat = 'Delivered';
            elseif($orders->status == 4)
                $stat = 'Cancelled';
            elseif($orders->status == 5)
                $stat = 'Returned';
        @endphp
        <script>
            $(function () {
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4',
            placeholder: '{{ $stat }}'
        });
            });
        </script>
<!-- Page specific script -->
<script src="{{ asset('assets/js/sweetalert.js') }}"></script>

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
</body>
</html>
