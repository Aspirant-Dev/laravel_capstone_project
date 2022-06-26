@extends('new-frontend.layouts.front')

@section('title','Shop')
{{-- <head>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
</head> --}}
@section('content')
<main class="main " style="background-color: rgb(234, 243, 255)!important;">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2 bg-white border-bottom">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shop</li>
            </ol>
        </div><!-- End .container-fluid -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    <div class="toolbox">
                        <div class="toolbox-right">
                            <div class="toolbox-info text-dark">
                                Showing <span class="font-weight-bold">{{ $products->count() }}</span> Products
                            </div>
                            <!-- End .toolbox-info -->
                        </div>
                        <!-- End .toolbox-left -->

                        {{-- <div class="toolbox-right">
                            <div class="toolbox-sort">
                                <div class="header-right">
                                    <div class="header-dropdown">
                                        <a style="cursor: pointer"><strong>Sort by:</strong></a>
                                        <div class="header-menu bg-light border">
                                            <ul>
                                                <li><a href="{{ URL::current() }}">All</a></li>
                                                <li><a href="{{ URL::current()."?sort=price_asc" }}">Price - Low to High</a></li>
                                                <li><a href="{{ URL::current()."?sort=price_desc" }}">Price - High to Low</a></li>
                                                <li><a href="{{ URL::current()."?sort=newest" }}">Newest</a></li>
                                                <li><a href="{{ URL::current()."?sort=featured" }}">Featured</a></li>
                                            </ul>
                                        </div>
                                        <!-- End .header-menu -->
                                    </div>
                                </div>
                            </div>
                            <!-- End .toolbox-sort -->
                        </div> --}}
                        <!-- End .toolbox-right -->
                    </div>
                <!-- End .toolbox -->

                    <div class="products mb-3">
                        <div class="row ">
                            @foreach ($products as $item)
                            <div class="col-6 col-md-3 col-lg-6 col-xl-3 product_data  ">
                                    <input type="hidden" class="product_id" value="{{ $item->id }}">
                                    <input type="hidden" class="cate_id" value="{{ $item->cate_id }}">
                                    <input type="hidden" class="prod_name" value="{{ $item->name }}">
                                    <input type="hidden" class="prod_stock" value="{{ $item->stocks }}">
                                    <input type="hidden" type="number" class="invisible qty-input" value="1"  max="{{ $item->stocks }}" >
                                    <div class="product product-7 text-center m-2 border">
                                        <figure class="product-media">
                                            @if($item->trending )
                                                <span class="product-label label-new bg-info">Featured</span>
                                            @endif
                                            @if($item->stocks < 1 )
                                                <span class="product-label label-sale" style="background-color: #c33d33">Out of Stocks</span>
                                            @endif
                                            <a style="cursor: pointer;">
                                                <img src="{{ asset('uploads/products/'.$item->image) }}" alt="Product image" class="product-image" style="background-size: cover!important;  height: 250px; width: 100%">
                                            </a>

                                            <div class="product-action-vertical">
                                                <a class="btn-product-icon btn-wishlist btn-expandable bg-primary text-white btnWishlist" style="border: 1px solid #445f84 !important;"><span>add to wishlist</span></a>
                                                <a  href="{{ url('category/'.$item->category->slug.'/'.$item->slug) }}" title="View {{ $item->name }}" style="border: 1px solid #445f84 !important;" class=" bg-primary text-white btn-product-icon btn-expandable"><i class="las la-eye"></i><span>view product</span></a>
                                            </div>
                                            <!-- End .product-action-vertical -->

                                            <div class="product-action">

                                                @if($item->stocks > 0)
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
                                                {{-- <a href="#" class="btn-product btn-cart btnCart"><span>add to cart</span></a> --}}
                                            </div>
                                            <!-- End .product-action -->
                                        </figure>
                                        <!-- End .product-media -->

                                        <div class="product-body">
                                            <div class="product-cat">
                                                <a style="color: rgb(110, 110, 110)" href="{{ url('view-category/'.$item->category->slug) }}">{{ $item->category->name }}</a>
                                            </div>
                                            <!-- End .product-cat -->
                                            <h3 class="product-title"><a style="font-weight: bold" href="{{ url('category/'.$item->category->slug.'/'.$item->slug) }}">{{ $item->name }}</a></h3>
                                            <!-- End .product-title -->
                                            <div class="product-price" style="color: #ef837b;">
                                                &#8369; {{ number_format($item->price,2) }}
                                            </div>
                                            <!-- End .product-price -->
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
                                            @if($avgStarRating > 0)
                                                <div class="ratings-container">
                                                    <div class="rating" style="display: inline-block; font-size: 1.4rem; letter-spacing: 0.1em; line-height: 1;">
                                                        <?php
                                                            $star = 1;
                                                            while ($star <= $avgStarRating) { ?>
                                                            <span style="color:#f3a513;">&#9733;</span>
                                                            <?php $star++;} ?>
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
                                            <!-- End .rating-container -->
                                        </div>
                                        <!-- End .product-body -->
                                    </div>
                                    <!-- End .product -->
                                </div>
                            @endforeach
                            <!-- End .col-sm-6 col-lg-4 col-xl-3 -->

                        </div>
                        <!-- End .row -->
                    </div>

                    <!-- End .products -->
                </div>
                <!-- End .col-lg-9 -->
                <aside class="col-lg-3 order-lg-first mt-1 ">
                    <div class="sidebar sidebar-shop bg-white p-5 border">
                        <div class="widget widget-clean">
                            <label>Filters:</label>
                            <a href="#" class="sidebar-filter-clear">Clean All</a>
                        </div>
                        <!-- End .widget widget-clean -->

                        <form action="{{ URL::current() }}" method="GET">
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                        Category
                                    </a>
                                </h3>
                                <!-- End .widget-title -->

                                <div class="collapse show" id="widget-1">
                                    <div class="widget-body">
                                        <div class="filter-items filter-items-count">
                                            @php
                                                $categories = App\Category::orderBy('name','ASC')->get();
                                                $brands = App\Product::orderBy('brand','ASC')->get();

                                            @endphp
                                            @foreach ($categories as $item)
                                            @php
                                                $productsCount = App\Product::productsCount($item['id']);
                                            @endphp
                                            @php
                                                $checked = [];
                                                if(isset($_GET['filterprods']))
                                                {
                                                    $checked = $_GET['filterprods'];
                                                }
                                            @endphp
                                                <div class="filter-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="filterprods[]"  @if(in_array($item->name, $checked)) checked @endif value="{{ $item->name }}" class="checks custom-control-input" id="cat-{{ $item->id }}">
                                                        <label class="custom-control-label"  for="cat-{{ $item->id }}">{{ $item->name }}</label>
                                                    </div>
                                                    <!-- End .custom-checkbox -->
                                                    <span class="item-count" style="font-weight: 500;">{{ $productsCount }}</span>
                                                </div>
                                            @endforeach
                                            <!-- End .filter-item -->
                                        </div>
                                        <!-- End .filter-items -->
                                    </div>
                                    <!-- End .widget-body -->
                                </div>
                                <!-- End .collapse -->
                            </div>
                            <!-- End .widget -->
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                                        Brand
                                    </a>
                                </h3>
                                <!-- End .widget-title -->

                                <div class="collapse show" id="widget-4">
                                    <div class="widget-body">
                                        <div class="filter-items">
                                            @foreach ($brands->unique('brand') as $item)
                                            @php
                                                $checked = [];
                                                if(isset($_GET['filterprods']))
                                                {
                                                    $checked = $_GET['filterprods'];
                                                }
                                            @endphp
                                                <div class="filter-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="filterprods[]" @if(in_array($item->brand, $checked)) checked @endif value="{{ $item->brand }}" class="custom-control-input checks" id="brand-{{ $item->id }}">
                                                        <label class="custom-control-label " for="brand-{{ $item->id }}">{{ $item->brand }}</label>
                                                    </div>
                                                    <!-- End .custom-checkbox -->
                                                </div>
                                                <!-- End .filter-item -->
                                            @endforeach


                                        </div>
                                        <!-- End .filter-items -->
                                    </div>
                                    <!-- End .widget-body -->
                                </div>
                                <!-- End .collapse -->
                            </div>
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                                        Sort By
                                    </a>
                                </h3>
                                <!-- End .widget-title -->


                                <div class="collapse show" id="widget-4">
                                    <div class="widget-body">
                                        <div class="filter-items">
                                            @foreach ($a as $item)
                                            @php
                                                $checkedP = [];
                                                if(isset($_GET['filterprods']))
                                                {
                                                    $checkedP = $_GET['filterprodsP'];
                                                }
                                            @endphp
                                                <div class="filter-item">
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" name="filterprodsP[]" required value="{{ $item['val'] }}" @if(in_array($item['val'], $checkedP)) checked @endif id="flexRadioDefault{{ $item['name'] }}">
                                                        <label class="custom-control-label" for="flexRadioDefault{{ $item['name'] }}">
                                                             {{ $item['name'] }}
                                                        </label>
                                                      </div>
                                                    <!-- End .custom-checkbox -->
                                                </div>
                                                <!-- End .filter-item -->
                                            @endforeach
                                        </div>
                                        <!-- End .filter-items -->
                                    </div>
                                    <!-- End .widget-body -->
                                </div>
                                <!-- End .collapse -->
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-12 col-xl-12 col-lg-12">
                                    <center>
                                        <div class="w-100">
                                            <button id="submit" name="submit" disabled="disabled"type="submit"  class="btn btn-block btn-primary"><i class="icon-list-alt"></i> Apply Filter</button>
                                        </div><!-- End .btn-wrap -->
                                    </center>
                                </div><!-- End .col-md-4 col-lg-2 -->
                            </div>
                            <!-- End .widget -->
                        </form>
                    </div>
                    <!-- End .sidebar sidebar-shop -->
                </aside>
                <!-- End .col-lg-3 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </div>
</main>


<!-- JQuery CDN-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('frontend/assets/js/nouislider.min.js') }}"></script>

<script src="{{ asset('frontend/assets/js/wNumb.js') }}"></script>
<script>
    $('#submit').prop("disabled", true);

    $('input:checkbox').click(function() {
    if ($(this).is(':checked'))
    {
        $('#submit').prop("disabled", false);
    }
    else
    {
        if ($('.checks').filter(':checked').length < 1)
        {
            $('#submit').attr('disabled',true);}
        }
    });
</script>
@endsection

