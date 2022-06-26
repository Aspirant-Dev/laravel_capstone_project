<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/landing_page/assets/logo.png') }}" />

        @if (Auth::user()->user_type == 'Admin')
            <title>Admin | Dashboard</title>
        @elseif(Auth::user()->user_type == 'Cashier')
            <title>Cashier | Dashboard</title>
        @else
            <title>Delivery | Dashboard</title>
        @endif

        <!-- Custom Style -->
        <link rel="stylesheet" href="{{ asset('assets/admin/css/scroll-to-top.css') }}">
        <!-- ICON NEEDS FONT AWESOME FOR CHEVRON UP ICON -->
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

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

        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fullcalendar/main.css') }}">

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

        {{-- @if (Auth::user()->user_type == 'Admin')
            @include('layouts.inc.charts.user-registers-city')
        @endif --}}
    </head>


<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">

    <div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="{{ asset('assets/landing_page/assets/logo.png') }}" alt="Admin LLogo" height="100px" width="100px">
    </div>
        <!-- Navbar -->
        @include('layouts.inc.admin.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.inc.admin.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                        @if (Auth::user()->user_type == 'Admin')
                            <h1 class="m-0">Admin Dashboard</h1>
                        @elseif(Auth::user()->user_type == 'Cashier')
                            <h1 class="m-0">Cashier Dashboard</h1>
                        @else
                            <h1 class="m-0">Delivery Dashboard</h1>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Overview</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        @if (Auth::user()->user_type == 'Admin')
            @include('layouts.inc.admin.admin-dashboard')
        @elseif(Auth::user()->user_type == 'Cashier')
            @include('layouts.inc.admin.cashier-dashboard')
        @else
            @include('layouts.inc.admin.delivery-dashboard')
        @endif
    </div>

    <!-- Return to Top -->
    <a href="javascript:" id="return-to-top"><i class="icon-chevron-up"></i></a>


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



{{-- DataTables  & Plugins --}}
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

<!-- SweetAlert -->
<script src="{{ asset('assets/js/sweetalert.js') }}"></script>


@if(session('info'))
    <script>
            swal(" ",{
                title: "{{ session('info') }}",
                icon: 'info',
                buttons: false,
                timer: 2000,
                closeOnClickOutside: false,
                });
    </script>
@endif
<script>
    // ===== Scroll to Top ====
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 350) {        // If page is scrolled more than 350px
            $('#return-to-top').fadeIn(500);    // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(500);   // Else fade out the arrow
        }
    });
    $('#return-to-top').click(function() {      // When arrow is clicked
        $('body,html').animate({
            scrollTop : 0                       // Scroll to top of body
        }, 500);
    });
</script>
@if(Auth::user()->user_type == 'Admin')
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        $(document).ready(function () {
            //  count new cod orders
            function getCount() {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('route_for_new_data_here') }}"
                    })
                    .done(function( data ) {
                        $('#mycount').html(data);
                    });
                }

            // count new online payment orders
            function getCountOnlinePayment() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('route_for_new_online_payment_here') }}"
                })
                .done(function( dataOP ) {
                    $('#mycountOP').html(dataOP);
                });
            }
            // count critical products
            function countCrits() {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('admin.count.crits') }}"
                        })
                        .done(function( crits ) {
                            $('#count-crits').html(crits);
                        });
                    }

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = false;

            var pusher = new Pusher('bdd702fa83485adf2106', {
            cluster: 'mt1'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('return-submitted', function(data) {
                $('#returns').html(data.text);
            });

            channel.bind('new-registered', function(data) {
                $('#users-count').html(data.text);
            });
            channel.bind('admin-dashboard-update', function(d) {
                $('#completed').html(d.data);
                $('#onsales').html(d.data1);
                $('#walk-sales').html(d.data2);
                $('#walk').html(d.data3);
            });

            channel.bind('new-orders', function(data) {
                $('#onlinesOrders').html(data.text);
                $('#example2').DataTable().ajax.reload();
                $('#example3').DataTable().ajax.reload();
                getCount();
                getCountOnlinePayment();
                countCrits();
            });
        });
    </script>
@elseif(Auth::user()->user_type == 'Cashier')

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    $(document).ready(function () {

        // count critical products
        function countCrits() {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.count.crits') }}"
            })
            .done(function( crits ) {
                $('#count-crits').html(crits);
            });
        }
        // count  products
        function countProds() {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.cashier.count-prods') }}"
            })
            .done(function( data ) {
                $('#count-prods').html(data);
            });
        }
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = false;

        var pusher = new Pusher('bdd702fa83485adf2106', {
        cluster: 'mt1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('new-orders', function(data) {
            countCrits();
        });
        channel.bind('new-registered', function(data) {
            $('#count-prods').html(data.text);
        });
    });
</script>
@elseif(Auth::user()->user_type == 'Delivery')
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        $(document).ready(function () {

        // count all orders
        function getCount() {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.delivery.count-all') }}"
            })
            .done(function( data ) {
                $('#count-allOrders').html(data);
            });
        }

        // count all orders
        function countPending() {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.delivery.count-pending') }}"
            })
            .done(function( data ) {
                $('#count-pendingOrders').html(data);
            });
        }

        // count all orders
        function countProcessing() {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.delivery.count-processing') }}"
            })
            .done(function( data ) {
                $('#count-processingOrders').html(data);
            });
        }

        // count all orders
        function countDelivery() {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.delivery.count-delivery') }}"
            })
            .done(function( data ) {
                $('#count-deliveryOrders').html(data);
            });
        }

        // count all orders
        function countCompleted() {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.delivery.count-completed') }}"
            })
            .done(function( data ) {
                $('#count-completedOrders').html(data);
            });
        }

        // count all orders
        function countCancelled() {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.delivery.count-cancelled') }}"
            })
            .done(function( data ) {
                $('#count-cancelOrders').html(data);
            });
        }
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = false;

            var pusher = new Pusher('bdd702fa83485adf2106', {
            cluster: 'mt1'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('new-orders', function(data) {
                $('#example4').DataTable().ajax.reload();
                getCount();
                countPending();
                countProcessing();
                countDelivery();
                countCompleted();
                countCancelled();
            });
        });
    </script>
@endif
</body>
</html>
