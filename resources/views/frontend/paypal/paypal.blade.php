
@extends('new-frontend.layouts.front')
@section('title')
    Checkout | PayPal
@endsection
@section('content')
    <!-- Include the PayPal JavaScript SDK; replace "test" with your own sandbox Business account app client ID -->

    <!-- SANDBOX ACCOUNT -->
    <script src="https://www.paypal.com/sdk/js?client-id=AdzKI1QMnFG4Tj4jkDdkwjDzE1vRDlR1CSqrBm4i3wBYZs_MznUjjZGeLFtMDU_r2u-CuR_GJRnCaSzH&currency=PHP"></script>

    <!-- LIVE ACCOUNT -->
    {{-- <script src="https://www.paypal.com/sdk/js?client-id=AWOpY6w811N6k7imkAqxiseGUj93IHGNfGHiPvNL-xJEuvkrnTOcEG2UNGMoBWYQ_SVsyQlrzys_zeSC&currency=PHP"></script> --}}
    {{-- <main class="main bg-light"> --}}

        <nav aria-label="breadcrumb" class="breadcrumb-nav bg-white">
            <div class="container-fluid">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/checkout') }}">Checkout</a></li>
                    <li class="breadcrumb-item active" aria-current="page">PayPal</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->
        <div align="center" class="container py-5">

            <input type="hidden" class="fname" value="{{ $deliveryAdresses['fname'] }}">
            <input type="hidden" class="lname" value="{{ $deliveryAdresses['lname'] }}">
            <input type="hidden" class="phone_no" value="{{ $deliveryAdresses['phone_no'] }}">
            <input type="hidden" class="email" value="{{ Auth::user()->email }}">
            <input type="hidden" class="address" value="{{ $deliveryAdresses['detailed_address'] }}">
            <input type="hidden" class="barangay" value="{{ $deliveryAdresses['barangay'] }}">
            <input type="hidden" class="city" value="{{ $deliveryAdresses['city'] }}">
            <input type="hidden" class="postal_code" value="{{ $deliveryAdresses['postal_code'] }}">
            <input type="hidden" class="country" value="Philippines">
            <input type="hidden" class="total_price" value="{{ number_format(Session::get('total'),2) }}">
            <h3>Your total payable amount is <u>&#8369;{{ number_format(Session::get('total'),2) }}</u></h3>
            <h4>Before proceeding, please make payment by clicking on 'Pay with PayPal' button below.</h4>
            <br>
            <br>

            <!-- Set up a container element for the button -->
            <div id="paypal-button-container"></div>
            <br>
            <div class="d-grid gap-2 col-7 mx-auto">
                <a href="{{ url('checkout') }}" class="btn btn-primary" style="height: 50px" type="button"><i class="icon-long-arrow-left"></i> Back to Checkout</a>
            </div>
        </div>
    {{-- </main> --}}

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script>
        paypal.Buttons({
            style: {
            layout: 'horizontal',
            color: 'gold',
            label: 'pay'
        },
            // Sets up the transaction when a payment button is clicked
            createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                amount: {
                    // value: '{{ Session::get("total") / 50 }}',
                    currency: 'PHP',
                    value: '{{ Session::get("total")}}',

                }
                }]
            });
            },

            // Finalize the transaction after payer approval
            onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
                // Successful capture! For dev/demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    // alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
                    swal({
                                title: "Please wait...",
                                buttons: false,
                                // timer: 2000,
                                closeOnClickOutside: false,
                            });

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var fname = $('.fname').val();
                    var lname = $('.lname').val();
                    var phone = $('.phone_no').val();
                    var address = $('.address').val();
                    var barangay = $('.barangay').val();
                    var city = $('.city').val();
                    var postal_code = $('.postal_code').val();
                    var country = $('.country').val();
                    $.ajax({
                        method: "POST",
                        url: "place-order-via-paypal",
                        data: {
                            'fname':fname,
                            'lname':lname,
                            'phone':phone,
                            'address':address,
                            'barangay':barangay,
                            'city':city,
                            'postal_code':postal_code,
                            'country':country,
                            'payment_method':"Paypal",
                        },
                        success: function (response)
                        {

                            swal({
                                    title: response.status,
                                    icon: "success"
                                }).then(function() {
                                        window.location.href='/';
                            });
                        }
                    });
            });
            }

        }).render('#paypal-button-container');
    </script>
@endsection
