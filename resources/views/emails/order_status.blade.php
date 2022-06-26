<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:v="urn:schemas-microsoft-com:vml">

<head>
    <meta charset="utf-8">

    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
            }

            a {
            color: #5D6975;
            text-decoration: underline;
            }

            body {
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
            }

            header {
            padding: 10px 0;
            margin-bottom: 30px;
            }

            #logo {
            text-align: center;
            margin-bottom: 10px;
            }

            #logo img {
            width: 90px;
            }

            h1 {
            border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
            }

            #project {
            float: left;
            }

            #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
            }

            #company {
            float: right;
            text-align: right;
            }

            #project div,
            #company div {
            white-space: nowrap;
            }

            table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
            }

            table tr:nth-child(2n-1) td {
            background: #F5F5F5;
            }

            table th,
            table td {
            text-align: center;
            }

            table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
            }

            table .service,
            table .desc {
            text-align: left;
            }

            table td {
            padding: 20px;
            text-align: right;
            }

            table td.service,
            table td.desc {
            vertical-align: top;
            }

            table td.unit,
            table td.qty,
            table td.total {
            font-size: 1.2em;
            }

            table td.grand {
            border-top: 1px solid #5D6975;;
            }

            #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
            }

            footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
            }
            @media  only screen and (max-width: 600px) {
            body {
                padding: 10px;
                width: 100% !important;
                font-size: 15px;
            }
            }
            @media  only screen and (max-width: 500px) {
                body {
                    font-size: 10px;
                    padding: 14px;
                    width: 100% !important;
                }
            }
    </style>
  </head>
  <body>
    <header class="clearfix">
      <h1>Order Being Processed</h1>
      <div id="notices">
        <div><h2>Hi {{ $name }},</h2></div>
        <br>
        <div><h2>Your Order #{{ $tracking_no }} on {{ date('j F Y (g:i a)', strtotime($orders->created_at)) }} has been updated to processing status.</h2></div>
      </div>
    </header>
    <main>
        <div><h2>Your order details are as below :</h2></div>
      <table>
        <thead>
          <tr>
            <th class="service">PRODUCTS ORDERED</th>

            <th>UNIT PRICE</th>
            <th>QTY</th>
            <th>AMOUNT</th>
          </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach ($orderDetails as $item)

                <tr>
                <td class="service">{{ $item->products->name }}</td>
                <td class="desc text-center" style="text-align: center">&#8369;{{ number_format($item->price,2) }}</td>
                <td class="unit">{{ $item->qty }}</td>
                <td class="total">&#8369;{{ number_format($item->price * $item->qty ,2) }}</td>
                </tr>
                @php $grandTotal += $item->price * $item->qty; @endphp
            @endforeach
          <tr>
            <td colspan="3" class="grand total">GRAND TOTAL</td>
            <td class="grand total">&#8369;{{ number_format($grandTotal,2) }}</td>
          </tr>

        </tbody>
      </table>
      <div id="notices" style="margin-top: -10px; background-color: #afafaf5d; padding: 12px;" >
        <div><h3>Delivery details</h3></div>
        <div><h3>Name: {{ $name }}</h3></div>
        <div><h3>Address: {{ $orders->address.', '.$orders->barangay.', '. $orders->city.', '.$orders->postal_code }}</h3></div>
        {{-- <div><h3>Phone: {{ $orders->phone_no }}</h3></div> --}}
        <?php
            function asterisks($toConvert) {
                $astNumber = strlen($toConvert) - 8;
                return substr($toConvert, 0, 2) . str_repeat("X", $astNumber) . substr($toConvert, -4);
            }
            $tempString= $orders->phone_no;
            $num =  asterisks($tempString);
            $formated = "$num[0]$num[1]$num[2]$num[3]-$num[4]$num[5]$num[6]-$num[7]$num[8]$num[9]$num[10]";
            ?>
        <div><h3>Phone: @php echo $formated; @endphp</h3></div>
        <div><h3>Payment Method: @if($orders->payment_method == 'COD') Cash On Delivery @elseif($orders->payment_method == 'GCash') GCash @else Paypal @endif</h3></div>
    </div>

    <br>
    <div id="notices">
        <div><h3>If you have any questions or concerns please let us know through our email : <a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=enterpriserealvalue@gmail.com" target="_blank"> enterpriserealvalue@gmail.com</a> or you can call us via this phone number: <a href="tel:+0932-856-7990"> 0932-856-7990.</a></h3></div>
    </div>
    </main>
  </body>
</html>
