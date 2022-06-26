@extends('new-frontend.layouts.front')

@section('title')
    All Categories
@endsection

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav breadcrumb-with-filter">
            <div class="container-fluid">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Categories</li>
                </ol>
            </div><!-- End .container-fluid -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="categories-page">
                <div class="container-fluid">
                    @foreach ($categories as $item)
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="banner banner-cat banner-badge">
                                            <a href="#">
                                                <img src="{{ asset('uploads/categories/'.$item->image) }}" alt="Banner">
                                            </a>

                                            <a class="banner-link" href="{{  }}">
                                                <h3 class="banner-title">Jackets</h3><!-- End .banner-title -->
                                                <h4 class="banner-subtitle">2 Products</h4><!-- End .banner-subtitle -->
                                                <span class="banner-link-text">Shop Now</span>
                                            </a><!-- End .banner-link -->
                                        </div><!-- End .banner -->
                                    </div><!-- End .col-sm-8 -->

                                    <div class="col-sm-4">
                                        <div class="banner banner-cat banner-badge">
                                            <a href="#">
                                                <img src="assets/images/category/fullwidth-page/banner-2.jpg" alt="Banner">
                                            </a>

                                            <a class="banner-link" href="#">
                                                <h3 class="banner-title">Jeans</h3><!-- End .banner-title -->
                                                <h4 class="banner-subtitle">1 Product</h4><!-- End .banner-subtitle -->
                                                <span class="banner-link-text">Shop Now</span>
                                            </a><!-- End .banner-link -->
                                        </div><!-- End .banner -->
                                    </div><!-- End .col-sm-4 -->

                                    <div class="col-sm-4">
                                        <div class="banner banner-cat banner-badge">
                                            <a href="#">
                                                <img src="assets/images/category/fullwidth-page/banner-3.jpg" alt="Banner">
                                            </a>

                                            <a class="banner-link" href="#">
                                                <h3 class="banner-title">Sportwear</h3><!-- End .banner-title -->
                                                <h4 class="banner-subtitle">0 Product</h4><!-- End .banner-subtitle -->
                                                <span class="banner-link-text">Shop Now</span>
                                            </a><!-- End .banner-link -->
                                        </div><!-- End .banner -->
                                    </div><!-- End .col-sm-4 -->

                                    <div class="col-sm-8">
                                        <div class="banner banner-cat banner-badge">
                                            <a href="#">
                                                <img src="assets/images/category/fullwidth-page/banner-4.jpg" alt="Banner">
                                            </a>

                                            <a class="banner-link" href="#">
                                                <h3 class="banner-title">Bags</h3><!-- End .banner-title -->
                                                <h4 class="banner-subtitle">4 Products</h4><!-- End .banner-subtitle -->
                                                <span class="banner-link-text">Shop Now</span>
                                            </a><!-- End .banner-link -->
                                        </div><!-- End .banner -->
                                    </div><!-- End .col-sm-8 -->
                                </div><!-- End .row -->
                            </div><!-- End .col-lg-6 -->

                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="banner banner-cat banner-badge">
                                            <a href="#">
                                                <img src="assets/images/category/fullwidth-page/banner-5.jpg" alt="Banner">
                                            </a>

                                            <a class="banner-link" href="#">
                                                <h3 class="banner-title">Dresses</h3><!-- End .banner-title -->
                                                <h4 class="banner-subtitle">3 Products</h4><!-- End .banner-subtitle -->
                                                <span class="banner-link-text">Shop Now</span>
                                            </a><!-- End .banner-link -->
                                        </div><!-- End .banner -->

                                        <div class="banner banner-cat banner-badge">
                                            <a href="#">
                                                <img src="assets/images/category/fullwidth-page/banner-6.jpg" alt="Banner">
                                            </a>

                                            <a class="banner-link" href="#">
                                                <h3 class="banner-title">Shoes</h3><!-- End .banner-title -->
                                                <h4 class="banner-subtitle">2 Products</h4><!-- End .banner-subtitle -->
                                                <span class="banner-link-text">Shop Now</span>
                                            </a><!-- End .banner-link -->
                                        </div><!-- End .banner -->
                                    </div><!-- End .col-sm-8 -->

                                    <div class="col-sm-4">
                                        <div class="banner banner-cat banner-badge">
                                            <a href="#">
                                                <img src="assets/images/category/fullwidth-page/banner-7.jpg" alt="Banner">
                                            </a>

                                            <a class="banner-link" href="#">
                                                <h3 class="banner-title">T-shirts</h3><!-- End .banner-title -->
                                                <h4 class="banner-subtitle">0 Products</h4><!-- End .banner-subtitle -->
                                                <span class="banner-link-text">Shop Now</span>
                                            </a><!-- End .banner-link -->
                                        </div><!-- End .banner -->

                                        <div class="banner banner-cat banner-badge">
                                            <a href="#">
                                                <img src="assets/images/category/fullwidth-page/banner-8.jpg" alt="Banner">
                                            </a>

                                            <a class="banner-link" href="#">
                                                <h3 class="banner-title">Jumpers</h3><!-- End .banner-title -->
                                                <h4 class="banner-subtitle">1 Product</h4><!-- End .banner-subtitle -->
                                                <span class="banner-link-text">Shop Now</span>
                                            </a><!-- End .banner-link -->
                                        </div><!-- End .banner -->
                                    </div><!-- End .col-sm-4 -->
                                </div><!-- End .row -->
                            </div><!-- End .col-lg-6 -->
                        </div><!-- End .row -->
                    @endforeach
                </div><!-- End .container-fluid -->
            </div><!-- End .categories-page -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection
