@extends('layouts.front')

@section('title')
    Checkout
@endsection
<head>
    <style>
        .btnPlace:hover
        {
            background-color: black;
            color: black;
        }
        @media screen and (max-width: 320px) {
            .response {
                font-size: 14px;
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
            {{-- <hr class="my-4"> --}}

            <div class="container bg-light shadow-sm">
                <div class="row">
                    <div class="card py-3">
                        <div class="col-md-12">
                            <h4  class="d-flex justify-content-between align-items-center mb-3">
                                <span style="color:#ee4d2d; font-style: 12px;"><span><i class="fas fa-map-marker-alt"></i></span> Delivery Address</span>
                                <a href="{{ url('my-address') }}" id="change" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i> Add</a>
                            </h4>
                        </div>
                        <form action="{{ url('place-order') }}" method="POST" name="myForm">
                            {{ csrf_field() }}
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    {{-- <tr><th>Delivery Addresses</th></tr> --}}
                                    @foreach ($deliveryAdresses as $address)
                                        <tr>
                                            <td>
                                                <div class="p-2 pt-0">
                                                    <div class="custom-control custom-radio">
                                                        <label class="custom-control-label">
                                                            <input type="radio" class="custom-control-input" checked>
                                                            <strong> {{ $address['fname'].' '.$address['lname'] }}</strong>
                                                            {{ ' | '.$address['phone_no'].' | '.$address['detailed_address'].', '.$address['barangay'].', '.$address['city'].', '.$address['postal_code'] }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            {{-- <ul class="mb-0">
                                <li style="border: none" class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <input type="hidden" name="fname" value="{{ $user_address->fname }}">
                                        <input type="hidden" name="lname" value="{{ $user_address->lname }}">
                                        <input type="hidden" name="phone_no" value="{{ $user_address->phone_no }}">
                                        <input type="hidden" name="address" value="{{ $user_address->detailed_address.', '.$user_address->barangay.', '.$user_address->city.', '.$user_address->postal_code }}">
                                        <input type="hidden" name="email" value="{{ $user_address->email }}">

                                        <h6 class="my-0"><strong><span>{{ Auth::user()->fname }}</span> <span> {{ Auth::user()->lname}}</span> </strong>
                                            <strong class="text-muted">{{ ' | '.Auth::user()->phone_no }}</strong>
                                            <small class="text-muted">{{ ' | '.Auth::user()->detailed_address.', '.Auth::user()->barangay.', '.Auth::user()->city }}</small>
                                        </h6>
                                    </div>
                                </li>
                            </ul> --}}
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
                                    <th width="25%" class="text-left text-muted">Products Ordered</th>
                                    <th class="text-center text-muted">Unit Price</th>
                                    <th class="text-center text-muted">Qty.</th>
                                    <th class="text-center text-muted">Amount</th>
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
                                                <small class="text-muted">{{ $item->products->product_type }}</small>
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
                                    <th class="text-center text-muted">
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
                                    <div class="p-2 pt-0">
                                        <div class="custom-control custom-radio">
                                            <input id="cod" name="paymentMethod" type="radio" class="custom-control-input" onclick="show1();" checked >
                                            <label class="custom-control-label" for="cod">Cash on Delivery</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input id="cheque" name="paymentMethod" type="radio" class="custom-control-input" onclick="show2();" >
                                            <label class="custom-control-label" for="cheque">GCash</label>
                                        </div>
                                        <div class="row hide" style="display: none" id="div1">
                                            <div class="col-md-12 mb-3">
                                                <label for="acc-img mt-2">Upload the Image including a receipt.</label>
                                                <input type="file" class="form-control mt-2" id="file-upload-button" name="gcash">
                                                <small class="text-muted mt-2"><b>Note:</b> Please send a payment to this gccash account: <strong>0948-280-3931.</strong> If the image provided is incorrect, your order will remain pending.</small>
                                            </div>
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
                                            <a class="btn btn-warning" href="{{ url('my-cart') }}">
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
@endsection
