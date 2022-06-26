@extends('layouts.front')

@section('title')
    My Cart
@endsection
<head>
    <link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}">
</head>
@section('content')
    <div class="py-3 mb-4 bg-light shadow-sm">
        <div class="container">
            <h6 class="mb-0"><a href="{{ url('/') }}">Home</a> / Cart</h6>
        </div>
    </div>
@if($cartItems->count() > 0)
    <div class="container mb-3">
        <nav class="navbar navbar-light ">
            <div class="container-fluid">
                <h2 style="color: #fb5533;">My Cart</h2>
                <a class="btn btn-danger delete-all"><span><i class="fas fa-trash-alt"></i></span> Clear Cart</a>
            </div>
        </nav>
    </div>
    <div class="container carts">
        <div class="table-responsive">
            <table id="cart" class="table table-hover table-condensed" style="border-top: 1px solid">
                <thead>
                    <tr>
                        <th style="width:50%; "><center>Product Description</center></th>
                        <th style="width: 15%;"><center>Unit Price</center></th>
                        <th style="width:15%"><center>Quantity</center></th>
                        <th class="text-center" width="5%">Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalPrice=0; $grandTotal = 0; @endphp
                    @foreach ($cartItems as $item)
                    <tr class="product_data">
                            <td >
                                <div class="row">
                                    <div class="col-md-4 ">
                                        <a href="{{ url('category/'.$item->products->category->slug.'/'.$item->products->slug) }}"style="text-decoration: none;">
                                            <img src="{{ asset('uploads/products/'.$item->products->image) }}" align="center" width="140px" height="140px" alt="Product Image"/>
                                        </a>
                                    </div>
                                    <div class="col-md-8">
                                        <h4 onclick="window.location.href='{{ url('category/'.$item->products->category->slug.'/'.$item->products->slug) }}';" class="mt-4 prod_name" style="cursor: pointer">{{ $item->products->name }}</h4>
                                        <p>Brand: {{ $item->products->brand }}
                                        <br>Type: {{ $item->products->product_type }}
                                        <br>Unit: {{ $item->products->unit }}
                                    </p>

                                            @if ($item->products->stocks > 1)
                                                <p class="mt-2" style="font-style: italic; color:#e06b6b"><b>{!! $item->products->stocks !!} items left</b></p>
                                            @elseif ($item->products->stocks == 1 )
                                                <p class="mt-2" style="font-style: italic; color:#e06b6b"><b>{!! $item->products->stocks !!} item left</b></p>
                                            @endif
                                        </p>

                                        <input type="hidden" class="product_name" value="{{ $item->products->name }}">
                                        <input type="hidden" class="product_id" value="{{ $item->products->id }}">
                                    </div>
                                </div>
                            </td>
                            <td class="product-unit-price"  data-th="Unit Price: " ><center><span id="price" class="price" data-th1>&#8369; {{ number_format($item->products->price, 2) }}</span></center> </td>
                            <td data-th="Quantity: " data-th1>
                                @if ($item->products->stocks >= $item->product_qty)
                                    <div class="input-group text-center mb-3">
                                        @if($item->product_qty == 1)
                                            <a class="s1 input-group-text delete-cart-item" disabled style="cursor: pointer">-</a>
                                            <input readonly type="text" value="{{ $item->product_qty }}" class="form-control text-center qty-input">
                                            <button class="s1 input-group-text increment-btn changeQuantity" style="cursor: pointer">+</button>
                                        @else
                                            <button  class="s1 input-group-text decrement-btn changeQuantity" style="cursor: pointer">-</button>
                                            <input readonly type="text" value="{{ $item->product_qty }}" class="form-control text-center qty-input">
                                            <button class="s1 input-group-text increment-btn changeQuantity" style="cursor: pointer">+</button>
                                        @endif
                                    </div>
                                    <td data-th="Total Price: " ><center><span>&#8369;</span><span id="total" class="total amount" data-th1 id="grandTotal">
                                        @php echo number_format($totalPrice = $item->products->price*$item->product_qty,2); @endphp
                                    </span></center></td>
                                    @php  number_format($grandTotal += $item->products->price*$item->product_qty,2);@endphp

                                @else
                                    <div class="text-center ">
                                        <h6 class="text-danger ">Out of Stock</h6>
                                        <h6 class="text-danger ">Insufficient Stock</h6>
                                        <h6 class="text-danger ">Current Stock in your Cart (<b>{{ $item->product_qty }}</b>)</h6>
                                    </div>
                                    <td data-th="Total Price: " ><center><span id="total" class="total" data-th1 id="grandTotal">&#8369; @php echo number_format($totalPrice = $item->products->price*0,2); @endphp  </span></center></td>

                                </td>
                                @endif
                            <td data-th="Action: " class="actions">
                                <a class="delete-cart-item"style="cursor: pointer;" onMouseOver="this.style.color='#fb5533'" onMouseOut="this.style.color='black'"><i class="fas fa-times-circle" ></i> Remove</a>
                            </td>
                        </tr>

                        @endforeach
                </tbody>
                <tfoot>
                    <div id="totalajaxCall">
                        <tr class="totalAmountLoad">
                            <td><a href="{{ url('/') }}" class="btn btn-warning">Continue Shopping</a></td>
                            <td colspan="2" class="hidden-xs"></td>
                            @php
                            @endphp
                            <td class="hidden-xs text-center col-md-4">
                                <span >
                                    <strong class="TotalAmount">Total Amount: &#8369;{{ number_format($grandTotal,2) }}</strong>
                                </span>
                            </td>
                            <td>
                                @if (Auth::user())
                                    <a href="{{ url('checkout') }}" class="btn btn-success btn-block checkout-btn" role="button" >Checkout </a></td>
                                @endif
                        </tr>
                    </div>
                </tfoot>
            </table>
        </div>
    </div>
    @else
        <div class="container mb-3">
                <h2 class="text-center" style="color: #fb5533;">My Cart</h2>
        </div>
        <div class="py-3 mb-4 bg-light shadow-sm">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mycard py-5 text-center">
                        <div class="mycards">
                            <span><i class="fas fa-shopping-basket fa-9x"></i></span>
                            <h4 class="mt-3">Your cart is currently empty.</h4>
                            <a href="{{ url('/') }}" class="btn btn-upper btn-primary outer-left-xs mt-5">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
