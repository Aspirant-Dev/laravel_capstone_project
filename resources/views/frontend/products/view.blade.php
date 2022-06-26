@extends('new-frontend.layouts.front')

@section('title',$products->name)
<head>

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/nouislider/nouislider.css') }}">
    <style>
        .btn-cart:hover{
            background-color: transparent!important;
            color: #445f84;
        }
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .rate:not(:checked) > input {
            position:absolute;
            top:-9999px;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }

    </style>
</head>
{{-- @section('meta_description', $products->meta_description) --}}
@section('content')
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
                                <a class="nav-link active" id="address-tab" data-toggle="tab" href="#new-address" role="tab" aria-controls="new-address" aria-selected="true">Write Review ({{ $products->name }})</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="tab-content-5">
                            <div class="tab-pane fade show active" id="new-address" role="tabpanel" aria-labelledby="address-tab">
                                <form class="needs-validation" novalidate action="{{ url('/add-rating') }}" method="POST" name="formRating" id="formRating" >
                                    @csrf
                                    <input type="hidden" name="prod_id" value="{{ $products->id }}">
                                    <div class="d-flex justify-content-center mb-3">
                                        <div class="rate">
                                            <input type="radio" id="star5" name="rating" value="5" />
                                            <label for="star5" title="5 stars">5 stars</label>
                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label for="star4" title="4 stars">4 stars</label>
                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label for="star3" title="3 stars">3 stars</label>
                                            <input type="radio" id="star2" name="rating" value="2" />
                                            <label for="star2" title="2 stars">2 stars</label>
                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label for="star1" title="1 star">1 star</label>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback text-start fw-bold mb-1" style="margin-top: -15px; "><strong>Add atleast one.</strong></div>

                                    <div class="form-group">
                                        <textarea required placeholder="Write your reviews here..." class="form-control" name="review" cols="30" rows="3"></textarea>
                                        <div class="invalid-feedback text-start fw-bold mt-1 mb-1" style="margin-top: -15px; "><strong>Please write your review to continue.</strong></div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-success btn-block" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .form-tab -->
                </div><!-- End .form-box -->
            </div><!-- End .modal-body -->
        </div><!-- End .modal-content -->
    </div><!-- End .modal-dialog -->
