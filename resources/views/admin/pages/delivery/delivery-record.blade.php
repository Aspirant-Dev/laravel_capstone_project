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
        <title>Admin | Delivery Record</title>

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
                            <h1 class="m-0">Delivery Record</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Delivery Record</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="border-radius: 0px!important; ">
                                <div class="card-header">
                                    <h3 class="card-title">Delivery Record</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table text-center" id="deliveryRecord">
                                        <thead class="text-center">
                                            <th width="10%">Tracking #</th>
                                            <th width="15%">Date Delivered</th>
                                            <th width="10%">Customer</th>
                                            <th width="30%">Address</th>
                                            <th width="10%">Total Amount</th>
                                            {{-- <th>Status</th> --}}
                                            <th width="10%">Delivered By</th>
                                            <th width="10%">Action</th>
                                        </thead>
                                        {{-- <tbody>
                                            @foreach ($delivered as $item )
                                            <tr class="text-center">
                                                <td>{{ $item->tracking_no }}</td>
                                                <td>{{ $item->completed_at }}</td>
                                                <td>{{ $item->fname.' '.$item->lname }}</td>
                                                <td>{{ $item->address.', '.$item->barangay.', '.$item->city.', '.$item->postal_code }}</td>
                                                <td>&#8369; {{ number_format($item->total_price,2) }}</td>
                                                <td>
                                                    @if($item->updated_by == '')
                                                        <a style="cursor: pointer" data-toggle="modal" data-target="#modalAdd{{ $item->id }}">
                                                            <span class="text-danger">Empty data. Add?</span>
                                                        </a>
                                                    @else
                                                        {{ $item->updated_by }}
                                                    @endif
                                                </td>
                                                <td><a href="{{ url('/admin/delivery-details/'.$item->id) }}" class="btn btn-sm btn-primary"><span><i class="fas fa-eye"></i> View</span></a></td>
                                            </tr>
                                            <div class="modal fade" id="modalAdd{{ $item->id }}">
                                                <div class="modal-dialog  modal-dialog-scrollable modal-dialog-centered" role="document">
                                                    <div class="modal-content" style="border-radius: 0px!important">
                                                        <div class="modal-header text-center">
                                                            <h4 class="modal-title w-100">Edit Order Tracking {{ $item->tracking_no }}</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('/admin/delivery-record/edit/'.$item->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h4>Delivered By:</h4>
                                                                    <select required class="select2bs4 form-control" name="delivered_by">
                                                                        <option value="" selected hidden > </option>
                                                                        @foreach ($delivery_users as $item )
                                                                            <option value="{{ $item->full_name }}" >{{ $item->full_name }}</option>
                                                                        @endforeach
                                                                    </select>
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
                                        </tbody> --}}
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
  $(document).ready(function () {
    $('#deliveryRecord').DataTable({
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

            "ajax": '{{ route('admin.view.delivery.record') }}',
            "columns": [
                { mData: 'tracking_no'},
                { mData: 'date_delivered'},
                { mData: 'customer_name'},
                { mData: 'address'},
                { mData: 'total_price'},
                { mData: 'updated_by'},
                { data: 'id', name: 'id', render:function(data, type, row){
                    return "<a class='btn btn-primary btn-sm' href='/admin/delivery-details/"+ row.id +"'><i class='fas fa-eye'></i> View</a>"
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
            $('#deliveryRecord').DataTable().ajax.reload();
        });
        channel.bind('update', function(data) {
            $('#deliveryRecord').DataTable().ajax.reload();
            alertify.set('notifier','position', 'top-right');
            alertify.success('New order has been successfully delivered.');
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
</body>
</html>
