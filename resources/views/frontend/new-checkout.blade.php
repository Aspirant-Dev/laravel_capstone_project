@extends('new-frontend.layouts.front')

@section('title')
    Checkout
@endsection
<head>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <style>

        .btnPlace:hover
        {
            background-color: black;
            color: black;
        }
        @media screen and (max-width: 376px) {
            .response2 {
                font-size: 12px!important;
            }
        }
        @media screen and (max-width: 320px) {
            .response {
                font-size: 14px;
            }
            .response2 {
                font-size: 12px!important;
            }
        }
    </style>
</head>
@section('content')
    @if($cartItems->count() > 0)
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="address-tab" data-toggle="tab" href="#new-address" role="tab" aria-controls="new-address" aria-selected="true">Add New Address</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="new-address" role="tabpanel" aria-labelledby="address-tab">
                                    <form method="POST" action="{{ route('delivery-address') }}" class="needs-validation" novalidate>
                                        @csrf

                                        <!-- First Name && Last Name -->
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="email" value="{{ Auth::user()->email }}">

                                                <label for="fname" class="col-md-6 col-form-label">{{ __('First Name') }}</label>
                                                <input id="fname"  required placeholder="Ex. Juan" type="text"  class="form-control @error('fname') is-invalid @enderror"
                                                    name="fname" value="{{ old('fname') }}"  autocomplete="off">
                                                <div class="invalid-feedback text-start fw-bold">This field is required.</div>

                                                @error('fname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ ('First name is required') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lname" class="col-md-6 col-form-label">{{ __('Last Name') }}</label>
                                                <input id="lname" required placeholder="Ex. Dela Cruz" type="text" class="form-control @error('lname') is-invalid @enderror"
                                                name="lname" value="{{ old('lname') }}">
                                                <div class="invalid-feedback text-start fw-bold">This field is required.</div>
                                                @error('lname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ ('Last name is required') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Contact -->
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label class="col-form-label">{{ __('Contact No.') }}<small style="font-style: italic"> (09xx-xxx-xxxx)</small></label>
                                                <input required id="contact-no" placeholder="Enter you contact no." maxlength="13" type="tel" pattern="[0]{1}[9]{1}[0-9]{2}-[0-9]{3}-[0-9]{4}" title="Please follow the format."
                                                    class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}"  autocomplete="off">
                                                <div class="invalid-feedback text-start fw-bold">This field is required. Please follow the format.</div>

                                                @error('phone_no')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ ('Contact number is required') }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>
                                        <br>
                                        <!-- City -->
                                        <!-- Barangay -->
                                        <!-- Postal Code -->
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <p style="font-style:italic;"><small><b>Note: </b>Please select first the city to choose barangay and the postal code will auto filled.</small></p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="city" class=" col-form-label">{{ __('City') }}</label>
                                                <select id="options" required class="custom-select form-control @error('city') is-invalid @enderror"  name="city">
                                                    <option value="" disabled hidden selected>Please select...</option>
                                                    <option value="Bocaue">Bocaue</option>
                                                    <option value="Marilao">Marilao</option>
                                                    <option value="Meycauayan">Meycauayan</option>
                                                </select>

                                                <div class="invalid-feedback text-start fw-bold">Please select a city from the list.</div>
                                                @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ ('Please select a city in the list') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="barangay" class=" col-form-label">{{ __('Barangay') }}</label>
                                                <select id="choices" required class="custom-select form-control @error('barangay') is-invalid @enderror" name="barangay">
                                                    <option value="" disabled selected>Please select city...</option>
                                                </select>
                                                @error('barangay')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ ('Please select a barangay in the list') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="postal-code" style="display: none" class=" col-form-label">{{ __('Postal Code') }}</label>
                                                <select id="pc" required style="display: none" class=" form-control @error('postal_code') is-invalid @enderror" name="postal_code">
                                                    <option value="" disabled hidden selected></option>
                                                </select>
                                                @error('postal_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ ('Postal code is required') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Detailed Address -->
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="detailed-address" class="col-form-label">{{ __('Detailed Adress') }}</label>
                                                <p style="margin-top: -8px; margin-bottom: 10px"><small>Unit number, house number, building, street name</small></p>
                                                <input id="detailed-address" required placeholder="Set Detailed Address" type="text" class="form-control @error('detailed_address') is-invalid @enderror" name="detailed_address" value="{{ old('detailed_address') }}"  autocomplete="off" >

                                                <div class="invalid-feedback text-start fw-bold">This field is required.</div>
                                                @error('detailed_address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ ('Please set your detailed address') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-footer">
                                        </div><!-- End .form-footer -->

                                        <div class="form-choice">
                                            <div class="row">
                                                <div class="col-sm-12 ">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                                                            <i class="icon-close"></i>
                                                            Close
                                                        </button>
                                                        <button type="submit" class="btn btn-success">
                                                            Submit
                                                            <i class="icon-arrow-right"></i>
                                                        </button>
                                                    </div>
                                                </div><!-- End .col-6 -->
                                            </div><!-- End .row -->
                                        </div><!-- End .form-choice -->
                                    </form>
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div>
    {{-- <main class="main bg-light"> --}}
        <nav aria-label="breadcrumb" class="breadcrumb-nav" style="background-color: white">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

            @if(Session::has('error_message'))
                <div class="container mb-1">
                    <div class="row">
                        <div style="width: 100%" >
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close btnclose" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5 class="text-white"><i class="icon fas fa-times"></i> Oops!</h5>
                                Please make sure that Delivery Address and Payment Method is selected.
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="mb-3">
                <div  class="container" >
                    <div class="row">
                        <div style="width: 100%" >
                            <div style="border: 1px solid rgb(172, 170, 170)" class="card shadow">
                                <div class="d-flex" style="font-size: 18px;">
                                    <div  class="mr-auto p-2"><strong style="color:#ee4d2d;  "><i class="fas fa-map-marker-alt"></i> Delivery Address</strong></div>
                                    <div class="p-2"><a style="cursor:pointer; color:#003a5c; font-family: 'Poppins'; font-size: 16px;" href="#exampleModal" data-toggle="modal"><i class="fas fa-plus"></i> Add</a></div>
                                    <div class="p-2"><a href="{{ url('my-address') }}" style="color:#003a5c; font-size: 16px;"><i class="fas fa-cogs"></i> Manage</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div  class="container">
                    <div class="row">
                        <div  style="width: 100%" >
                            <div style="border: 1px solid rgb(172, 170, 170)" class="card shadow">
                                <div class="py-3 pb-0">
                                    <form action="{{ url('place-order') }}" method="POST" name="checkoutForm" id="checkoutForm">
                                    {{ csrf_field() }}
                                    <div class="row ml-2 p-3 pt-0 pb-0">
                                        <div class="table-responsive">
                                            @foreach ($deliveryAdresses as $address)
                                                    <div class="custom-control custom-radio " style="cursor: pointer">
                                                        <input style="cursor: pointer;" required type="radio" class="custom-control-input" name="address_id" id="address{{ $address['id'] }}" value="{{ $address['id'] }}">
                                                        <label  class="custom-control-label" for="address{{ $address['id'] }}"><strong style="cursor: pointer;"> {{ $address['fname'].' '.$address['lname'] }}</strong>
                                                            {{ ' | '.$address['phone_no'].' | '.$address['detailed_address'].', '.$address['barangay'].', '.$address['city'].', '.$address['postal_code'] }}</label>
                                                    </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div  class="container">
                    <div class="row mt-1">
                        <div style="width: 100%">
                            <div style="border: 1px solid rgb(172, 170, 170)" class="card py-3 shadow">
                                <div class="table-responsive">
                                    <table class="table table-hover table-borderless">
                                        <thead>
                                            <th></th>
                                            <th width="15%"> </th>
                                            <th width="25%" class="text-left text-muted response">Products Ordered</th>
                                            <th class="text-center text-muted response">Unit Price</th>
                                            <th class="text-center text-muted response">Qty.</th>
                                            <th class="text-center text-muted response">Amount</th>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($cartItems as $item)
                                                <tr class="text-center">
                                                    <td></td>
                                                    <td class="text-center p-3 "><img src="{{ asset('uploads/products/'.$item->products->image) }}" style="height: 100px;" width="100%"alt="" srcset=""></td>
                                                    <td >
                                                        <span class="fw-bold">
                                                            {{ $item->products->name }}
                                                        </span>
                                                        <br>
                                                        <small class="text-muted">Brand: {{ $item->products->brand }}</small><br>
                                                        <small class="text-muted">Type: {{ $item->products->product_type }}</small><br>
                                                        <small class="text-muted">Unit: {{ $item->products->unit }}</small>
                                                    </td>
                                                    <td>&#8369;{{ number_format($item->products->price,2) }}</td>
                                                    <td><small class="text-muted">x</small>{{ $item->product_qty }}</td>
                                                    <td>&#8369; {{ number_format($item->product_qty*$item->products->price,2) }}</td>
                                                </tr>
                                                @php
                                                    $total += $item->product_qty*$item->products->price;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div  class="container">
                    <div class="row mt-1">
                        <div style="width: 100%">
                            <div style="border: 1px solid rgb(172, 170, 170)" class="card py-3 shadow">
                                <div class="table-responsive">
                                    <div class="d-flex p-3">
                                        <div class="mr-auto p-2"><strong>Received by <br> @php
                                            $mytime = Carbon\Carbon::now()->addDays(1)->format('d ');
                                            $addtime = Carbon\Carbon::now()->addDays(3)->format('d M');
                                            echo $mytime.'-'. $addtime;
                                        @endphp</strong></div>
                                        <div class="p-2"><strong>Order Item <br> ({{ count($cartItems) > 1 ? count($cartItems).' items' : count($cartItems).' item' }})</strong></div>
                                        <div class="p-2"></div>
                                        <div class="p-2"></div>
                                        <div class="p-2"><strong>Total Amount: <br>
                                            <span style=" color: #dc3545">
                                                <input type="hidden" name="total" value="&#8369;{{ number_format($total,2) }}">
                                                &#8369; {{ number_format($total,2) }}
                                            </span></strong></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div  class="container">
                    <div class="row mt-1">
                        <div style="width: 100%">
                            <div style="border: 1px solid rgb(172, 170, 170)" class="card shadow" >
                                <div class="card-header">
                                    <div>
                                        <div class="d-block my-3 p-3">
                                            <h5>
                                                Payment Method
                                            </h5>
                                            <div class="p-2 pt-0" >
                                                <div class="custom-control custom-radio ">
                                                    <input id="cod" required  name="paymentMethod" type="radio" class="custom-control-input" value="COD" >
                                                    <label class="custom-control-label" for="cod"><strong style="cursor: pointer;">Cash on Delivery</strong></label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input id="paypal" required name="paymentMethod" type="radio" class="custom-control-input" value="Paypal" >
                                                    <label class="custom-control-label" for="paypal"><strong style="cursor: pointer;">Paypal</strong></label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input id="gcash" required name="paymentMethod" type="radio" class="custom-control-input" value="GCash">
                                                    <label class="custom-control-label" for="gcash"><strong style="cursor: pointer;">GCash</strong></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div  class="container mt-2">
                    <div class="row">
                        <div style="width: 100%" >
                            <div style="border: 1px solid rgb(172, 170, 170)" class=" card py-1 pb-0 shadow" >
                                <div class="table-responsive">
                                    <div class="d-flex p-3" style="font-size: 18px;">
                                        <div  class="mr-auto p-2">
                                            <a class="btn btn-warning" href="{{ url('cart') }}">
                                                <span><i class="fas fa-shopping-bag"></i> Edit Cart</span>
                                            </a>
                                        </div>
                                        {{-- <div class="p-2"><a style="cursor:pointer; color:#003a5c; font-family: 'Poppins'; font-size: 16px;" href="#exampleModal" data-toggle="modal"><i class="fas fa-plus"></i> Add</a></div> --}}
                                        <div class="p-2">
                                            <button class="btn btn-success" type="submit">
                                                <span> Place Order <i class="fas fa-clipboard-check"></i></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
        </div>
    {{-- </main> --}}
    @else
    <nav aria-label="breadcrumb" class="breadcrumb-nav bg-white">
        <div class="container ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="py-3 mb-4 bg-light ">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mycard py-5 text-center">
                    <div class="mycards">
                        <span><i class="fas fa-shopping-basket fa-9x"></i></span>
                        <h4 class="mt-3">Your cart is currently empty.</h4>
                        <h4 class="mt-3">Checkout is unavailable.</h4>
                        <a href="{{ url('/') }}" class="btn btn-upper btn-primary outer-left-xs mt-5">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
            })
        })()
    </script>


<!-- JQuery CDN-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    var tele = document.querySelector('#contact-no');

    tele.addEventListener('keyup', function(e){
    if (event.key != 'Backspace' && (tele.value.length === 4 || tele.value.length === 8)){
    tele.value += '-';
    }
    });

</script>

<script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        function show1(){
            document.getElementById('div1').style.display ='none';
        }
        function show2(){
            document.getElementById('div1').style.display = 'flex';
        }
    </script>
    <script src="{{ asset('assets/js/auto-select.js') }}"></script>
    @if(Session::has('errors'))
    <script>
        $(document).ready(function(){
            $('#exampleModal').modal('show');
        });
    </script>
    @endif
    @if(session('alert'))
    <script>
        swal("",{
            title: "{{ session('alert') }}",
            icon: "success"
        });
    </script>
    @endif
@endsection
