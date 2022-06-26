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
      <h1>Order Confirmation</h1>
      <div id="company" class="clearfix">
        <div>Company Name</div>
        <div>Real Value Enterprise<br />Mc-Arthur Saog Marilao, Bulacan</div>
        <div>0938-348-3592</div>
        <div><a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=enterpriserealvalue@gmail.com" target="_blank"> enterpriserealvalue@gmail.com</a></div>
      </div>
      <div id="project">
        <div><span>BILLED TO</span><br> <b>{{ $order_data['name'] }}</b></div>
        <div><span>ADDRESS</span><br><b>{{ $order_data['address'] }}</b></div>
        <div><span>Payment Method</span><br><b>{{ $order_data['payment_method'] }}</b></a></div>
        <div><span>ORDER DATE</span><br><b>{{ Carbon\Carbon::now()->format('F d, Y ') }}</b></div>
        <div><span>DELIVERED ON </span><br><b>{{ Carbon\Carbon::now()->addDays(1)->format('F d').'-'.Carbon\Carbon::now()->addDays(3)->format('d, Y') }}</b></div>
      </div>
    </header>
    <main>
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
            @foreach ($items_in_cart as $item)

                <tr>
                <td class="service">{{ $item->products->name }}</td>
                <td class="desc text-center" style="text-align: center;">&#8369;{{ $item->products->price }}</td>
                <td class="unit" style="text-align: center;">{{ $item->product_qty }}</td>
                <td class="total" style="text-align: center;">&#8369;@php echo number_format($totalPrice = $item->products->price*$item->product_qty,2); @endphp </td>
                </tr>
            @endforeach
          <tr>
            <td colspan="3" class="grand total">GRAND TOTAL</td>
            <td class="grand total">&#8369;{{ number_format($order_data['total'],2) }}</td>
          </tr>

        </tbody>
      </table>
      <div id="notices">
        <div><h2>Thank you for purchasing!</h2></div>
      </div>
      <div id="notices">
        <div><h2>If you have any questions or concerns please let us know through our email: <a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=enterpriserealvalue@gmail.com" target="_blank"> enterpriserealvalue@gmail.com</a> or you can call us via this phone number: 0932-856-7990.</h2></div>
      </div>
    </main>
  </body>
</html>
