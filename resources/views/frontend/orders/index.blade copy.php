@extends('layouts.front')

@section('title')
    My Purchases
@endsection

@section('content')
<div class="py-3 mb-4 bg-light shadow-sm">
    <div class="container">
        <h6 class="mb-0"><a href="{{ url('/') }}">Home</a> / My Purchases</h6>
    </div>
</div>
<h4 class="text-center">
    My Purchases
</h4>
    <div class="container py-4 pb-5">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card border-0">
                    <div class="card-header">
                        <div>
                            <div class="table-responsive">
                                <div class="btn-group w-100 mb-3 mt-3">
                                    <a class="btn @if(Route::is('user.all.purchases')) bg-info fw-bold @endif"  href="{{ url('/my-purchases') }}" > All </a>
                                    <a class="btn @if(Route::is('user.pending.purchases')) bg-info fw-bold @endif" href="{{ url('my-purchases/pending') }}" > Pending</a>
                                    <a class="btn @if(Route::is('user.processing.purchases')) bg-info fw-bold @endif" href="{{ url('my-purchases/processing-orders') }}" > Processing Orders</a>
                                    <a class="btn @if(Route::is('user.for-delivery.purchases')) bg-info fw-bold @endif" href="{{ url('my-purchases/for-delivery') }}" > For Delivery</a>
                                    <a class="btn @if(Route::is('user.delivered.purchases')) bg-info fw-bold @endif" href="{{ url('my-purchases/delivered') }}" > Delivered </a>
                                    <a class="btn @if(Route::is('user.cancelled.purchases')) bg-info fw-bold @endif" href="{{ url('my-purchases/cancelled') }}" > Cancelled </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <th class="text-center">Order Date</th>
                        @if(Route::is('user.pending.purchases') || Route::is('user.processing.purchases'))
                            <th class="text-center">Expected Delivery Date</th>
                        @endif
                        <th class="text-center">Tracking Number</th>
                        <th class="text-center">Total Price</th>
                        <th class="text-center">Payment Method</th>
                        @if(Route::is('user.all.purchases'))
                        <th class="text-center">Status</th>
                        @endif
                        <th class="text-center">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item )
                            <tr class="text-center">
                                <td>{{ date('M-d-Y', strtotime($item->created_at)) }}</td>
                                @if(Route::is('user.pending.purchases') || Route::is('user.processing.purchases'))
                                    <td>{{ Carbon\Carbon::parse($item->created_at)->addDays(1)->format('F d').' - '.Carbon\Carbon::parse($item->created_at)->addDays(3)->format('d, Y') }}</td>
                                @endif
                                <td>{{ $item->tracking_no }}</td>
                                <td>&#8369;{{ number_format($item->total_price,2) }}</td>
                                <td>{{ $item->payment_method }}</td>

                                @if(Route::is('user.all.purchases'))
                                <td>
                                    @if ($item->status == '0')

                                        <span class="badge bg-info text-dark">Pending</span>

                                    @elseif ($item->status == '1')
                                        <span class="badge bg-info text-dark">Processing Orders</span>

                                        @elseif ($item->status == '2')
                                        <span class="badge bg-info text-dark">For Delivery</span>

                                    @elseif ($item->status == '3')

                                        <span class="badge bg-success">Delivered</span>
                                    @elseif ($item->status == '4')

                                        <span class="badge bg-danger">Cancelled</span>
                                    @else

                                        <span class="badge bg-warning text-dark">	Requesting for Order Cancellation</span>

                                    @endif
                                </td>
                                @endif
                                <td>
                                    <a href="{{ url('view-order/'.$item->id ) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if(session('status1'))
    <script>
        swal({
            title: "{{ session('status1') }}",
            icon: 'info',
        });
    </script>
@endif
@endsection
