@extends('new-frontend.layouts.front')

@section('title')
    My Orders
@endsection

@section('content')

<nav aria-label="breadcrumb" class="breadcrumb-nav bg-white">
    <div class="container-fluid ">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Orders</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->
<div class="page-content " style="margin-top: -40px">
        <div class="container-fluid py-4 pb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border shadow-sm">
                        <div class="card-header  ">
                            <div class="container-fluid">
                                <div class="table-responsive ">
                                    <div class="btn-group w-100 mb-3 mt-3 ">
                                        <a class="btn @if(Route::is('user.all.orders')) bg-info fw-bold @endif"  href="{{ url('/my-orders') }}" > All </a>
                                        <a class="btn @if(Route::is('user.pending.orders')) bg-info fw-bold @endif" href="{{ url('my-orders/pending') }}" > Pending</a>
                                        <a class="btn @if(Route::is('user.processing.orders')) bg-info fw-bold @endif" href="{{ url('my-orders/processing-orders') }}" > Processing Orders</a>
                                        <a class="btn @if(Route::is('user.for-delivery.orders')) bg-info fw-bold @endif" href="{{ url('my-orders/for-delivery') }}" > For Delivery</a>
                                        <a class="btn @if(Route::is('user.delivered.orders')) bg-info fw-bold @endif" href="{{ url('my-orders/delivered') }}" > Delivered </a>
                                        <a class="btn @if(Route::is('user.cancelled.orders')) bg-info fw-bold @endif" href="{{ url('my-orders/cancelled') }}" > Cancelled </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(sizeof($orders) > 0)
            <div class="container-fluid" style="margin-top: -20px;">
                <table id="myTable" class="table table-mobile table-hover table-condensed border shadow-sm bg-white">
                    <thead class="text-center font-weight-bold text-dark">
                            <th class="pb-0"><h6>Order Date</h6></th>
                            <th class="pb-0"><h6>Tracking Number</h6></th>
                            <th class="pb-0"><h6>Total Price</h6></th>
                            <th class="pb-0"><h6>Payment Method</h6></th>
                            @if(Route::is('user.all.orders'))
                            <th class="pb-0"><h6>Status</h6></th>
                            @endif
                            <th class="pb-0"><h6>Action</h6></th>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                            <tr class="text-center ">
                                <td><h6>{{ date('F j, Y (g:i a)', strtotime($item->created_at)) }}</h6></td>
                                <td><h6>{{ $item->tracking_no }}</td>
                                    <td><h6>&#8369;{{ number_format($item->total_price,2) }}</h6></td>
                                    <td><h6>{{ $item->payment_method }}</h6></td>

                                    @if(Route::is('user.all.orders'))
                                    <td><h4>
                                        @if ($item->status == '0')

                                            <span class="badge bg-info text-white">Pending</span>

                                        @elseif ($item->status == '1')
                                            <span class="badge bg-info text-white">Processing Orders</span>

                                            @elseif ($item->status == '2')
                                            <span class="badge bg-info text-white">For Delivery</span>

                                        @elseif ($item->status == '3')

                                            <span class="badge bg-success text-white">Delivered</span>
                                        @elseif ($item->status == '4')

                                            <span class="badge bg-danger">Cancelled</span>
                                        @else
                                            <span class="badge bg-warning text-dark">	Requesting for Order Cancellation</span>
                                        @endif
                                    </h4></td>
                                    @endif
                                    <td><h6>
                                        <a href="{{ url('view-order/'.$item->id ) }}" class="btn  btn-outline-primary-2"><i class="fas fa-eye"></i> View</a>
                                    </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table><!-- End .table table-wishlist -->
                <div class="d-flex justify-content-center">{{ $orders->links() }}</div>
            </div><!-- End .container -->
        @else
        <div class="container">
            <div class="row">
                <div class="col-md-12 mycard py-5 text-center">
                    <div class="mycards">
                        <span><i class="fas fa-shopping-bag fa-9x"></i></span>
                        <h4 class="mt-3">No orders yet.</h4>
                        <a href="{{ url('/') }}" class="btn btn-upper btn-primary outer-left-xs mt-5">Go Shop <i class="icon-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div><!-- End .page-content -->


@if(session('status1'))
    <script>
        swal({
            title: "{{ session('status1') }}",
            icon: 'info',
        });
    </script>
@endif
<!-- JQuery CDN-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = false;

        var pusher = new Pusher('bdd702fa83485adf2106', {
        cluster: 'mt1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('form-submitted', function(data) {

            setTimeout(function() {
            window.location.href = window.location;
            }, 3000);
        });
    });
</script>
@endsection
