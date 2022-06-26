@extends('new-frontend.layouts.front')

@section('title')
    My Cart
@endsection

<head>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}">
</head>
@section('content')
@if($cartItems->count() > 0)
    <main class="main" style="background-color: rgb(234, 243, 255)!important;">
        <nav aria-label="breadcrumb" class="breadcrumb-nav bg-white">
            <div class="container-fluid">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="container-fluid carts">
            <div class="d-flex justify-content-end mb-1">
                <a class="btn text-white btn-danger delete-all"><span><i class="fas fa-trash-alt"></i></span> Clear Cart</a>
            </div>
            <div class="table-responsive">
                <table id="cart" class="table bg-white table-hover table-condensed" style="border-top: 1px solid; border-bottom: 1px solid black;">
                    <thead class="text-center">
                        <tr>
                            <th style="width:50%; "><center><h6>Product Description</h6></center></th>
                            <th style="width: 15%;"><center><h6>Unit Price</h6></center></th>
                            <th style="width:15%"><center><h6>Quantity</h6></center></th>
                            <th class="text-center" width="5%"><h6>Total Price</h6></th>
                            <th><h6>Action</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalPrice=0; $grandTotal = 0; @endphp
                        @foreach ($cartItems as $item)
                        <tr class="product_data">
                                <td >
                                    <div class="row">
                                        <div class="col-lg-4 ">
                                            <a href="{{ url('category/'.$item->products->category->slug.'/'.$item->products->slug) }}"style="text-decoration: none;">
                                                <img src="{{ asset('uploads/products/'.$item->products->image) }}" align="center" class="mr-auto mx-auto d-block" width="140px" height="140px" alt="Product Image"/>
                                            </a>
                                        </div>
                                        <div class="col-lg-8">
                                            <h4 onclick="window.location.href='{{ url('category/'.$item->products->category->slug.'/'.$item->products->slug) }}';" class="prod_name" style="cursor: pointer">{{ $item->products->name }}</h4>
                                            <small>Brand: {{ $item->products->brand }}
                                            <br>Type: {{ $item->products->product_type }}
                                            <br>Unit: {{ $item->products->unit }}
                                        </small>

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
                                <td class="product-unit-price actions"  data-th="Price: " ><center><span id="price" class="price" data-th1>&#8369; {{ number_format($item->products->price, 2) }}</span></center> </td>
                                <td data-th="Quantity: " data-th1>
                                    @if ($item->products->stocks >= $item->product_qty)
                                        <div class="input-group text-center ">
                                            @if($item->product_qty == 1)
                                                <a class="s1 input-group-text delete-cart-item border-secondary border-right-0 bg-white" disabled style="cursor: pointer; font-size: 20px;">-</a>
                                                <input readonly  href="#exampleModal{{ $item->id }}" data-toggle="modal"  type="text" value="{{ $item->product_qty }}" class="form-control border-secondary border-left-0 border-right-0 bg-white text-dark text-center qty-input" style="cursor: pointer;">
                                                <button class="s1 input-group-text bg-white border-secondary border-left-0 increment-btn changeQuantity" style="cursor: pointer; font-size: 20px;">+</button>
                                            @else
                                                <button  class="s1 input-group-text decrement-btn changeQuantity border-secondary border-right-0 bg-white" style="cursor: pointer; font-size: 20px;">-</button>
                                                <input readonly  href="#exampleModal{{ $item->id }}" data-toggle="modal" type="text" value="{{ $item->product_qty }}" class="form-control border-secondary border-left-0 border-right-0 bg-white text-dark text-center qty-input" style="cursor: pointer;">
                                                @if($item->product_qty == $item->products->stocks)
                                                <input type="hidden" class="name" value="{{ $item->products->name }}">
                                                    <button class="s1 input-group-text oops bg-white border-secondary border-left-0" style="cursor: pointer; font-size: 20px;">+</button>
                                                @else
                                                    <button class="s1 input-group-text increment-btn changeQuantity bg-white border-secondary border-left-0" style="cursor: pointer; font-size: 20px;">+</button>
                                                @endif
                                            @endif
                                        </div>
                                        <td data-th="Total: " ><center><span>&#8369;</span><span id="total" class="total amount" data-th1 id="grandTotal">
                                            @php echo number_format($totalPrice = $item->products->price*$item->product_qty,2); @endphp
                                        </span></center></td>
                                        @php  number_format($grandTotal += $item->products->price*$item->product_qty,2);@endphp

                                    @else
                                        <div class="text-center ">
                                            <h6 class="text-danger ">Insufficient Stock</h6>
                                            <h6 class="text-danger ">Current Stock in your Cart (<b>{{ $item->product_qty }}</b>)</h6>
                                            <a class="text-info " href="#exampleModal{{ $item->id }}" data-toggle="modal"   style="cursor: pointer; text-decoration: underline">Update?</a>
                                        </div>
                                        <td data-th="Total: " ><center><span id="total" class="total" data-th1 id="grandTotal">&#8369; @php echo number_format($totalPrice = $item->products->price*0,2); @endphp  </span></center></td>

                                    </td>
                                    @endif
                                <td data-th="Action: " class="actions">
                                    <a class="delete-cart-item"style="cursor: pointer;" title="Delete {{ $item->products->name }}" onMouseOver="this.style.color='#fb5533'" onMouseOut="this.style.color='black'"><i class="fas fa-times-circle" ></i> Remove</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                            <a class="nav-link active" id="address-tab" data-toggle="tab" href="#new-address" role="tab" aria-controls="new-address" aria-selected="true">{{ $item->products->name }}</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content" id="tab-content-5">
                                                        <div class="tab-pane fade show active" id="new-address" role="tabpanel" aria-labelledby="address-tab">
                                                            <form method="post" action="{{ url('update-cart/'.$item->id) }}">
                                                                @csrf
                                                                {{-- <h5 for="qty" class="text-center col-form-label">{{ __('Add quantity') }}</h5> --}}
                                                                <div  style="width: 100%;">
                                                                    <input type="number" name="quantity"  class="form-control  qty-input" value="{{ $item->product_qty }}" min="1" max="{{ $item->products->stocks }}" step="1" required onkeydown="return event.keyCode !== 69" />
                                                                </div><!-- End .product-details-quantity -->

                                                                <div class="form-choice">
                                                                    <div class="row">
                                                                        <div class="col-sm-12 ">
                                                                            <div class="">
                                                                                <center>
                                                                                    <button type="submit" class="btn btn-block btn-success mt-2">
                                                                                        Update
                                                                                        <i class="icon-arrow-right"></i>
                                                                                    </button>
                                                                                </center>
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
                            @endforeach
                    </tbody>
                    <tfoot class="m-4">
                        <div id="totalajaxCall">
                            <tr class="totalAmountLoad ">
                                <td   class="border-0"><a href="{{ url('/') }}" class="btn btn-warning"><span><i class="fas fa-long-arrow-left"></i> Continue Shopping</span></a></td>
                                <td   colspan="2" class="hidden-xs border-0"></td>

                                <td  class="hidden-xs text-center col-md-4 border-0">
                                    <span >
                                        <strong class="TotalAmount">Total Amount: &#8369;{{ number_format($grandTotal,2) }}</strong>
                                    </span>
                                </td>
                                <td  class="border-0">
                                    @if (Auth::user())
                                        <a href="{{ url('checkout') }}" class="btn btn-success btn-block checkout-btn" role="button" ><span>Checkout <i class="fas fa-long-arrow-right"></i></span></a></td>
                                    @endif
                            </tr>
                        </div>
                    </tfoot>
                </table>
            </div>
        </div>
    </main><!-- End .main -->
@else
    <nav aria-label="breadcrumb" class="breadcrumb-nav bg-white">
        <div class="container ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="py-5 bg-light "  style="margin-top: -40px;">
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

<!-- JQuery CDN-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@if(session('success'))
    <script>
        swal({
            title: "{{ session('success') }}",
            text: " ",
            icon: 'success',
            closeOnClickOutside: false,
        });
    </script>
@endif
@endsection