</div>
<main class="main" style="background-color: rgb(234, 243, 255)!important;">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0 bg-white" >
        <div class="container-fluid d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('view-category/'.$products->category->slug) }}">{{ $products->cate_name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $products->name }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <br>
    <div class="page-content mt-2">

        <div class="container-fluid">
            <div class="row py-3">
                <div class="col-xl-10">
                    <div class="product-details-top">
                        <div class="row">
                            <div class="col-md-6 col-lg-7 ">
                                <div class="product-gallery">
                                    <figure class="product-main-image border shadow">
                                        <img id="product-zoom1" src="{{ asset('uploads/products/'.$products->image) }}" alt="product image">

                                        {{-- <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                            <i class="icon-arrows"></i>
                                        </a> --}}
                                    </figure><!-- End .product-main-image -->

                                    <div id="product-zoom-gallery" style="display: none" class="product-image-gallery max-col-6">
                                        <a class="product-gallery-item" href="#" data-image="{{ asset('uploads/products/'.$products->image) }}" data-zoom-image="{{ asset('uploads/products/'.$products->image) }}">
                                            <img src="{{ asset('uploads/products/'.$products->image) }}" alt="{{ $products->name }}">
                                        </a>
                                    </div><!-- End .product-image-gallery -->
                                </div><!-- End .product-gallery -->
                            </div><!-- End .col-lg-7 -->

                            <div class="col-md-6 col-lg-5 product_data bg-white border shadow">
                                <div class="product-details  ml-5">
                                    <h1 class="product-title mt-3" style="font-weight: 700">{{ $products->name }}</h1><!-- End .product-title -->
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
                                            <a class="ratings-text" href="#product-accordion" id="review-link" style="color: black">( {{ count($ratings) }} {{ count($ratings) <= 1 ? 'Review':'Reviews' }} )</a>
                                        </div><!-- End .rating-container -->
                                        @else
                                            <div class="ratings-container">

                                                <div class="ratings">

                                                </div><!-- End .ratings -->
                                                <a class="ratings-text" href="#product-accordion" id="review-link" style="color: black">( No Reviews )</a>
                                            </div><!-- End .rating-container -->

                                    @endif
                                    <div class="product-price">
                                        <span class="new-price">&#8369; {{ number_format($products->price,2) }}</span>
                                    </div><!-- End .product-price -->
                                    <div class="product-content">
                                        <p>Brand: <strong>{{ $products->brand }}</strong></p>
                                    </div><!-- End .product-content -->
                                    <div class="product-content">
                                        <p>Product Type: <strong>{{ $products->product_type }}</strong></p>
                                    </div><!-- End .product-content -->
                                    <div class="product-content">
                                        <p>Product Unit: <strong>{{ $products->unit }}</strong></p>
                                    </div><!-- End .product-content -->
                                    <div class="product-content">
                                        @if ($products->stocks > 1)
                                            <p class="mb-1">Product Availability: <b style="font-style: italic; color:#e06b6b">{!! $products->stocks !!} items left</b></p>
                                        @elseif ($products->stocks == 1 )
                                            <p class="mb-1">Product Availability: <b style="font-style: italic; color:#e06b6b">{!! $products->stocks !!} item left</b></p>
                                        @else
                                            <p class="mb-1">Product Availability: <b style="font-style: italic; color:#e06b6b">Out of Stocks</b></p>
                                        @endif
                                    </div><!-- End .product-content -->

                                    <div class="details-filter-row details-row-size">
                                        <label for="qty">Qty:</label>
                                        <div class="product-details-quantity">
                                            <input type="hidden" class="cate_id" value="{{ $products->cate_id }}">
                                            <input type="hidden" class="product_id" value="{{ $products->id }}">
                                            <input type="hidden" class="prod_name" value="{{ $products->name }}">
                                            <input type="hidden" class="prod_stock" value="{{ $products->stocks }}">
                                            <input type="number" id="qty" class="form-control qty-input" value="1" min="1" max="{{ $products->stocks }}" step="1" data-decimals="0" required>
                                        </div><!-- End .product-details-quantity -->
                                    </div><!-- End .details-filter-row -->

                                    <div class="product-details-action ">
                                        @if($products->stocks > 0)
                                            @if(Auth::check())
                                                @if(!Auth::user()->email_verified_at)
                                                    <a href="javascript:void(0);" class="btn btn-primary" onclick="swal({title:'Please verify your email to continue.',icon:'info'});" title="Add to Cart"><span><i class="fas fa-cart-plus"></i> Add to Cart</span></a>
                                                @else
                                                {{-- <a href="javascript:void(0);" class="btn-product btn-cart btnCart "><span>add to cart</span></a> --}}
                                                    <a href="javascript:void(0);" class="btn btn-primary btnCart " title="Add to Cart"><span><i class="fas fa-cart-plus"></i> Add to Cart</span></a>
                                                @endif
                                            @else
                                                <a href="javascript:void(0);" onclick="notLogged();" class="btn btn-primary " title="Add to Cart"><span><i class="fas fa-cart-plus"></i> Add to Cart</span></a>
                                            @endif
                                        @endif
                                        <div class="details-action-wrapper">
                                            <a href="javascript:void(0);" class="btn btn-warning btnWishlist" title="Add to Wishlist"><span class="text-dark" style="font-weight: 500"><i class="far fa-heart"></i> Add to Wishlist</span></a>
                                        </div><!-- End .details-action-wrapper -->
                                    </div><!-- End .product-details-action -->

                                    <div class="product-details-footer">
                                        <div class="product-cat">
                                            <span>Category:</span>
                                            <a style="font-weight: 600" href="{{ url('view-category/'.$products->category->slug) }}">{{ $products->category->name }} </a>
                                        </div><!-- End .product-cat -->
                                    </div><!-- End .product-details-footer -->

                                    <div  class="accordion accordion-plus product-details-accordion" id="product-accordion">
                                        <div class="card card-box card-sm">
                                            <div class="card-header" id="product-desc-heading">
                                                <h2 class="card-title">
                                                    <a role="button" data-toggle="collapse" href="#product-accordion-desc" aria-expanded="true" aria-controls="product-accordion-desc">
                                                        Description
                                                    </a>
                                                </h2>
                                            </div><!-- End .card-header -->
                                            <div id="product-accordion-desc" class="collapse show" aria-labelledby="product-desc-heading" data-parent="#product-accordion">
                                                <div class="card-body" >
                                                    <div class="product-desc-content">
                                                        <p style="font: normal 300 1.4rem/1.86 'Poppins', sans-serif">
                                                            {!! $products->description !!}
                                                        </p>
                                                    </div><!-- End .product-desc-content -->
                                                </div><!-- End .card-body -->
                                            </div><!-- End .collapse -->
                                        </div><!-- End .card -->

                                        <div class="card card-box card-sm">
                                            <div class="card-header" id="product-review-heading">
                                                <h2 class="card-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" href="#product-accordion-review" aria-expanded="false" aria-controls="product-accordion-review">
                                                        Reviews @if($ratings->count() > 0) ({{ count($ratings) }}) @endif
                                                    </a>
                                                </h2>
                                            </div><!-- End .card-header -->
                                            <div id="product-accordion-review" class="collapse" aria-labelledby="product-review-heading" data-parent="#product-accordion">
                                                <div class="card-body">
                                                    <div class="reviews">
                                                        @if ($ratings->count() > 0)
                                                            @foreach ($ratings as $item)
                                                                <div class="review">
                                                                    <div class="row no-gutters">
                                                                        <div class=" col-lg-6">
                                                                            <h4><a href="javascript:void(0);">{{ ucfirst($item->user->fname).' '.ucfirst($item->user->lname) }}</a></h4>
                                                                            <div class="ratings-container">
                                                                                <div class="rating">
                                                                                    <?php
                                                                                        $count = 1;
                                                                                        while ($count <= $item['rating']) { ?>
                                                                                        <span style="font-size: 25px; color:#f3a513;">&#9733;</span>
                                                                                        <?php $count++;}
                                                                                        ?>
                                                                                    {{-- <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val --> --}}
                                                                                </div><!-- End .ratings -->
                                                                            </div><!-- End .rating-container -->
                                                                            @if($item->created_at == $item->updated_at)
                                                                                <span class="review-date">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans()}} </span>
                                                                            @else
                                                                                <span class="review-date">Updated: {{ Carbon\Carbon::parse($item->updated_at)->diffForHumans()}} </span>
                                                                            @endif
                                                                        </div><!-- End .col -->
                                                                        <div class="col">
                                                                            {{-- <h4>Good, perfect size</h4> --}}
                                                                            <div class="review-content">
                                                                                <p>
                                                                                    {{ $item->review }}
                                                                                </p>
                                                                            </div><!-- End .review-content -->
                                                                        </div><!-- End .col-auto -->
                                                                    </div><!-- End .row -->
                                                                </div><!-- End .review -->
                                                            @endforeach
                                                        @else
                                                            <h4 class="text-center">No reviews for this product.</h4>
                                                        @endif
                                                        @if(Auth::check())
                                                            @if(Auth::user()->email_verified_at)
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <h3 class="text-center"><a  href="#exampleModal" class="btn btn-primary btn-block" data-toggle="modal">Write a Review</a></h3>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <h3 class="text-center"><a class="btn btn-primary btn-block" href="javascript:void(0);" onclick="showMsg();">Write a Review</a></h3>
                                                                    </div>
                                                                </div>

                                                            @endif
                                                        @endif
                                                    </div><!-- End .reviews -->
                                                </div><!-- End .card-body -->

                                            </div><!-- End .collapse -->
                                        </div><!-- End .card -->
                                    </div><!-- End .accordion -->
                                </div><!-- End .product-details -->
                            </div><!-- End .col-lg-5 -->
                        </div><!-- End .row -->
                    </div><!-- End .product-details-top -->
                </div><!-- End .col-xl-10 -->

                <aside class="col-xl-2 d-md-none d-xl-block "style="margin-top: 3px !important;" >
                    <div class="sidebar sidebar-product bg-white border shadow">
                        <div class="widget widget-products p-2">
                            <h4 class="widget-title  text-center mt-2">Related Product</h4><!-- End .widget-title -->

                            <div class="products">

                                @if($rel_products->count() > 1)
                                    @foreach ($rel_products as $item)
                                        {{-- @if ($products->category->name) --}}
                                        @if ($item != Request::is('category/'.$item->category->slug.'/'.$item->slug))
                                            <div class="product product-sm ">
                                                <figure class="product-media">
                                                    <a href="{{ url('category/'.$category->slug.'/'.$item->slug) }}">
                                                        <img src="{{ asset('uploads/products/'.$item->image) }}" alt="Product image" class="product-image" width="100%" height="5%" style="background-size: cover!important;  height: 80px;">
                                                    </a>
                                                </figure>

                                                <div class="product-body">
                                                    <h5 class="product-title"><a href="{{ url('category/'.$category->slug.'/'.$item->slug) }}">{{ $item->name }}</a></h5><!-- End .product-title -->
                                                    <div class="product-price">
                                                        <span class="new-price">&#8369; {{ number_format($item->price,2) }}</span>
                                                    </div><!-- End .product-price -->
                                                </div><!-- End .product-body -->
                                            </div><!-- End .product product-sm -->
                                        @endif
                                    @endforeach
                                @else
                                    <div class="product-body">
                                        <h5 class="product-title">No products related to {{ $products->name }}</h5><!-- End .product-title -->
                                    </div><!-- End .product-body -->
                                @endif
                            </div><!-- End .products -->

                            <a href="{{ url('/shop') }}" class="btn btn-success"><span>View More Products</span><i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .widget widget-products -->
                    </div><!-- End .sidebar sidebar-product -->
                </aside><!-- End .col-xl-2 -->
            </div><!-- End .row -->
        </div><!-- End .container-fluid -->
    </div><!-- End .page-content -->
</main><!-- End .main -->


<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
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
<script>
    function notLogged()
    {
        swal({
            title: 'Login to continue.',
            icon: 'info',
        })
    }
</script>
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
@if(session('failed'))
    <script>
        swal("",{
            title: "{{ session('failed') }}",
            icon: "info"
        });
    </script>
@endif
<script>
    function showMsg(){
        swal("",{
        title: "Please verify your email to continue.",
        icon: "info"
    });
    }
</script>
@endsection
