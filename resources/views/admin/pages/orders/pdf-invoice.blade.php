
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>
<div class="wrapper">

<!-- Main content -->
<section id="invoice" class="content printMe" style="margin: 10px auto">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="invoice p-3 mb-3" style="border: 1px solid black;" >
                    <div class="row" >
                        <div class="col-12">
                            <h4>
                                <span><img src="{{ asset('assets/landing_page/assets/logo.png') }}" height="40px" width="40px" ></span>
                                    Real Value Enterprise
                                <small class="float-right mt-2">{{  date('M-d-Y', strtotime($orders->created_at)) }}</small>
                            </h4>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong>Real Value Enterprise</strong><br>
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

                            <?php

                                function asterisks($toConvert) {
                                    $astNumber = strlen($toConvert) - 8;
                                    return substr($toConvert, 0, 2) . str_repeat("X", $astNumber) . substr($toConvert, -4);
                                }
                                $tempString= $orders->phone_no;
                                $num =  asterisks($tempString);
                                $formated = "$num[0]$num[1]$num[2]$num[3]-$num[4]$num[5]$num[6]-$num[7]$num[8]$num[9]$num[10]";
                                ?>
                            Phone: @php echo $formated; @endphp <br>
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
                    <div class="row mb-2 mt-5">
                        <div class="col-12">
                        <h4 class="float-left" style="border-top: 2px solid black">Delivery Agent Signature</strong></h4>
                        <h4 class="float-right" style="border-top: 2px solid black">Customer's Signature</strong></h4>
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
</div>
<script>
    // window.addEventListener("load", window.print());
  </script>

<?php $name = $orders->tracking_no ?>
<script>
    function generatePDF()
    {
        const element = document.getElementById("invoice");
        html2pdf()
        .from(element)
        .save('invoice '+{{ $name }});
    }
</script>
<script>
    window.addEventListener("load", generatePDF());
  </script>
  </body>
  </html>

