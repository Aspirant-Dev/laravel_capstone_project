
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Invoice #{{ $orders->tracking_no }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/admin/css/adminlte.min.css') }}">
</head>
<body>
<div class="wrapper">

<!-- Main content -->
<section class="content printMe" style="margin: 0 auto">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <br>
                <br>
                <div  id="invoice" class="invoice p-3 mb-3" style="border: 1px solid black;" >
                    <div class="row" >
                        <div class="col-12">
                            <h4>
                                <span><img src="{{ asset('assets/landing_page/assets/logo.png') }}" height="40px" width="40px" ></span>
                                    Real Value ENT.
                                <small class="float-right">{{  date('M-d-Y', strtotime($orders->created_at)) }}</small>
                            </h4>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong>Real Value ENT.</strong><br>
                            MacArthur Highway, Brgy. Saog,<br>
                            Marilao, Bulacan, Philippines.<br>
                            Phone: 0932-856-7990<br>
                            Email: enterpriserealvalue@gmail.com
                        </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            <strong>{{ $orders->fname.' '. $orders->lname }}</strong><br>
                            Phone: {{ $orders->phone_no }} <br>
                            Address: {{ $orders->address.', '.$orders->barangay.', '.$orders->city.', '.$orders->postal_code }} <br>
                            Email: {{ $orders->email }}
                        </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                        <b>Invoice #{{ $orders->tracking_no }}</b><br>
                        <br>
                        <b>Order ID:</b> {{ $orders->id }}<br>
                        <b>Payment Method:</b> {{ $orders->payment_method }}<br>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Brand</th>
                                        <th class="text-center">Type</th>
                                        <th  class="text-center">Unit</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Price</th>
                                        <th  class="text-center">Total</th>
                                        <th class="text-center">Image</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders->orderItems as $item )
                                            <tr class="text-center">
                                                <td>{{ $item->products->name }}</td>
                                                <td>{{ $item->products->brand }}</td>
                                                <td>{{ $item->products->product_type }}</td>
                                                <td>{{ $item->products->unit }}</td>
                                                <td>x{{ $item->qty }}</td>
                                                <td>&#8369;{{ number_format($item->price,2) }}</td>
                                                <td>&#8369;{{ number_format( $item->qty * $item->price,2) }}</td>
                                                <td><img src="{{ asset('uploads/products/'.$item->products->image) }}" alt="..." height="50px" width="50px"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12">
                        <h4 class="float-right">Total Amount : <strong>&#8369; {{ number_format($orders->total_price,2) }}</strong></h4>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12">
                        <h4 class="text-center">Thank you for shopping with us!</strong></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    window.addEventListener("load", window.print());
  </script>
  </body>
  </html>
