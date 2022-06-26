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
            table td.service,
            table td.qty,
            table td.total {
            font-size: 1.3em;
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
            table td.unit,
            table td.service,
            table td.qty,
            table td.total {
            font-size: 1.5em;
            }
        }
        @media  only screen and (max-width: 500px) {
            body {
                font-size: 10px;
                padding: 14px;
                width: 100% !important;
            }
            table td.unit,
            table td.service,
            table td.qty,
            table td.total {
            font-size: 1.5em;
            }
        }
    </style>
</head>
  <body>

    <main style="">
        <div id="notices">
            <br>
                <div><h2>Good day {{ $name }}!</h2></div>
            <br>
                <div>
                    <h2>We just want to inform that your request of return product on {{ date('j F Y (g:i a)', strtotime($productDetails->created_at)) }} was approved.<br/>
                    <br/>
                        You may now go to our store to change your item. Thank you!
                    </h2>
                </div>
        </div>
        <br>
        <div><h2>Your item to be return are as below :</h2></div>
      <table>
        <thead>
          <tr>
            <th style="font-weight: bold">PRODUCT NAME</th>
            <th style="font-weight: bold">QTY</th>
          </tr>
        </thead>
        <tbody>
            <td style="text-align: center">{{ $product_name }}</td>
            <td style="text-align: center">{{ $product_qty }}</td>
        </tbody>
      </table>

    <br>
    <div id="notices">
        <div><h3>If you have any questions or concerns please let us know through our email : <a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=enterpriserealvalue@gmail.com" target="_blank"> enterpriserealvalue@gmail.com</a></h3></div>
    </div>
    </main>
  </body>
</html>
