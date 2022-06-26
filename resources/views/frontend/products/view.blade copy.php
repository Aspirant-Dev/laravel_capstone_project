@extends('layouts.front')

@section('title',$products->name)
<head>
    <style>
        .checked
        {
            color: #f2b600;
        }
    </style>
</head>
{{-- @section('meta_description', $products->meta_description) --}}
@section('content')

  <!-- Modal -->
  <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">
            <form action="{{ url('/add-rating') }}" method="POST">
            @csrf

            <input type="hidden" name="product_id" value="{{ $products->id }}">
                <div class="modal-header p_data">
                    <h5 class="modal-title " id="exampleModalLabel">Rate this {{ $products->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="star-rating">
                        {{-- @if($user_rating)
                            @for ($i = 1 ; $i <=$user_rating->stars_rated; $i++)
                                <input id="star-{{ $i }}" type="radio" name="rating" checked value="{{ $i }}" />
                                <label for="star-{{ $i }}" title="1 star">
                                <i class="active fa fa-star " aria-hidden="true"></i>
                                </label>
                            @endfor
                            @for ($j =$user_rating->stars_rated+1; $j <= 5 ; $j++)
                            <input id="star-{{ $j }}" type="radio" name="rating" value="{{ $j }}" />
                            <label for="star-{{ $j }}" title="1 star">
                            <i class="active fa fa-star " aria-hidden="true"></i>
                            </label>
                            @endfor
                        @else --}}
                            <input id="star-1" type="radio" name="rating" value="1" />
                            <label for="star-1" title="1 star">
                            <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-2" type="radio" name="rating" value="2" />
                            <label for="star-2" title="2 stars">
                            <i class="active fa fa-star" aria-hidden="true"></i>
                            </label><input id="star-3" type="radio" name="rating" value="3" />
                            <label for="star-3" title="3 stars">
                            <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-4" type="radio" name="rating" value="4" />
                            <label for="star-4" title="4 stars">
                            <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-5" type="radio" name="rating" value="5" />
                            <label for="star-5" title="5 stars">
                            <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                        {{-- @endif --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btnRate">Submit</button>
                </div>
            </form>
      </div>
    </div>
  </div>

  <!-- List -->
<div class="py-3 mb-4 shadow-sm bg-light border-top">
    <div class="container">
        <h6 class="mb-0"><a href="{{ url('/') }}">Home</a> / <a href="{{ url('view-category/'.$products->category->slug) }}">{{ $products->category->name }}</a> / {{ $products->name }}</h6>
    </div>
</div>
  <!-- content -->
<div class="py-3">
    <div class="container">
        <div class="card bg-light shadow-sm product_data shadow-lg" style="border: 0.125px solid rgb(201, 201, 201)">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('uploads/products/'.$products->image) }}" class="w-100" alt="Product Image">
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0 mt-1 ">
                            {{ $products->name }}
                            @if ($products->trending)
                                <label style="font-size: 16px;" class="float-end badge bg-success trending_tag">Trending</label>
                            @endif
                        </h2>
                        {{-- @php
                            $ratenum = number_format($rating_value)
                        @endphp
                        <div class="rating">
                            @for ($i = 1; $i <=$ratenum ; $i++)
                                <i class="fas fa-star checked"></i>
                            @endfor
                            @for ($j = $ratenum+1 ; $j <= 5 ; $j++ )
                                <i class="fas fa-star"></i>
                            @endfor
                            @if ($ratings->count() > 1)
                                <span>{{ $ratings->count() }} Ratings</span>
                            @elseif($ratings->count() == 1)
                                <span>{{ $ratings->count() }} Rating</span>
                            @else
                                <span>No Rating for this product</span>
                            @endif
                        </div> --}}
                        <hr>
                        <p>Price : <b>&#8369;{{ number_format($products->price,2) }}</b></p>
                        <p>Brand: <b>{!! $products->brand !!}</b></p>
                        <p>Product Type: <b>{!! $products->product_type !!}</b></p>
                        @if ($products->stocks > 1)
                            <p class="mt-3" style="font-style: italic; color:#e06b6b"><b>{!! $products->stocks !!} items left</b></p>
                        @elseif ($products->stocks == 1 )
                            <p class="mt-3" style="font-style: italic; color:#e06b6b"><b>{!! $products->stocks !!} item left</b></p>
                        @endif
                        <hr>
                        @if($products->stocks > 0)
                            <label class="badge bg-success">In Stock</label>
                            <div class="row mt-2">
                                <div class="col-md-2">
                                    <input type="hidden" class="product_id" value="{{ $products->id }}">
                                    <input type="hidden" class="prod_name" value="{{ $products->name }}">
                                    <input type="hidden" class="prod_stock" value="{{ $products->stocks }}">
                                    <label for="Quantity">Quantity</label>
                                    <div class="input-group text-center mb-3">
                                        <span class="input-group-text decrement-btn" style="cursor: pointer">-</span>
                                        <input type="text" value="1" min="1" class="form-control text-center qty-input">
                                        <span class="input-group-text increment-btn" style="cursor: pointer">+</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <button type="button" class="btn btn-warning me-3 btnCart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                            </div>
                        @else
                            <label class="badge bg-danger">Out of Stock</label>
                            <div class="row mt-2">
                                <div class="col-md-2">
                                    <label for="Quantity">Quantity</label>
                                    <div class="input-group text-center mb-3">
                                        <span class="input-group-text" >-</span>
                                        <input type="text" value="1" class="form-control text-center ">
                                        <span class="input-group-text">+</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <button type="button" class="btn btn-warning me-3 " disabled><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="container col-md-12">
                <hr>
                @include('layouts.inc.tabs')
            </div>
        </div>
        <section class="py-3 mt-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <h4 class="font-weight-bold">Related Products</h4>
                        <hr>
                        <div class="row">
                            @foreach ($rel_products as $item)
                            @if ($products->category->name)

                            <div class="col-md-3">
                                <a href="{{ url('category/'.$category->slug.'/'.$item->slug) }}">
                                    <div class="card shadow-lg card1">
                                        <img src="{{ asset('uploads/products/'.$item->image) }}" class="mt-3" width="100%" height="250px" style="background-size: cover">
                                        <div class="card-body">
                                            <h4 style="height: 50px">{{ $item->name }}</h4>
                                            <h5 class="float-end text-danger "> &#8369; {{ number_format($item->price,2) }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
        @if(session('status'))
            <script>
                swal("",{
                    title: "{{ session('status') }}",
                    icon: "info",
                });
            </script>
        @endif
        @if(session('status1'))
            <script>
                swal("",{
                    title: "{{ session('status1') }}",
                    icon: "success"
                });
            </script>
        @endif
@endsection
