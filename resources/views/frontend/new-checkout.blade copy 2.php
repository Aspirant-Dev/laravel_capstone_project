@extends('layouts.front')

@section('title')
    Checkout
@endsection
<head>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/adminlte.min.css') }}">
    <style>
        .btnPlace:hover
        {
            background-color: black;
            color: black;
        }
        @media screen and (max-width: 376px) {
            .response2 {
                font-size: 18px!important;
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
    <div class="py-3 mb-4 shadow-sm">
        <div class="container">
            <h6 class="mb-0"><a href="{{ url('/') }}">Home</a> / <a href="{{ url('/cart') }}">Cart</a> / Checkout</h6>
        </div>
    </div>
    @if($cartItems->count() > 0)
        <div class="container">
            <div class=" text-center">
                <h3>Checkout</h3>
            </div>
            @if(Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close btnclose" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-times"></i> Oops!</h5>
                    Please make sure that Delivery Address and Payment Method is selected.
                </div>
            @endif
            <div class="container shadow-sm mb-2" style="background-color: white">
                <div class="row">
                    <div class="py-3 pb-0">
                        <div class="col-md-12" >
                            <h5 class="d-flex justify-content-between align-items-center  response2" >
                                <span style="color:#ee4d2d; font-style: 12px;"><span><i class="fas fa-map-marker-alt"></i></span> Delivery Address</span>
                                <div class="response2">
                                    <a style="cursor:pointer; color:#003a5c; font-size: 14px!important;" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus"></i> Add</a>
                                    <a href="{{ url('my-address') }}" type="button" class="btn btn-sm" style="color:#003a5c; font-size: 14px;" ><i class="fas fa-cogs"></i> Manage</a>
                                </div>
                            </h5>
                        </div>
                        @include('layouts.inc.add-address-modal')
                        <form action="{{ url('place-order') }}" method="POST" name="checkoutForm" id="checkoutForm">
                        {{ csrf_field() }}

                        <div class="row p-3 pt-0 pb-0">
                            <div class="table-responsive">
                                @foreach ($deliveryAdresses as $address)
                                    <div class="d-flex justify-content-between align-items-center response2">
                                        <div class="form-check">
                                            <label class="form-check-label"></label>
                                                <input class="form-check-input" type="radio" name="address_id" id="address{{ $address['id'] }}" value="{{ $address['id'] }}" style="cursor: pointer">
                                                <strong> {{ $address['fname'].' '.$address['lname'] }}</strong>
                                                {{ ' | '.$address['phone_no'].' | '.$address['detailed_address'].', '.$address['barangay'].', '.$address['city'].', '.$address['postal_code'] }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-12">
                    <div class="card py-3 shadow-sm">
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless">
                                <thead>
                                    <th></th>
                                    <th width="5%"> </th>
                                    <th width="25%" class="text-left text-muted response">Products Ordered</th>
                                    <th class="text-center text-muted response">Unit Price</th>
                                    <th class="text-center text-muted response">Qty.</th>
                                    <th class="text-center text-muted response">Amount</th>
                                </thead>
                                @php
                                    $total = 0;
                                @endphp

                                @foreach ($cartItems as $item)
                                <tbody>
                                        <tr class="text-center">
                                            <td></td>
                                            <td class="text-start"><img src="{{ asset('uploads/products/'.$item->products->image) }}" width="60px" height="60px" alt="" srcset=""></td>
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
                                            <td>&#8369;{{ number_format($item->product_qty*$item->products->price,2) }}</td>
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
            <div class="row mt-1">
                <div class="col-md-12">
                    <div class="card py-3 shadow-sm">
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless">
                                <thead>
                                    <th class="text-center text-muted response">
                                        <span class="text-muted justify-content-start">Received by <br>
                                            @php
                                                $mytime = Carbon\Carbon::now()->addDays(3)->format('d ');
                                                $addtime = Carbon\Carbon::now()->addDays(5)->format('d M');
                                                echo $mytime.'-'. $addtime;
                                            @endphp
                                        </span>
                                    </th>
                                    <th class="text-muted text-center"></th>
                                    <th class="text-muted text-center"></th>
                                    <th class="text-muted text-center"></th>
                                    <th class="text-muted"></th>
                                    <th class="text-end text-muted response" ><span> Order Item <br> ({{ count($cartItems) > 1 ? count($cartItems).' items' : count($cartItems).' item' }})</span></th>
                                    <th class="text-center" >
                                        <span>
                                            Total: <br>
                                            <span style=" color: #dc3545">
                                                <input type="hidden" name="total" value="&#8369;{{ number_format($total,2) }}">
                                                &#8369;{{ number_format($total,2) }}
                                            </span>
                                        </span>
                                    </th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-12">
                    <div class="card" >
                        <div class="card-header" style="background-color: white">
                            <div>
                                <div class="d-block my-3">
                                    <h5>
                                        Payment Method
                                    </h5>
                                    <div class="p-2 pt-0" >
                                        <div class="custom-control custom-radio " style="cursor: pointer">
                                            <input id="cod"  name="paymentMethod" type="radio" class="custom-control-input" value="COD" >
                                            <label class="custom-control-label" for="cod">Cash on Delivery</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input id="paypal" name="paymentMethod" style="cursor: pointer" type="radio" class="custom-control-input" value="Paypal" >
                                            <label class="custom-control-label" for="paypal">Paypal</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input id="gcash" name="paymentMethod" type="radio" style="cursor: pointer" class="custom-control-input"  value="GCash">
                                            <label class="custom-control-label" for="gcash">GCash</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card py-1 pb-0" >
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless">
                                <thead>
                                    <tr>
                                        <th class="text-start">
                                            <a class="btn btn-warning" href="{{ url('cart') }}">
                                                <span><i class="fas fa-shopping-bag"></i> Edit Cart</span>
                                            </a>
                                        </th>
                                        <th class="text-end">
                                            <button class="btn btn-success" type="submit">
                                                <span> Place Order <i class="fas fa-clipboard-check"></i></span>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    @else
        <div class="py-3 mb-4 bg-light shadow-sm">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mycard py-5 text-center">
                        <div class="mycards">
                            <h4>Your cart is currently empty.<br/>Checkout is unavailable.</h4>
                            <a href="{{ url('/') }}" class="btn btn-upper btn-primary outer-left-xs mt-5">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        function show1(){
            document.getElementById('div1').style.display ='none';
        }
        function show2(){
            document.getElementById('div1').style.display = 'flex';
        }
    </script>

@section('scripts')

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
@endsection
