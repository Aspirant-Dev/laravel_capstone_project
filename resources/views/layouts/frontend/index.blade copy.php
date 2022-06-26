@extends('new-frontend.layouts.front')

@section('title')
    Real Value Enterprise
@endsection
<head>
    <style>
        img {
            max-width: 100%;
            height: auto;
        }

        .item {
            width: 120px;
            min-height: 120px;
            max-height: auto;
            float: left;
            margin: 3px;
            padding: 3px;
        }

        .overlay::after {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%; /* set to 100% for full overlay width */
        background: rgba(0, 0, 0, 0.350);
        }
        .ban-cat:hover
        {
            box-shadow: 0px 3px 15px rgba(0,0,0,0.2);
            transition: .3s;
        }
    </style>
</head>

@section('content')
    <!-- Page Content-->
    {{-- <main class="main"> --}}
        @php
            $banners = App\Banner::where('status',1)->get();
        @endphp

        <div class="container" >
            <div class="intro-slider-container slider-container-ratio ">
                <div class="intro-slider owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl" data-owl-options='{"nav": false,"loop": false}'>
                    @foreach ($banners as $item)

                    <div class="intro-slide">
                        <figure class="slide-image">
                            <picture class="overlay">
                                <source media="(max-width: 480px)" srcset="{{ asset('uploads/banners/w480/'.$item->image_w480) }}" style=" height: 400px !important; width: 100%">
                                <img src="{{ asset('uploads/banners/'.$item->image) }}" alt="Image Desc" style="background-size: cover !important; height: 500px; width: 100%" >
                            </picture>
                        </figure><!-- End .slide-image -->

                        <div class="intro-content">
                            <h1 class="intro-title text-white">{!! $item->title !!}</h1><!-- End .intro-title -->
                            <h3 class="intro-subtitle">{!! $item->subtitle !!}</h3><!-- End .h3 intro-subtitle -->

                            {{-- <div class="intro-price text-white">from &#8369; {{ number_format(10,2) }}</div><!-- End .intro-price --> --}}
                            <div class="intro-price text-white"></div><!-- End .intro-price -->

                            <a href="{{ route('frontend.shop') }}" class="btn btn-white-primary btn-round">
                                <span>Shop Now!</span>
                                <i class="icon-long-arrow-right"></i>
                            </a>
                        </div><!-- End .intro-content -->
                    </div><!-- End .intro-slide -->
                    @endforeach
                </div><!-- End .intro-slider owl-carousel owl-simple -->
                <span class="slider-loader"></span><!-- End .slider-loader -->
            </div><!-- End .intro-slider-container -->
        </div><!-- End .container -->

        <div class="icon-boxes-container icon-boxes-separator bg-transparent">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                            <span class="icon-box-icon text-primary">
                                <i class="icon-rocket"></i>
                            </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Free Shipping</h3><!-- End .icon-box-title -->
                                {{-- <p>Orders $50 or more</p> --}}
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                            <span class="icon-box-icon text-primary">
                                <i class="icon-rotate-left"></i>
                            </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Return Products</h3><!-- End .icon-box-title -->
                                <p>Within 3 days</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                            <span class="icon-box-icon text-primary">
                                <i class="icon-info-circle"></i>
                            </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Safe Payment</h3><!-- End .icon-box-title -->
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                            <span class="icon-box-icon text-primary">
                                <i class="icon-life-ring"></i>
                            </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Easy Shop</h3><!-- End .icon-box-title -->
                                {{-- <p>24/7 amazing services</p> --}}
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .icon-boxes-container -->

        <div class="bg-light pt-5 pb-10 " style="background-color: #d1dfff!important;">
            <div class="container">
                <div class="heading heading-center mb-3">
                    <h2 class="title-lg">New Arrivals</h2><!-- End .title -->
                </div><!-- End .heading -->
                <div class="tab-content tab-content-carousel">
                    <div class="tab-pane tab-pane-shadow p-0 fade show active" id="new-all-tab" role="tabpanel" aria-labelledby="new-all-link">
                        <div class="owl-carousel owl-simple carousel-equal-height" data-toggle="owl"
                            data-owl-options='{
                                "nav": false,
                                "dots": true,
                                "margin": 0,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":1
                                    },
                                    "480": {
                                        "items":1
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1200": {
                                        "items":4,
                                        "nav": true
                                    }
                                }
                            }'>
                            @foreach ($new_arrival as $item)
                                <div class="product product-3 text-center product_data border m-2">
                                    <figure class="product-media">
                                        @if($item->trending)
                                                <span class="product-label label-primary">Featured</span>
                                            @endif
                                        <a href="">
                                            <img src="{{ asset('uploads/products/'.$item->image) }}" alt="Product image" class="product-image" width="100%" height="10px;" style="background-size: cover!important; height: 300px;">
                                        </a>

                                        <div class="product-action-vertical">
                                            <a style="cursor: pointer;" class="btn-product-icon btn-wishlist btn-expandable btnWishlist"><span>add to wishlist</span></a>
                                        </div><!-- End .product-action-vertical -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body ">
                                        <div class="product-cat">
                                            <a style="color: rgb(110, 110, 110)" href="{{ url('view-category/'.$item->category->slug) }}">{{ $item->category->name }}</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title" ><a style="font-weight: bold" href="{{ url('category/'.$item->category->slug.'/'.$item->slug) }}">{{ $item->name }}</a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            <input type="hidden" class="product_id" value="{{ $item->id }}">

                                            <input type="hidden" class="cate_id" value="{{ $item->category->id }}">
                                            <input type="hidden" class="prod_name" value="{{ $item->name }}">
                                            <input type="hidden" class="prod_stock" value="{{ $item->stocks }}">
                                            <input type="hidden" class="invisible qty-input" value="1" min="1" max="{{ $item->stocks }}" >
                                            <span class="new-price">&#8369; {{ number_format($item->price,2) }}</span>
                                        </div><!-- End .product-price -->
                                    </div><!-- End .product-body -->
                                    @php
                                        $ratings = App\Rating::latest()->where('status',1)->where('product_id',$item->id)->get();
                                        // Get the average rating of product
                                        $ratingSum = App\Rating::where('status',1)->where('product_id',$item->id)->sum('rating');
                                            $ratingCount = App\Rating::where('status',1)->where('product_id',$item->id)->count();
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
                                    <div class="product-footer">
                                        @if($avgStarRating > 0)
                                        <div class="ratings-container">

                                            <div class="rating" style="display: inline-block; font-size: 1.4rem; letter-spacing: 0.1em; line-height: 1;">
                                                <?php
                                                    $star = 1;
                                                    while ($star <= $avgStarRating) { ?>
                                                    <span style="color:#f3a513;">&#9733;</span>
                                                    <?php $star++;} ?> ({{ $avgRating }})
                                                {{-- <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val --> --}}
                                            </div><!-- End .ratings -->
                                            <a class="ratings-text" style="color: black">( {{ count($ratings) }} {{ count($ratings) <= 1 ? 'Review':'Reviews' }} )</a>
                                        </div><!-- End .rating-container -->
                                        @else
                                            <div class="ratings-container">

                                                <div class="ratings">

                                                </div><!-- End .ratings -->
                                                <a class="ratings-text" href="#product-accordion" id="review-link" style="color: black">( No Reviews )</a>
                                            </div><!-- End .rating-container -->

                                    @endif
                                        <div class="product-action">
                                            <a href="#" class="btn-product btn-cart btnCart"><span>add to cart</span></a>
                                            <a href="{{ url('category/'.$item->category->slug.'/'.$item->slug) }}" class="btn-product"><span><i class="las la-eye"></i> View</span></a>
                                        </div><!-- End .product-action -->
                                    </div><!-- End .product-footer -->
                                </div><!-- End .product -->
                            @endforeach
                        </div><!-- End .owl-carousel -->
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .container -->
        </div><!-- End .bg-light -->

        @php
            use App\Category;
            $category = Category::where('status',1)->orderBy('name','ASC')->get();
        @endphp
        <div class="bg-light pt-5 pb-10" style="margin-top: -80px">
            <div class="container">
                <h2 class="title-lg"><center>Shop by Category</center></h2><!-- End .title -->
                <div class="row justify-content-center">

                    @foreach ($category as $item)
                        <div class="col-sm-6 col-md-4 ">
                            <div class="banner banner-cat ban-cat" style="border: 1px solid rgba(187, 187, 187, 0.658) !important" height="10px;">
                                <a style="cursor: pointer">
                                    <img src="{{ asset('uploads/categories/'.$item->image) }}" width="100%" height="5%" style="background-size: cover!important;  height: 300px;" alt="Banner">
                                </a>

                                <div class="banner-content banner-content-overlay text-center">

                                    @php
                                        $productsCount = App\Product::productsCount($item['id']);
                                    @endphp
                                    <h3 class="banner-title font-weight-normal">{{ $item->name }} </h3><!-- End .banner-title -->
                                    <h4 class="banner-subtitle">{{ $productsCount }} @if($productsCount > 1) Products @else Product @endif</h4><!-- End .banner-subtitle -->
                                    <a href="{{ url('view-category/'.$item->slug) }}" class="banner-link">SHOP NOW</a>
                                </div><!-- End .banner-content -->
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-4 -->
                    @endforeach
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div>

        {{-- <div class="mb-4"></div><!-- End .mb-4 --> --}}

        <div class="bg-light pt-5 pb-10" style="margin-top: -80px">
            <div class="container">
                <div class="heading heading-center ">
                    <h2 class="title-lg mb-2">All Products</h2><!-- End .title-lg text-center -->
                </div><!-- End .heading -->

                <div class="tab-content">
                    <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
                        <div class="products just-action-icons-sm">
                            <div class="row">
                                @foreach ($all_prods as $item)
                                <div class="col-6 col-md-4 col-lg-3 col-xl-5col border">
                                    <div class="product product-3 text-center product_data">
                                        <figure class="product-media mt-1">
                                            @if($item->trending)
                                                <span class="product-label label-primary">Featured</span>
                                            @endif
                                            @if($item->stocks < 1)
                                                <span class="product-label label-sale" style="background-color: #c33d33">Out of Stock</span>
                                            @endif
                                            <a href="product.html">
                                                <img src="{{ asset('uploads/products/'.$item->image) }}" alt="Product image" class="product-image" width="100%" height="5%" style="background-size: cover!important;  height: 250px;">
                                            </a>

                                            <div class="product-action-vertical">
                                                <a href="#" class="btn-product-icon btn-wishlist btn-expandable btnWishlist"><span>add to wishlist</span></a>
                                            </div><!-- End .product-action-vertical -->
                                        </figure><!-- End .product-media -->

                                        <div class="product-body ">
                                            <div class="product-cat">
                                                <a href="{{ url('view-category/'.$item->category->slug) }}">{{ $item->cate_name }}</a>
                                            </div><!-- End .product-cat -->
                                            <h3 class="product-title"><a href="{{ url('category/'.$item->category->slug.'/'.$item->slug) }}">{{ $item->name }}</a></h3><!-- End .product-title -->
                                            <div class="product-price">
                                                <span class="new-price">&#8369; {{ number_format($item->price,2) }}</span>
                                            </div><!-- End .product-price -->
                                        </div><!-- End .product-body -->
                                        @php
                                            $ratings = App\Rating::latest()->where('status',1)->where('product_id',$item->id)->get();
                                            // Get the average rating of product
                                            $ratingSum = App\Rating::where('status',1)->where('product_id',$item->id)->sum('rating');
                                                $ratingCount = App\Rating::where('status',1)->where('product_id',$item->id)->count();
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
                                    <div class="product-footer">
                                        @if($avgStarRating > 0)
                                            <div class="ratings-container">
                                                <div class="rating" style="display: inline-block; font-size: 1.4rem; letter-spacing: 0.1em; line-height: 1;">
                                                    <?php
                                                        $star = 1;
                                                        while ($star <= $avgStarRating) { ?>
                                                        <span style="color:#f3a513;">&#9733;</span>
                                                        <?php $star++;} ?> ({{ $avgRating }})
                                                    {{-- <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val --> --}}
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
                                            <div class="product-action ">

                                                <input type="hidden" class="cate_id" value="{{ $item->cate_id }}">
                                                <input type="hidden" class="product_id" value="{{ $item->id }}">
                                                <input type="hidden" class="prod_name" value="{{ $item->name }}">
                                                <input type="hidden" class="prod_stock" value="{{ $item->stocks }}">
                                                <input type="hidden" type="number" class="invisible qty-input" value="1"  max="{{ $item->stocks }}" >
                                                <a href="#" class="btn-product btn-cart btnCart" title="Add to cart"></a>
                                                <a href="{{ url('category/'.$item->category->slug.'/'.$item->slug) }}" title="View" class="btn-product"><i class="las la-eye"></i></a>
                                            </div><!-- End .product-action -->
                                        </div><!-- End .product-footer -->
                                    </div><!-- End .product -->
                                </div><!-- End .col-6 col-md-4 col-lg-3 -->
                                @endforeach
                            </div><!-- End .row -->
                        </div><!-- End .products -->
                    </div><!-- .End .tab-pane -->

                </div><!-- End .tab-content -->

                <div class="more-container text-center mt-3" style="margin-bottom: -50px;">
                    <a href="{{ route('frontend.shop') }}" class="btn btn-primary btn-more btn-round" style="border: 1px solid rgba(2, 2, 165, 0.692);"><span>View more products</span><i class="icon-long-arrow-right"></i></a>
                </div><!-- End .more-container -->
            </div><!-- End .container -->
        </div>
    {{-- </main><!-- End .main --> --}}

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    {{-- Show message after purchasing orders --}}
    @if(session('status'))
        <script>
            swal({
                title: "{{ session('status') }}",
                text: 'Thank you for purchasing! We will process your order as soon as possible.',
                icon: 'success',
                closeOnClickOutside: false,
            });
        </script>
    @endif
    @if(session('status1'))
        <script>
            swal({
                title: "{{ session('status1') }}",
                text: 'Thank you for purchasing! Your order is in processing status.',
                icon: 'success',
                closeOnClickOutside: false,
            });
        </script>
    @endif
    @if(session('not-found'))
    <script>
        swal("",{
            title: "{{ session('not-found') }}",
            icon: "error"
        });
    </script>
    @endif
    {{-- Show message after successfully login --}}
    @if(session('success'))
        <script>
            swal({
                title: "{{ session('success') }}",
                text: " ",
                icon: 'success',
                buttons: false,
                timer: 2000,
                closeOnClickOutside: false,
            });
        </script>
    @endif
@endsection
