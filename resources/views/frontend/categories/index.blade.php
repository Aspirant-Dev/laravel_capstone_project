@extends('new-frontend.layouts.front')

@section('title')
    All Categories
@endsection

@section('content')
{{-- <main class="main" style="background-color: #d1dfff!important;"> --}}
    {{-- <div class="page-header text-center" style="background-image: url('{{ asset('frontend/assets/images/category-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">Product Category</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header --> --}}
    <nav aria-label="breadcrumb" class="breadcrumb-nav bg-white">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                @foreach ($categories as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="banner banner-cat shadow" style="border: 1px solid rgb(172, 170, 170)">
                            <a href="{{ url('view-category/'.$item->slug) }}">
                                <img src="{{ asset('uploads/categories/'.$item->image) }}" style="width: 100%; height: 350px;" alt="Banner">
                            </a>
                            <div class="banner-content banner-content-overlay text-center">
                                @php
                                        $productsCount = App\Product::productsCount($item['id']);
                                    @endphp
                                <h3 class="banner-title"><strong>{{ $item->name }}</strong></h3><!-- End .banner-title -->
                                <h4 class="banner-subtitle">{{ $productsCount }} @if($productsCount > 1) Products @else Product @endif</h4><!-- End .banner-subtitle -->
                                <a href="{{ url('view-category/'.$item->slug) }}" class="banner-link">Shop Now</a>
                            </div><!-- End .banner-content -->
                        </div><!-- End .banner -->
                    </div><!-- End .col-md-6 -->
                @endforeach
            </div><!-- End .row -->
        </div><!-- End .container-fluid -->

    </div><!-- End .page-content -->
{{-- </main><!-- End .main --> --}}


<!-- JQuery CDN-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection
