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
        <title>Point of Sales (POS)</title>

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

        <!-- Theme style -->
        <style>
            /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
            }

            /* Firefox */
            input[type=number] {
            -moz-appearance: textfield;
            }
            @media all and (min-width: 992px) {
                .navbar .nav-item .dropdown-menu{ display: none; }
                .navbar .nav-item:hover .nav-link{   }
                .navbar .nav-item:hover .dropdown-menu{ display: block; }
                .navbar .nav-item .dropdown-menu{ margin-top:0; }
                }
        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    </head>
<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.inc.admin.navbar')

        @include('layouts.inc.admin.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Point of Sales</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">POS</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card"style="border-radius: 0px!important;">
                                <div class="card-header bg-gradient-info">
                                    <h3 class="card-title">Walk In Customers </h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <form action="{{ route('admin.cashier.submit') }}" method="POST">
                                        @csrf
                                        <div class="table-responsive">
                                            <table class="table table-bordered" width="100%">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th style="display: none" width="5%">#</th>
                                                        <th >Product Name<span style="font-size: 1.1rem; " class="text-danger fw-bold">*</span></th>
                                                        <th >Brand</th>
                                                        <th >Type</th>
                                                        <th >Unit</th>
                                                        <th >Stocks</th>
                                                        <th >Qty<span style="font-size: 1.1rem; " class="text-danger fw-bold">*</span></th>
                                                        <th >Price</th>
                                                        <th >Total</th>
                                                        <th align="center" width="2%">
                                                            <a type="button" class="btn btn-sm bg-gradient-success add_more">
                                                                <i class="fas fa-plus"></i>
                                                            </a>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="addMoreProduct">
                                                    <tr>
                                                        <td style="display: none">1</td>
                                                        <td>
                                                            <select required class="form-control product_id select2bs4" name="product_id[]" id="product_id" style="width: 100%; margin-bottom: 14px;">
                                                                <option value="" disabled hidden selected>Select an item here...</option>
                                                                @foreach ($products as $item)
                                                                    <option data-brand="{{ $item->brand }}" data-type="{{ $item->product_type }}" data-unit="{{ $item->unit  }}" data-price="{{ $item->price }}" value="{{ $item->id }}" data-stocks="{{ $item->stocks }}">{{ $item->name }}</option>
                                                                @endforeach
                                                              </select>
                                                        </td>
                                                        <td style="padding: 1px; padding-top: 0.75rem;"><input type="text" name="brand[]" id="brand" class="form-control brand text-center border-0" readonly style="background-color: white; width: 100%; padding: 0px!important"></td>
                                                        <td style="padding: 1px; padding-top: 0.75rem;"><input type="text" name="type[]" id="type" class="form-control type text-center border-0" readonly style="background-color: white; width: 100%; padding: 0px!important"></td>
                                                        <td style="padding: 1px; padding-top: 0.75rem;"><input type="text" name="unit[]" id="unit" class="form-control unit text-center border-0" readonly style="background-color: white; width: 100%; padding: 0px!important"></td>
                                                        <td style="padding: 1px; padding-top: 0.75rem;"><input type="text" name="stocks[]" id="stocks" class="form-control stocks text-center border-0" readonly style="background-color: white; width: 100%; padding: 0px!important"></td>
                                                        <td>
                                                            <input required type="number" min="1" name="quantity[]" id="quantity" class="form-control quantity text-center">
                                                        </td>

                                                        <td>
                                                            <input type="number" name="price[]" id="price" class="form-control price text-center" placeholder="0.00" readonly style="background-color: white; font-weight:bold">
                                                        </td>
                                                        <td>
                                                            <input type="number" name="total_amount[]" id="total_amount" class="form-control total_amount text-center" placeholder="0.00" readonly style="background-color: white; font-weight:bold">
                                                        </td>
                                                        <td align="center">
                                                            <a type="button"  class="btn btn-sm btn-danger delete">
                                                                <i class="fas fa-times"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="sticky-top mb-3">
                              <div class="card" style="border-radius: 0px!important;">
                                <div class="card-header bg-gradient-info" >
                                    <h4 class="card-title font-weight-bold">
                                        Customer Information
                                    </h4>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <h4>Total Amount : <strong class="float-right">&#8369;<strong class="float-right total"> 0.00</strong></strong></h4>
                                    <strong><hr></strong><hr>
                                    <div class="row bg-light">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label > Customer Name<span style="font-size: 1.1rem; " class="text-danger fw-bold">*</span></label>
                                                <input required type="text" class="form-control" name="name" placeholder="Enter Customer Name" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label >{{ __('Contact No.') }}<small style="font-style: italic"> (09xx-xxx-xxxx)</small><span style="font-size: 1.1rem; " class="text-danger fw-bold">*</span></label>
                                                <input required  placeholder="Enter customer contact no." type="tel" pattern="[0]{1}[9]{1}[0-9]{2}-[0-9]{3}-[0-9]{4}" id="contact-no" maxlength="13" type="text"
                                                 class="form-control" name="phone_no" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label >Payment<span style="font-size: 1.1rem; " class="text-danger fw-bold">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text">&#8369; </span>
                                                    </div>
                                                    <input style="text-align: right; font-weight:bold" required id="paid_amount" type="number"
                                                            class="form-control paid_amount amtPd" name="paid_amount" placeholder="0" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label >Change / Balance</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text">&#8369; </span>
                                                    </div>
                                                    <input required  type="number" readonly min="0" id="balance" class="form-control" name="balance"  style="background-color: white; font-weight:bold; text-align:right;" placeholder="0">
                                                </div>
                                                <span style="display: none;" id="msg" class="text-danger"><strong>Please make sure the payment is sufficient.</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" id="btnSubmit" disabled class="btn btn-block bg-gradient-success">Receive Payment</button>
                                </div>
                              </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </section>
        </div>
    </div>

<!-- Scripts -->
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
    <!-- Select2 -->
    <script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/admin/js/adminlte.js') }}"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets/admin/js/demo.js') }}"></script>


<!-- END SCRIPT -->

<script src="{{ asset('assets/js/cashier.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#form').submit(function() {
            var myBalance = $('#balance').val(); //if #id2 is input element change from .text() to .val()
            if (myBalance < 0) {
                alert('Error, cant do that');
                return false;
            }
            else
            {
                return true;
            }
        });
    });
</script>
<script>
    $(".amtPd").on("input", function() {
        if (/^0/.test(this.value)) {
            this.value = this.value.replace(/^0/, "")
        }
    })
</script>
<script>
    $(document).ready(function (){
        document.querySelector(".amtPd").addEventListener("keypress", function (evt) {
            if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
            {
                evt.preventDefault();
            }
        });
    });
</script>
<script>
     $(function () {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4',
      placeholder: 'Search product here... '
    });
     });
</script>

<!-- SweetAlert -->
<script src="{{ asset('assets/js/sweetalert.js') }}"></script>

@if(session('success'))
    <script>
            swal(" ",{
                title: "{{ session('success') }}",
                icon: 'success',
                closeOnClickOutside: false,
                });
    </script>
@endif

@if(session('error'))
    <script>
            swal(" ",{
                title: "{{ session('error') }}",
                icon: 'error',
                closeOnClickOutside: false,
                });
    </script>
@endif
<script>
    var tele = document.querySelector('#contact-no');

    tele.addEventListener('keyup', function(e){
    if (event.key != 'Backspace' && (tele.value.length === 4 || tele.value.length === 8)){
    tele.value += '-';
    }
    });
</script>
</body>
</html>
