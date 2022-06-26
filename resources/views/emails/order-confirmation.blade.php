<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style type="text/css">
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        @media screen and (max-width: 480px) {
            .mobile-hide {
                display: none !important;
            }

            .mobile-center {
                text-align: center !important;
            }
        }

        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
    </style>

<body align="center" style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">

    <header>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td align="center" bgcolor="#eeeeee">

                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                        <tr>
                            <td align="center" style="padding: 10px; background-color: #f5f5f5;" bgcolor="#ffffff">
                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                    <tr>
                                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 14px; ">
                                            <br>
                                            <a href="http://127.0.0.1:8000/" style="text-decoration:none; font-size: 20px; font-weight: 800; line-height: 36px; color: rgb(85, 85, 85); margin: 0;"> Real Value Enterprise </a>
                                            <br>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </header>

    {{-- Mail Content --}}
    <!-- Main content -->
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td align="center" bgcolor="#eeeeee">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                        <tr>
                            <td align="center" style="padding: 5px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                    <tr>
                                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                                            <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> YOUR ORDER HAS BEEN PLACED! </h2>
                                            <br>
                                            <p style="font-size: 20px;  line-height: 36px; color: #333333; margin: 0;"> Thank you for choosing real value enterprise!</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                                            <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
                                                Hey <strong style="color: black"> {{ $order_data['fname'] }} </strong>,
                                                <br>
                                                <br>
                                                Check below for your order details.
                                                <br>
                                                <br>
                                                If you have any questions, feel free to contact us at any time via email at <a style="text-decoration: none" href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=enterpriserealvalue@gmail.com">enterpriserealvalue@gmail.com</a>.
                                                <br>
                                                <br>
                                                Until next time, <br>Real Value Enterprise team.
                                            </p>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                                            <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: black; font-size: 16px; font-weight: 800; "> ORDER DETAILS</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="padding-top: 20px;">
                                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr>
                                                    <td width="70%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> Product </td>
                                                    <td width="20%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> Unit Price </td>
                                                    <td width="10%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> Qty. </td>
                                                    <td width="20%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> Total </td>
                                                </tr>
                                                <tr>
                                                    @foreach ($items_in_cart as $item)
                                                        <td width="70%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> {{ $item->products->name }} </td>
                                                        <td width="20%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> &#8369;{{ $item->products->price }} </td>
                                                        <td width="10%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> {{ $item->product_qty }}</td>
                                                        <td width="20%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> &#8369;@php echo number_format($totalPrice = $item->products->price*$item->product_qty,2); @endphp  </td>                                            </tr>
                                                    @endforeach
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td align="center" height="100%" valign="top" width="100%" style="padding: 0 35px 35px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                    <tr>
                                        <tr>
                                            <td  align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                                                <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: black; font-size: 16px; font-weight: 800; ">
                                                    Total Amount : &#8369;{{ number_format($order_data['total'],2) }}
                                                </p>
                                            </td>
                                        </tr>
                                        <td align="center" valign="top" style="font-size:0;">
                                            <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">
                                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:290px;">
                                                    <tr>
                                                        <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                                                            <p style="font-weight: 800;">Delivery Address</p>
                                                            <p>{{ $order_data['address'] }}</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">
                                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                                    <tr>
                                                        <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                                                            <p style="font-weight: 800;">Estimated Delivery Date</p>
                                                            <p>
                                                                @php
                                                                    $mytime = Carbon\Carbon::now()->addDays(3)->format('M d');
                                                                    $addtime = Carbon\Carbon::now()->addDays(5)->format('d, Y ');
                                                                    echo $mytime.'-'. $addtime;
                                                                @endphp
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    <footer>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td align="center" bgcolor="#eeeeee">

                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                        <tr>
                            <tr>
                                <td align="center" style="padding: 35px; background-color: #f5f5f5;" bgcolor="#ffffff">
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                        <tr>

                                            <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px; padding: 5px 0 10px 0;">
                                                <p style="font-size: 14px; font-weight: 800; line-height: 18px; color: #333333;">Real Value Enterprise </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px; padding: 5px 0 10px 0;">
                                                <p style="font-size: 14px; font-weight: 800; line-height: 18px; color: #333333;">Saog, Marilao, <br> Bulacan, 3019, Philippines </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;">
                                                <p style="font-size: 14px; font-weight: 400; line-height: 20px; color: #777777;"> This is an automatically generated email from our subscription list. Please do not reply to this email. </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                    </table>
                </td>
            </tr>
        </table>
    </footer>
</body>

</html>
