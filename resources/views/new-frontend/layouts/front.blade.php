<!DOCTYPE html>
<html lang="en">
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    {{-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>
        @yield('title')
    </title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/landing_page/assets/logo.png') }}" />

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/owl-carousel/owl.carousel.css') }}">

    {{-- <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/nouislider/nouislider.css') }}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!--  Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    {{-- SweetAlert --}}
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    <!-- ALERTIFY CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- ALERTIFY Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/skins/skin-demo-10.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/demos/demo-10.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('assets/css/search-input.css') }}">
    {{-- Autocomplete --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <style>
        .banner-content-overlay
        {
            background-color: rgba(255, 255, 255, 0.9) !important;
        }
        .swal-modal .swal-text
        {
            text-align: center;
        }
        .ui-widget
        {
            /* position: absolute; */
            /* top: 0;
            bottom:0; */
            z-index: 2040;
            position:fixed;
        }
    </style>

</head>
<body>
    @php
        use App\Order;
    @endphp
    @php
        use App\Carts;
        if(Auth::check())
        {
            $cart = Carts::where('user_id', Auth::user()->id)->orderBy('id','DESC')->take(3)->get();
            $cartTotal = Carts::where('user_id', Auth::user()->id)->orderBy('id','DESC')->get();
            $total = 0;
            foreach ($cartTotal as $item) {
                $total += $item->products->price * $item->product_qty;
            }
        }
    @endphp
    @php
        use App\Product;

        $feat_products = Product::where('trending','1')->where('status','1')->take(12)->get();
    @endphp
    <div class="page-wrapper">
        <header class="header sticky-top ">
            <div class="header-top sticky-header">
                <div class="container-fluid">
                    <div class="header-left" style="margin-top: 10px">
                        <a style="font-weight: 700;" href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=enterpriserealvalue@gmail.com" target="_blank" class="text-lowercase"><i class="fas fa-envelope"></i> enterpriserealvalue@gmail.com</a>
                    </div>
                    <div class="header-right" style="font-weight: 500;">
                        <ul class="top-menu" style="margin-top: 10px">
                            <li>
                                <a style="font-style: normal" >Links</a>
                                <ul>
                                    <li><a href="tel:+0932-856-7990"><i class="fas fa-phone-alt"></i>09328567990</a></li>
                                    <li><a href="{{ route('frontend.about-us') }}"><i class="fas fa-users"></i> About Us</a></li>
                                    <li><a href="{{ route('contact-us') }}"><i class="fas fa-globe-asia"></i> Contact Us</a></li>
                                    @if (Auth::check())

                                        <li><a href="{{ route('user.wishlist') }}"><i class="far fa-heart"></i>Wishlist <p>(<p class="font-weight-bold wishlist-count"></p>)</p></a></li>
                                    @else
                                        <li><a href="{{ route('user.wishlist') }}"><i class="far fa-heart"></i>Wishlist</a></li>
                                    @endif
                                    @if (Auth::check())
                                    @php

                                        $count = Order::where('user_id',Auth::user()->id)->count();
                                        $pe = Order::where('user_id',Auth::user()->id)->where('status',0)->count();
                                        $pr = Order::where('user_id',Auth::user()->id)->where('status',1)->count();
                                        $fd = Order::where('user_id',Auth::user()->id)->where('status',2)->count();
                                        $de = Order::where('user_id',Auth::user()->id)->where('status',3)->count();
                                        $ca = Order::where('user_id',Auth::user()->id)->where('status',4)->count();
                                    @endphp
                                        <li class="header-dropdown cart-dropdown" style="padding-left: 0rem;">
                                            <a style="cursor: pointer;" title="View Orders"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                <i class="fas fa-store"></i> Orders
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <div class="dropdown-cart-products">
                                                    <div class="product">
                                                        <div class="product-cart-details ">
                                                            <h4 class="product-title">
                                                                <a href="{{ route('user.all.orders') }}">All Orders</a>
                                                            </h4>
                                                        </div><!-- End .product-cart-details -->
                                                        <figure class="product-image-container">
                                                            <span><strong><span id="count-all">{{ $count }}</span></strong></span>
                                                        </figure>
                                                        {{-- <a href="#" class="btn-remove delete-cart-item" title="Remove Product"><i class="icon-close"></i></a> --}}
                                                    </div><!-- End .product -->
                                                    <div class="product">
                                                        <div class="product-cart-details ">
                                                            <h4 class="product-title">
                                                                <a href="{{ route('user.pending.orders') }}">Pending Orders</a>
                                                            </h4>
                                                        </div><!-- End .product-cart-details -->
                                                        <figure class="product-image-container">
                                                            <span><strong><span id="count-Pending">{{ $pe }}</span></strong></span>
                                                        </figure>
                                                        {{-- <a href="#" class="btn-remove delete-cart-item" title="Remove Product"><i class="icon-close"></i></a> --}}
                                                    </div><!-- End .product -->
                                                    <div class="product">
                                                        <div class="product-cart-details ">
                                                            <h4 class="product-title">
                                                                <a href="{{ route('user.processing.orders') }}">Processing Orders</a>
                                                            </h4>
                                                        </div><!-- End .product-cart-details -->
                                                        <figure class="product-image-container">
                                                            <span><strong><span id="count-Processing">{{ $pr }}</span></strong></span>
                                                        </figure>
                                                        {{-- <a href="#" class="btn-remove delete-cart-item" title="Remove Product"><i class="icon-close"></i></a> --}}
                                                    </div><!-- End .product -->
                                                    <div class="product">
                                                        <div class="product-cart-details ">
                                                            <h4 class="product-title">
                                                                <a href="{{ route('user.for-delivery.orders') }}">For Delivery Orders</a>
                                                            </h4>
                                                        </div><!-- End .product-cart-details -->
                                                        <figure class="product-image-container">
                                                            <span><strong><span id="count-Delivery">{{ $fd }}</span></strong></span>
                                                        </figure>
                                                        {{-- <a href="#" class="btn-remove delete-cart-item" title="Remove Product"><i class="icon-close"></i></a> --}}
                                                    </div><!-- End .product -->
                                                    <div class="product">
                                                        <div class="product-cart-details ">
                                                            <h4 class="product-title">
                                                                <a href="{{ route('user.delivered.orders') }}">Delivered Orders</a>
                                                            </h4>
                                                        </div><!-- End .product-cart-details -->
                                                        <figure class="product-image-container">
                                                            <span><strong><span id="count-Completed">{{ $de }}</span></strong></span>
                                                        </figure>
                                                        {{-- <a href="#" class="btn-remove delete-cart-item" title="Remove Product"><i class="icon-close"></i></a> --}}
                                                    </div><!-- End .product -->
                                                    <div class="product">
                                                        <div class="product-cart-details ">
                                                            <h4 class="product-title">
                                                                <a href="{{ route('user.cancelled.orders') }}">Cancelled Orders</a>
                                                            </h4>
                                                        </div><!-- End .product-cart-details -->
                                                        <figure class="product-image-container">
                                                            <span><strong><span id="count-Cancelled">{{ $ca }}</span></strong></span>
                                                        </figure>
                                                        {{-- <a href="#" class="btn-remove delete-cart-item" title="Remove Product"><i class="icon-close"></i></a> --}}
                                                    </div><!-- End .product -->
                                                </div><!-- End .cart-product -->
                                            </div><!-- End .dropdown-menu -->
                                        </li><!-- End .cart-dropdown -->
                                        <li class="header-dropdown cart-dropdown" style="padding-left: 0rem;">
                                            <a style="cursor: pointer;" title="View Account"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                <i class="fas fa-user"></i> {{ Auth::user()->username }}
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" style="width: 200px !important;">
                                                <div class="dropdown-cart-products">
                                                    <div class="product" >
                                                        <div class="product-cart-details ">
                                                            <h4 class="product-title">
                                                                <a href="{{ route('user.dashboard') }}"><i class="fa fa-tachometer"></i> Dashboard</a>
                                                            </h4>
                                                        </div><!-- End .product-cart-details -->
                                                    </div><!-- End .product -->
                                                    <div class="product" >
                                                        <div class="product-cart-details ">
                                                            <h4 class="product-title">
                                                                <a href="{{ route('user.profile') }}"><i class="fas fa-user"></i> My Account</a>
                                                            </h4>
                                                        </div><!-- End .product-cart-details -->
                                                    </div><!-- End .product -->
                                                    <div class="product" >
                                                        <div class="product-cart-details ">
                                                            <h4 class="product-title">
                                                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
                                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                    @csrf
                                                                </form>
                                                            </h4>
                                                        </div><!-- End .product-cart-details -->
                                                    </div><!-- End .product -->
                                                </div>
                                            </div>
                                        </li>
                                    @else
                                        <li><a href="{{ route('login') }}"><i class="fas fa-user"></i>Login</a></li>
                                        <li><a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Register</a></li>
                                    @endif
                                </ul>
                            </li>
                        </ul><!-- End .top-menu -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-top -->

            <div class="header-middle border-bottom">
                <div class="container-fluid">
                    <div class="header-left">
                        <a href="{{ url('/') }}" class="logo">
                            <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="RVE Logo" width="100%" style="height: 50px;">
                        </a>
                        <nav class="main-nav" >

                            <ul class="menu ">
                                <li class="">
                                    <a href="{{ url('/') }}" style="cursor: pointer; font-weight: bold; font-size: 20px; margin-left: -40px;" class="">Real Value Enterprise</a>
                                </li>
                            </ul>
                            {{-- <ul class="menu sf-arrows">
                                <li class="megamenu-container">
                                    <a style="cursor: pointer; font-weight: bold;" class="sf-with-ul">Categories</a>
                                    <div class="megamenu demo">
                                        <div class="menu-col">
                                            <div class="demo-list">
                                                @php
                                                    use App\Category;
                                                    $categories = Category::where('status','1')->get();
                                                @endphp
                                                @foreach ($categories as $item)
                                                    <div class="demo-item">
                                                        <a href="{{ url('view-category/'.$item->slug) }}">
                                                            <span class="demo-bg" style="background-image: url({{ asset('uploads/categories/'.$item->image) }});"></span>
                                                            <span class="demo-title"><strong>{{ $item->name }}</strong></span>
                                                        </a>
                                                    </div><!-- End .demo-item -->
                                                @endforeach
                                            </div><!-- End .demo-list -->

                                            <div class=" text-center">
                                                <a href="{{ url('/categories') }}" class="btn btn-outline-primary-2"><span>View All Category</span><i class="icon-long-arrow-right"></i></a>
                                            </div><!-- End .text-center -->
                                        </div><!-- End .menu-col -->
                                    </div><!-- End .megamenu -->
                                </li>
                                <li class="megamenu-container">
                                    <a style="cursor: pointer; font-weight: bold;" class="sf-with-ul">Featured</a>
                                    <div class="megamenu demo">
                                        <div class="menu-col">
                                            <div class="demo-list">
                                                @foreach ($feat_products as $item)
                                                    <div class="demo-item">
                                                        <a href="{{ url('category/'.$item->category->slug.'/'.$item->slug) }}">
                                                            <span class="demo-bg" style="background-image: url({{ asset('uploads/products/'.$item->image) }});"></span>
                                                            <span class="demo-title">{{ $item->name }}</span>
                                                        </a>
                                                    </div><!-- End .demo-item -->
                                                @endforeach
                                            </div><!-- End .demo-list -->

                                            <div class=" text-center">
                                                <a href="{{ url('/categories') }}" class="btn btn-outline-primary-2"><span>View All Category</span><i class="icon-long-arrow-right"></i></a>
                                            </div><!-- End .text-center -->
                                        </div><!-- End .menu-col -->
                                    </div><!-- End .megamenu -->
                                </li>
                                <li class="megamenu-container">
                                    <a href="#" class="sf-with-ul">Featured Products</a>
                                    <div class="megamenu demo">
                                        <div class="menu-col">
                                            <div class="demo-list">
                                                @foreach ($feat_products as $item)
                                                    <div class="demo-item">
                                                        <a href="{{ url('category/'.$item->category->slug.'/'.$item->slug) }}">
                                                            <span class="demo-bg" style="background-image: url({{ asset('uploads/products/'.$item->image) }});"></span>
                                                            <span class="demo-title">{{ $item->name }}</span>
                                                        </a>
                                                    </div><!-- End .demo-item -->
                                                @endforeach
                                            </div><!-- End .demo-list -->

                                            <div class="megamenu-action text-center">
                                                <a href="{{ url('/shop') }}" class="btn btn-outline-primary-2"><span>More Info</span><i class="icon-long-arrow-right"></i></a>
                                            </div><!-- End .text-center -->
                                        </div><!-- End .menu-col -->
                                    </div><!-- End .megamenu -->
                                </li>
                            </ul><!-- End .menu --> --}}
                        </nav><!-- End .main-nav -->
                    </div><!-- End .header-left -->

                    <div class="header-right">
                        <form action="{{ url('/searching') }}" method="post" id="search-form" style="margin-top: 15px!important;">
                            @csrf
                            <input class="input-grey-rounded" name="search_product" id="search_text"  type="search" placeholder="Search products here..." required
                            oninvalid="this.setCustomValidity('No items to be search.')" oninput="this.setCustomValidity('')"/>

                        </form>

                        <div class="dropdown cart-dropdown">
                            <a style="cursor: pointer;" title="View Cart"  class="dropdown-toggle " role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <i class="icon-shopping-cart"></i>
                                @if(Auth::check())
                                    <span class="cart-count"></span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                @if(Auth::check())
                                    @if($cart->count() > 0)
                                        <div class="dropdown-cart-products">
                                            @php $totalPrice=0; $grandTotal = 0; @endphp
                                            @foreach ($cart as $item)
                                            <div class="product product_data">
                                                <div class="product-cart-details ">
                                                    <h4 class="product-title">
                                                        <a href="{{ url('category/'.$item->products->category->slug.'/'.$item->products->slug) }}">{{ $item->products->name }}</a>
                                                    </h4>
                                                    <span class="cart-product-info">
                                                        <input type="hidden" class="product_name" value="{{ $item->products->name }}">
                                                        <input type="hidden" class="product_id" value="{{ $item->products->id }}">
                                                        <span class="cart-product-qty">{{ $item->product_qty }}</span>
                                                        x &#8369; {{ number_format($item->products->price,2) }}
                                                    </span>
                                                </div><!-- End .product-cart-details -->

                                                <figure class="product-image-container">
                                                    <a href="{{ url('category/'.$item->products->category->slug.'/'.$item->products->slug) }}" class="product-image">

                                                        <img src="{{ asset('uploads/products/'.$item->products->image) }}" alt="product">
                                                    </a>
                                                </figure>
                                                {{-- <a href="#" class="btn-remove delete-cart-item" title="Remove Product"><i class="icon-close"></i></a> --}}
                                            </div><!-- End .product -->

                                            @php  number_format($grandTotal += $item->products->price*$item->product_qty,2);@endphp
                                            @endforeach
                                        </div><!-- End .cart-product -->

                                        <div class="dropdown-cart-total">
                                            <span>Total</span>

                                            <span class="cart-total-price">&#8369; {{ number_format($total,2) }}</span>
                                        </div><!-- End .dropdown-cart-total -->

                                        <div class="dropdown-cart-action">
                                            {{-- <a href="{{ url('/cart') }}" class="btn  btn-primary">View Cart</a> --}}
                                            <a href="{{ url('/cart') }}" class="btn btn-primary"><span>View Cart</span><i class="icon-shopping-cart"></i></a>
                                            <a href="{{ url('/checkout') }}" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                                        </div><!-- End .dropdown-cart-total -->
                                    @else
                                    <p class="text-center">No products in the cart.</p>
                                    @endif
                                @else
                                    {{-- <div class="dropdown-cart-total p-0"> --}}
                                        <h6 class="text-center"><a href="{{ route('login') }}">Login</a> to view your cart items.</h6>
                                        {{-- <span class="cart-total-price">&#8369; {{ number_format($grandTotal,2) }}</span> --}}
                                    {{-- </div><!-- End .dropdown-cart-total --> --}}
                                @endif
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .cart-dropdown -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->
        </header><!-- End .header -->

        {{-- <main class="main" @if(Route::is('pay.gcash') || (Route::is('checkout')) || (Route::is('frontend.about-us')) || (Route::is('contact-us'))) style="background-color: rgb(234, 243, 255)!important;" @endif> --}}
        <main class="main" style="background-color: rgb(234, 243, 255)!important;">
            @yield('content')
        </main>

        <footer class="footer footer-dark" >
        	<div class="footer-middle">
	            <div class="container-fluid">
	            	<div class="row">
	            		<div class="col-sm-6 col-lg-3">
	            			<div class="widget widget-about">
	            				<img src="{{ asset('frontend/assets/images/logo.png') }}" class="footer-logo" alt="Footer Logo" width="105" height="25">
	            				<p style="color: rgba(255, 255, 255, 0.753)">realvalueenterprise.online is an online store where you can find your desire products in company. </p>

	            				<div class="social-icons">
	            					<a href="https://www.facebook.com/REAL-VALUE-Enterprises-100441979037579" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
	            					<a href="https://www.linkedin.com/in/renz-joseph-castelo-4522021b9/" class="social-icon" target="_blank" title="LinkedIn"><i class="icon-linkedin"></i></a>
	            				</div><!-- End .soial-icons -->
	            			</div><!-- End .widget about-widget -->
	            		</div><!-- End .col-sm-6 col-lg-3 -->
                        <div class="col-sm-6 col-lg-3">
                            <div class="widget">
                                <h4 class="widget-title">Useful Links</h4><!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a style="color: rgba(255, 255, 255, 0.753)" href="{{ route('frontend.about-us') }}">About Real Value Enterprise</a></li>
                                    <li><a style="color: rgba(255, 255, 255, 0.753)" href="{{ route('frontend.policy') }}">Privacy Policy</a></li>
                                    <li><a style="color: rgba(255, 255, 255, 0.753)" href="{{ route('frontend.terms') }}">Terms and Conditions</a></li>
                                    <li><a style="color: rgba(255, 255, 255, 0.753)" href="{{ url('/categories') }}">Categories</a></li>
                                    <li><a style="color: rgba(255, 255, 255, 0.753)" href="{{ route('contact-us') }}">Contact us</a></li>
                                    <li><a style="color: rgba(255, 255, 255, 0.753)" href="{{ route('login') }}">Log in</a></li>
                                    <li><a style="color: rgba(255, 255, 255, 0.753)" href="{{ route('register') }}">Register</a></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->
                        <div class="col-sm-6 col-lg-3">
                            <div class="widget">
                                <h4 class="widget-title">My Account</h4><!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a style="color: rgba(255, 255, 255, 0.753)" href="{{ route('user.profile') }}">My Profile</a></li>
                                    <li><a style="color: rgba(255, 255, 255, 0.753)" href="{{ url('/cart') }}">View Cart</a></li>
                                    <li><a style="color: rgba(255, 255, 255, 0.753)" href="{{ route('user.wishlist') }}">My Wishlist</a></li>
                                    <li><a style="color: rgba(255, 255, 255, 0.753)" href="{{ route('user.all.orders') }}">My Order</a></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->
                        <div class="col-sm-6 col-lg-3">
                            <div class="widget">
                                <h4 class="widget-title">Payment Method</h4><!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><img src="{{ asset('frontend/assets/images/payment-method-paypal.png') }}" alt="" width="50%" srcset=""></li>
                                    <li><img src="{{ asset('frontend/assets/images/payment-method-gcash.png') }}" alt="" width="50%" srcset=""></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->
	            	</div><!-- End .row -->
	            </div><!-- End .container -->
	        </div><!-- End .footer-middle -->

	        <div class="footer-bottom">
	        	<div class="container-fluid">
	        		<p style="color: rgba(255, 255, 255, 0.753)" class="footer-copyright">Copyright © 2021 Real Value Enterprises. All Rights Reserved.</p><!-- End .footer-copyright -->

                </div><!-- End .container -->
	        </div><!-- End .footer-bottom -->
        </footer><!-- End .footer -->
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top" class="bg-primary "><i class="icon-arrow-up text-white"></i></button>


    @yield('scripts')

    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!-- Plugins JS File -->
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.hoverIntent.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/superfish.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.elevateZoom.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script>
        $(document).ready(function (){

            src = "{{ route('searchproductajax') }}";
            $( "#search_text" ).autocomplete({
                source: function(request, response){
                    $.ajax({
                        url: src,
                        data: {
                            term: request.term
                        },
                        dataType: "json",
                        success: function (data){
                            response(data);
                        }
                    })
                },
                minLength: 1,

            });
            $(document).on('click', '.ui-menu-item', function (){
                    $('#search-form').submit();
            });
        });
    </script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    @if(Auth::check())
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        $(document).ready(function () {
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = false;

            var pusher = new Pusher('bdd702fa83485adf2106', {
            cluster: 'mt1'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('form-submitted', function(data) {
            $('#count-all').html(data.text);
            $('#count-Pending').html(data.text1);
            $('#count-Processing').html(data.text2);
            $('#count-Delivery').html(data.text3);
            $('#count-Completed').html(data.text4);
            $('#count-Cancelled').html(data.text5);

            alertify.set('notifier','position', 'top-right');
            alertify.success('One of your order has been updated the status. Check it now!');
            });
        });

    </script>
@endif
</body>
</html>
