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
        <title>Admin | Return Products</title>

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
                            <h1 class="m-0">View Return Products</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">View Return Products</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Return Products Information</h3>
                                </div>
                                <div class="card-body">
                                    <table id="returnTbl" class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Order Tracking #</th>
                                                <th>Customer Name</th>
                                                <th>Product Name</th>
                                                <th>Reason</th>
                                                <th>Quantity</th>
                                                <th>Product Image</th>
                                                <th>Image Receipt</th>
                                                <th>Detailed Reasons</th>
                                                <th>Status</th>
                                                <th>Date Returned</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        {{-- <tfoot>
                                            <tr class="text-center">
                                                <th>Order Tracking #</th>
                                                <th>Customer Name</th>
                                                <th>Product Name</th>
                                                <th>Reason</th>
                                                <th>Quantity</th>
                                                <th>Product Image</th>
                                                <th>Image Receipt</th>
                                                <th>Detailed Reasons</th>
                                                <th>Status</th>
                                                <th>Date Returned</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot> --}}
                                        <tbody>
                                            @foreach ($return_items as $item)
                                            <tr class="text-center">
                                                <td>{{ $item->orders->tracking_no }}</td>
                                                <td>{{ ucfirst($item->orders->fname).' '.ucfirst($item->orders->lname) }}</td>
                                                <td>{{ $item->products->name }}</td>
                                                <td>{{ $item->reason }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>
                                                    <a style="cursor: pointer" data-toggle="modal" data-target="#modal-product{{ $item->id }}">
                                                        <img src="{{ asset('uploads/return/'.$item->product_image) }}" alt="..." height="50px" width="50px">
                                                        <br> <span class="text-info">View Image</span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a style="cursor: pointer" data-toggle="modal" data-target="#modal-receipt{{ $item->id }}">
                                                        <img src="{{ asset('uploads/return_image_receipt/'.$item->image_receipt) }}" alt="..." height="50px" width="50px">
                                                        <br> <span class="text-info">View Image</span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a style="cursor: pointer" data-toggle="modal" data-target="#modal-reason{{ $item->id }}">
                                                        <br> <span class="text-info">View Detailed Reason</span>
                                                    </a>
                                                </td>
                                                <td>
                                                    @if($item->status == 0)
                                                        <span class="badge badge-secondary" style="font-size: 14px; border-radius: 0px; padding: 12px;">Request for return product</span>
                                                    @elseif($item->status == 1)
                                                        <span class="badge badge-info" style="font-size: 14px; border-radius: 0px; padding: 12px;">Approved Request <br> (Waiting for customer)</span>
                                                    @elseif($item->status == 2)
                                                        <span class="badge badge-success" style="font-size: 14px; border-radius: 0px; padding: 12px;">Returned</span>
                                                    @else
                                                        <span class="badge badge-danger" style="font-size: 14px; border-radius: 0px; padding: 12px;">Not Approved</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->status == 2) {{ date('F d, Y', strtotime($item->date_returned)) }}
                                                    @elseif($item->status == 3) Not Approved. <br>{{ $item->message }}
                                                    @else
                                                        Processing
                                                    @endif</td>
                                                <td>
                                                    @if($item->status < 2)
                                                        <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateModal{{ $item->id }}">
                                                            <i class="fas fa-edit"></i> Update
                                                        </a>
                                                    @else
                                                        <button disabled type="button" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i> Update
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                                <div class="modal fade" id="modal-product{{ $item->id }}">
                                                    <div class="modal-dialog  modal-dialog-scrollable modal-dialog-centered" role="document">
                                                        <div class="modal-content text-center" style="border-radius: 0px!important">
                                                            <div class="modal-header text-center">
                                                                <h4 class="modal-title w-100" style="color: #ee4d2d">Product Image</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12 mb-3">
                                                                        <center>
                                                                            <span><img src="{{ asset('uploads/return/'.$item->product_image) }}" width="100%" height="100%"></span>
                                                                        </center>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="modal-receipt{{ $item->id }}">
                                                    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered" role="document">
                                                        <div class="modal-content text-center" style="border-radius: 0px!important">
                                                            <div class="modal-header text-center">
                                                                <h4 class="modal-title w-100" style="color: #ee4d2d">Image Receipt</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12 mb-3">
                                                                        <center>
                                                                            <span><img src="{{ asset('uploads/return_image_receipt/'.$item->image_receipt) }}" width="100%" height="100%"></span>
                                                                        </center>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="modal-reason{{ $item->id }}">
                                                    <div class="modal-dialog  modal-dialog-scrollable modal-dialog-centered" role="document">
                                                        <div class="modal-content" style="border-radius: 0px!important">
                                                            <div class="modal-header text-center ">
                                                                <h4 class="modal-title w-100" style="color: #ee4d2d">Detailed Reason</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12 mb-3">
                                                                        <span>{!! ucfirst($item->detailed_reason) !!}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="updateModal{{ $item->id }}">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                                        <div class="modal-content" style="border-radius: 0px!important">
                                                            <div class="modal-header text-center">
                                                                <h4 class="modal-title w-100" style="color: #ee4d2d">Update Status</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <form action="{{ url('/admin/return-product/'.$item->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row">
                                                                    <div class="col-md-12 mb-3">
                                                                        <div class="form-group">

                                                                        <input type="hidden" name="item_id" value="{{ $item->item_id }}">
                                                                            @if($item->status == 0)
                                                                                <label>Update Request Return Status of {{ $item->products->name }} to:</label>
                                                                                <select required class="select2bs4 form-control" name="order_status" id="mySelect" onChange="check(this);">
                                                                                    <option value="" selected hidden >Request</option>
                                                                                    <option value="1">Approve Request</option>
                                                                                    <option value="3">Not Approve</option>
                                                                                </select>

                                                                                <div class="form-group mt-2" id="other-div" style="display:none;">
                                                                                    <label>Please provide message for customer</label>
                                                                                    <textarea placeholder="Please write a message for customer including the reason why the request was not approved." id="other-input" class="form-control" name="message" rows=3 cols=50 maxlength=250></textarea>
                                                                                  </div>
                                                                            @elseif($item->status == 1)
                                                                                <label>Update Status of {{ $item->products->name }} to:</label>
                                                                                <input type="hidden" name="qty" value="{{ $item->quantity }}">
                                                                                <select required class="select2bs4 form-control" name="order_status">
                                                                                    <option value="" selected hidden disabled>Approve Request</option>
                                                                                    <option value="2">Returned</option>
                                                                                </select>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-end">
                                                                <button type="button" class="btn bg-gradient-danger" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn bg-gradient-success">Submit</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
      "buttons": ["colvis"]
    });
  });
