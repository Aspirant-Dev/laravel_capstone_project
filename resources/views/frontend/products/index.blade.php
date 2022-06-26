@extends('new-frontend.layouts.front')

@section('title')
    {{ $category->name }}
@endsection

@section('content')
{{-- <main class="main" style="background-color: #d1dfff!important;"> --}}
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0 bg-white">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/categories') }}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    @if ($products->count() > 0 )
        <div class="container-fluid">
            <h2 class="title text-center mt-2" style="font-weight: 700;">{{ $category->name }}</h2><!-- End .title -->
            <h6 class=" text-center mb-3">{!! $category->description !!}</h6><!-- End .title -->
            <div class="row">
                @foreach ($products as $prod)
                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                    <div class="product product-5 text-center product_data">
                        <figure class="product-media">
                            @if($prod->trending)
                                <span class="product-label label-primary">Featured</span>
                            @endif
                            @if($prod->stocks < 1)
                                <span class="product-label label-sale" style="background-color: #c33d33">Out of Stock</span>
                            @endif
                            <a href="#">
                                <img src="{{ asset('uploads/products/'.$prod->image) }}" alt="Product image" class="product-image" style="background-size: cover!important; height: 250px; width: 100%;">
                            </a>

                            <input type="hidden" class="cate_id" value="{{ $prod->cate_id }}">
                                <input type="hidden" class="product_id" value="{{ $prod->id }}">
                                <input type="hidden" class="prod_name" value="{{ $prod->name }}">
                                <input type="hidden" class="prod_stock" value="{{ $prod->stocks }}">
                                <input type="hidden" type="number" class="invisible qty-input" value="1"  max="{{ $prod->stocks }}" >

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist btn-expandable btnWishlist"><span>Add to Wishlist</span></a>

                                <a href="{{ url('category/'.$prod->category->slug.'/'.$prod->slug) }}" title="View {{ $prod->name }}" class="btn-product-icon"><i class="las la-eye"></i></a>
                                {{-- <a href="#" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a> --}}
                            </div><!-- End .product-action-vertical -->

                            <div class="product-action ">
                                @if($prod->stocks > 0)
                                    @if(Auth::check())
                                        @if(!Auth::user()->email_verified_at)
                                            <a href="javascript:void(0);" class="btn-product btn-cart" onclick="swal({title:'Please verify your email to continue.',icon:'info'});" title="Add to Cart"><span>Add to Cart</span></a>
                                        @else
                                            <a href="#" class="btn-product btn-cart btnCart"  title="Add to Cart"><span>Add to Cart</span></a>
                                        @endif
                                    @else
                                        <a href="javascript:void(0);" class="btn-product btn-cart" onclick="swal({title:'Login to continue.',icon:'info'});" title="Add to Cart"><span>Add to Cart</span></a>
                                    @endif
                                @else
                                    <a href="javascript:void(0);" class="btn-product btn-cart" onclick="swal({title:'Out of Stock.',icon:'error'});" title="Add to Cart"><span>Add to Cart</span></a>
                                @endif
                            </div><!-- End .product-action -->
                        </figure><!-- End .product-media -->

                        <div class="product-body" >
                            <h3 class="product-title" style="height: 50px;"><a href="{{ url('category/'.$prod->category->slug.'/'.$prod->slug) }}">{{ $prod->name }}</a></h3><!-- End .product-title -->
                            <div class="product-price">
                                <span class="new-price">&#8369; {{ number_format($prod->price,2) }}</span>
                            </div><!-- End .product-price -->
                        @php
                            $ratings = App\Rating::latest()->where('status',1)->where('product_id',$prod->id)->get();
                            // Get the average rating of product
                            $ratingSum = App\Rating::where('status',1)->where('product_id',$prod->id)->sum('rating');
                                $ratingCount = App\Rating::where('status',1)->where('product_id',$prod->id)->count();
                                if($ratingCount > 0)
                                {
                                    $avgRating = round($ratingSum/$ratingCount,2);
                                    $avgStarRating = round($ratingSum/$ratingCount);
                                }
                                else
                                {
                                    $avgRating = 0;
                                    $avgStarRating = 0;
                                }
                        @endphp
                        @if($avgStarRating > 0)
                            <div class="ratings-container">
                                <div class="rating" style="display: inline-block; font-size: 1.4rem; letter-spacing: 0.1em; line-height: 1;">
                                    <?php
                                        $star = 1;
                                        while ($star <= $avgStarRating) { ?>
                                        <span style="color:#f3a513;">&#9733;</span>
                                        <?php $star++;} ?> ({{ $avgRating }})
                                </div><!-- End .ratings -->
                                <a class="ratings-text" style="color: black">( {{ count($ratings) }} {{ count($ratings) <= 1 ? 'Review':'Reviews' }} )</a>
                            </div><!-- End .rating-container -->
                        @else
                            <div class="ratings-container">
                                <div class="ratings">
                                </div><!-- End .ratings -->
                                <a class="ratings-text" style="color: black">( No Reviews )</a>
                            </div><!-- End .rating-container -->
                        @endif
                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                </div><!-- End .col-sm-6 col-md-4 col-lg-3 col-xl-2 -->
                @endforeach
            </div><!-- End .row -->
        </div><!-- End .container-fluid -->
    @else
        <section class="py-5 bg-light">
            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center p-5">No products available</h3>
                    </div>
                </div>
            </div>
        </section>
    @endif
{{-- </main> --}}


<!-- JQuery CDN-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

@endsection
