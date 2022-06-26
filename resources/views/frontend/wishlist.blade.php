@extends('new-frontend.layouts.front')
@section('title','My Wishlist')

@section('content')
<main class="main" style="background-color : rgb(234, 243, 255)!important;">
    <nav aria-label="breadcrumb" class="breadcrumb-nav bg-white">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    @if($wishlist->count() > 0)
        <div class="page-content">
            <div class="container">
                <table class="table table-wishlist table-mobile bg-white">
                    <thead>
                        <tr class="text-center" >
                            <th style="font-weight: 600 !important">Product</th>
                            <th style="font-weight: 600 !important">Price</th>
                            <th style="font-weight: 600 !important">Quantity</th>
                            <th style="font-weight: 600 !important">Stock Status</th>
                            <th  style="font-weight: 600 !important"></th>
                            <th width="10%" style="font-weight: 600 !important">Action</th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach ($wishlist as $item)
                        <tr class="product_data text-center">
                            <input type="hidden" class="product_id" value="{{ $item->products->id }}">
                            <input type="hidden" class="prod_name" value="{{ $item->products->name }}">
                            <input type="hidden" class="prod_stock" value="{{ $item->products->stocks }}">

                            <td class="product-col ">
                                <div class="product ">
                                    <figure class="product-media ml-5">
                                        <a href="javascript:void(0);">
                                            <img src="{{ asset('uploads/products/'.$item->products->image) }}" alt="Product image">
                                        </a>
                                    </figure>

                                    <h3 class="product-title">
                                        <a style="font-weight: 600" href="{{ url('category/'.$item->products->category->slug.'/'.$item->products->slug) }}">{{ $item->products->name }}</a>
                                    </h3><!-- End .product-title -->
                                </div><!-- End .product -->
                            </td>
                            <td class="price-col">&#8369; {{ number_format($item->products->price, 2) }}</td>
                            <td width="10%">
                                <center>
                                    <div class="product-details-quantity">
                                        <input type="number" name="quantity" id="qty" class="form-control qty-input" value="1" min="1" max="{{ $item->products->stocks }}" step="1" data-decimals="0" required>
                                    </div><!-- End .product-details-quantity -->
                                </center>

                            </td>
                            @if($item->products->stocks > 0)
                                <td class="stock-col">
                                    <span class="in-stock text-success" style="font-weight: 600;">In stock</span>
                                </td>
                                <td class="action-col">
                                    @if(!Auth::user()->email_verified_at)
                                        <button class="btn btn-block btn-primary" onclick="swal({title:'Please verify your email to continue.',icon:'info'});" title="Add to Cart"><i class="icon-cart-plus"></i>Add to Cart</button>
                                    @else
                                        <button class="btn btn-block btn-primary btnCart" title="Add to Cart"><i class="icon-cart-plus"></i>Add to Cart</button>
                                    @endif
                                </td>
                                @else
                                    <td class="stock-col text-danger" style="font-weight: 600;"><span class="out-of-stock">Out of stock</span></td>
                                    <td class="action-col">
                                        <button class="btn btn-block btn-primary disabled"><i class="icon-cart-plus"></i>Add to Cart</button>
                                    </td>
                                @endif
                            <td width="10%" class="remove-col">
                                <center>

                                    <button  class="btn-remove delete-wish-item text-danger"><strong><i title="Remove {{ $item->products->name }}" class="icon-close text-danger"></i></strong>
                                    </button>
                                </center>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table><!-- End .table table-wishlist -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    @else
    <div class="py-5 bg-light "  style="margin-top: -40px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mycard py-5 text-center">
                    <div class="mycards">
                        <span><i class="far fa-heart fa-9x"></i></span>
                        <h4 class="mt-3">No products added to wishlist.</h4>
                        <a href="{{ route('frontend.shop') }}" class="btn btn-upper btn-primary outer-left-xs mt-5">Go Shop</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</main>

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
{{-- <script>
    $('select').on('change',function(){
  var quantity =  $( "select option:selected" ).val();
  var token = $(this).data('token');
  var base_url = $(this).data('url');
//   alert(quantity);
     $.ajax({
        url:base_url+'/update-wish',
        type: 'POST',
        data: { _token :token,quantity:quantity },
        success:function(msg){
           alert("success");
        }
     });

})
</script> --}}
@endsection