</script> --}}
<script>
    $(document).ready(function () {

        $('#returnTbl').DataTable({
            "paging": true,
            "lengthChange": true,
            "lengthMenu": [ 5, 10, 20, 50, 100, 200, 500],
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "emptyTable": "No return items available in table"
                },
        });
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = false;

        var pusher = new Pusher('bdd702fa83485adf2106', {
        cluster: 'mt1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('return-submitted', function(data) {
            swal({
                title: "New item to be return",
                text: "Do you want to see the return item? The page will reload if you choose 'Yes'.",
                icon: "info",
                buttons: [
                    'No',
                    'Yes, I am sure!'
                ],
                dangerMode: true,
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        location.reload();
                    }
                });
        });
    });
</script>
<script>
    // Put this script in header or above select element
function check(elem) {
// use one of possible conditions
// if (elem.value == 'Other')
if (elem.selectedIndex == 2) {
    document.getElementById("other-div").style.display = 'block';

    document.getElementById("other-input").required = true;
} else {
    document.getElementById("other-div").style.display = 'none';
}
}
</script>
<!-- SweetAlert -->
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
<script>
    $(function () {
//Initialize Select2 Elements
$('.select2bs4').select2({
    theme: 'bootstrap4',
    placeholder: 'Please select here...'
});
    });
</script>
</body>
</html>
