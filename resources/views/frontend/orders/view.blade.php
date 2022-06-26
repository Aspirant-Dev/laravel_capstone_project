@extends('new-frontend.layouts.front')
@section('title')
    View Order {{ $orders->tracking_no }}
@endsection
@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-nav bg-white">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.all.orders') }}">My Orders</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Order</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content " style="margin-top: -40px">
        <div class="checkout">
            <div class="container-fluid py-4 pb-5">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="summary bg-white shadow-sm"  style="border: .14rem solid #d7d7d7; border-radius: 0px;">
                                <h2 class="checkout-title">Shipping Details</h2><!-- End .checkout-title -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>First Name </label>
                                        <input type="text" readonly style="color: black; font-weight: 500" value="{{ $orders->fname }}" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Last Name </label>
                                        <input type="text" readonly style="color: black; font-weight: 500" value="{{ $orders->lname }}" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->
                                <label>Email address </label>
                                <input type="email" class="form-control" value="{{ $orders->email }} " readonly style="color: black; font-weight: 500" required>

                                <label>Detailed address </label>
                                <input type="text" readonly style="color: black; font-weight: 500" value="{{ $orders->address }}" class="form-control" placeholder="House number and Street name" required>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Barangay </label>
                                        <input type="text" readonly style="color: black; font-weight: 500" value="{{ $orders->barangay }}" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>City </label>
                                        <input type="text" readonly style="color: black; font-weight: 500" value="{{ $orders->city }}" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>ZIP </label>
                                        <input type="text" readonly style="color: black; font-weight: 500" value="{{ $orders->postal_code }}" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Phone </label>
                                        <input type="tel" class="form-control" readonly style="color: black; font-weight: 500" value="{{ $orders->phone_no }}" required>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->
                                <label>Paid via </label>
                                <input type="text" readonly style="color: black; font-weight: 500" value="@if($orders->payment_method == 'COD')Cash on Delivery @else {{ $orders->payment_method }}@endif" class="form-control" required>

                            </div><!-- End .col-lg-9 -->
                        </div>
                        <aside class="col-lg-7">
                            <div class="summary bg-white shadow-sm" style="border: .14rem solid #d7d7d7; border-radius: 0px;">
                                <h3 class="summary-title text-center" style="font-size: 24px;">Your Ordered Item(s)</h3><!-- End .summary-title -->

                                <table class="table table-hover table-mobile">
                                    <thead class="text-center">
                                        <th><h6>Image</h6></th>
                                        <th><h6>Name</h6></th>
                                        <th><h6>Qty.</h6></th>
                                        <th><h6>Price</h6></th>
                                        <th><h6>Total</h6></th>
                                        @if($orders->status == '3')
                                            <th><h6>Action</h6></th>
                                        @endif
                                    </thead>
                                    <tbody>
                                        @foreach ($orders->orderItems as $item )
                                            <tr class="text-center " style="border: solid rgb(230, 229, 229);border-width: 2px!important;">
                                                <td><img class="mr-auto mx-auto d-block" src="{{ asset('uploads/products/'.$item->products->image) }}" alt="..." height="100px" width="100px"></td>
                                                <td style="font-weight: 500;"><a style="cursor: pointer" onclick="window.location.href='{{ url('category/'.$item->products->category->slug.'/'.$item->products->slug) }}';" >{{ $item->products->name }}</a></td>
                                                <td><small class="text-muted" style="font-style: italic">x</small>{{ $item->qty }}</td>
                                                <td>&#8369; {{ number_format($item->price,2) }}</td>
                                                <td>&#8369; {{ number_format($item->price * $item->qty ,2) }}</td>
                                                @php
                                                    $now = \Carbon\Carbon::now();
                                                    $startDate = \Carbon\Carbon::parse($orders->completed_at)->format('d.m.Y h:m:sa');
                                                    $endDate = \Carbon\Carbon::parse($orders->completed_at)->addDays(3)->format('d.m.Y h:m:sa');
                                                @endphp
                                                @if($orders->status == '3')
                                                    @if($item->products->returnable != 0)
                                                        @if($now->between($startDate, $endDate))
                                                            <td>
                                                                @if($item->status == 0)
                                                                    <button type="button" class="btn btn-warning btn-sm" href="#returnModal{{ $item->id }}" data-toggle="modal">
                                                                        Return
                                                                    </button>
                                                                @elseif($item->status == 1)
                                                                    <button onclick="already();" type="button" class="btn btn-warning btn-sm" >
                                                                        Return already requested
                                                                    </button>
                                                                @elseif($item->status == 2)
                                                                    <button onclick="approved();" type="button" class="btn btn-warning btn-sm" >
                                                                        Approved Request
                                                                    </button>
                                                                @elseif($item->status == 4)
                                                                    <button type="button" class="btn btn-warning btn-sm" >
                                                                        Not Approved
                                                                    </button>
                                                                @else
                                                                    <span class="badge bg-info text-dark" style="font-size: 14px; border-radius: 0px; padding: 12px;">Returned
                                                                        <br> ({{ $returnedItem->quantity }} items returned)
                                                                    </span>
                                                                @endif
                                                            </td>
                                                            <!-- Modal Return Product -->
                                                            <div class="modal fade" id="returnModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true"><i class="icon-close"></i></span>
                                                                            </button>

                                                                            <div class="form-box">
                                                                                <div class="form-tab">
                                                                                    <ul class="nav nav-pills nav-fill" role="tablist">
                                                                                        <li class="nav-item">
                                                                                            <a class="nav-link active" id="address-tab" data-toggle="tab" href="#new-address" role="tab" aria-controls="new-address" aria-selected="true">Return Product ({{ $item->products->name }})</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                    <div class="tab-content" id="tab-content-5">
                                                                                        <div class="tab-pane fade show active" id="new-address" role="tabpanel" aria-labelledby="address-tab">
                                                                                            <form  action="{{ url('return-order-id-'.$item->order_id.'/order-item-'.$item->id) }}" method="POST" enctype="multipart/form-data">
                                                                                                {{ csrf_field() }}
                                                                                                <div class="form-group row">
                                                                                                    <div class="col-md-12">
                                                                                                        <label for="reason" class=" col-form-label" style="font-weight: 500;">{{ __('Select Reason *') }}</label>
                                                                                                        <select id="reason" required class="custom-select form-control @error('reason') is-invalid @enderror"  name="reason">
                                                                                                            <option value="" hidden selected>Please select a reason here...</option>
                                                                                                            <option value="Incorrect Product Received">Incorrect Product Received</option>
                                                                                                            <option value="Duplicate Item">Duplicate Item</option>
                                                                                                            <option value="Received a product with physical damage">Received a product with physical damage</option>
                                                                                                            <option value="Received a malfunction product (does not work as intended)">Received a malfunction product (does not work as intended)</option>
                                                                                                        </select>

                                                                                                        <div class="invalid-feedback text-start fw-bold">Please select a city from the list.</div>
                                                                                                        @error('reason')
                                                                                                            <span class="invalid-feedback" role="alert">
                                                                                                                <strong>{{ $message }}</strong>
                                                                                                            </span>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row">
                                                                                                    <div class="col-md-12">
                                                                                                        <label for="quantity" class=" col-form-label" style="font-weight: 500;">{{ __('Select Quantity *') }}</label>
                                                                                                        <select id="quantity" required class="custom-select form-control @error('quantity') is-invalid @enderror"  name="quantity">
                                                                                                            <option value="" hidden selected>Please select a quantity here...</option>
                                                                                                            @php
                                                                                                                for($i=1; $i<=$item->qty; $i++)
                                                                                                                echo "<option value=".$i.">".$i."</option>";
                                                                                                            @endphp
                                                                                                        </select>

                                                                                                        <div class="invalid-feedback text-start fw-bold">Please select a city from the list.</div>
                                                                                                        @error('quantity')
                                                                                                            <span class="invalid-feedback" role="alert">
                                                                                                                <strong>{{ $message }}</strong>
                                                                                                            </span>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="form-group row">
                                                                                                    <div class="col-md-12">
                                                                                                        <label for="prod-image" class="col-form-label" style="font-weight: 500;">{{ __('Upload product image *') }}</label>
                                                                                                        <input  id="prod-image" type="file" class="form-control border" accept="image/png, image/gif, image/jpeg" required  name="prod_image" autocomplete="off" >
                                                                                                        <div class="invalid-feedback text-start fw-bold">This field is required.</div>
                                                                                                        @error('detailed_reason')
                                                                                                            <span class="invalid-feedback" role="alert">
                                                                                                                <strong>{{ $message }}</strong>
                                                                                                            </span>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row">
                                                                                                    <div class="col-md-12">
                                                                                                        <label for="receipt-image" class="col-form-label" style="font-weight: 500;">{{ __('Upload receipt image *') }}</label>
                                                                                                        <input  id="receipt-image" type="file" class="form-control border" accept="image/png, image/gif, image/jpeg" required  name="receipt_image" autocomplete="off" >
                                                                                                        <div class="invalid-feedback text-start fw-bold">This field is required.</div>
                                                                                                        @error('detailed_reason')
                                                                                                            <span class="invalid-feedback" role="alert">
                                                                                                                <strong>{{ $message }}</strong>
                                                                                                            </span>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group row">
                                                                                                    <div class="col-md-12">
                                                                                                        <label for="detailed-reason" class="col-form-label" style="font-weight: 500;">{{ __('Detailed reason *') }}</label>
                                                                                                        <textarea class="form-control @error('detailed_reason') is-invalid @enderror" cols="30" rows="2" id="detailed-reason"  name="detailed_reason" maxlength="255" placeholder="Set Detailed Reason *" required autocomplete="off"></textarea>

                                                                                                        <div class="invalid-feedback text-start fw-bold">This field is required.</div>
                                                                                                        @error('detailed_reason')
                                                                                                            <span class="invalid-feedback" role="alert">
                                                                                                                <strong>{{ $message }}</strong>
                                                                                                            </span>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="form-footer" style="margin-top: -30px;">
                                                                                                </div><!-- End .form-footer -->

                                                                                                <div class="form-choice">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-12 ">
                                                                                                            <div class="d-flex justify-content-between align-items-center">
                                                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                                                                                                                    <i class="icon-close"></i>
                                                                                                                    Close
                                                                                                                </button>
                                                                                                                <button type="submit" class="btn btn-success">
                                                                                                                    Submit
                                                                                                                    <i class="icon-arrow-right"></i>
                                                                                                                </button>
                                                                                                            </div>
                                                                                                        </div><!-- End .col-6 -->
                                                                                                    </div><!-- End .row -->
                                                                                                </div><!-- End .form-choice -->
                                                                                            </form>
                                                                                        </div><!-- .End .tab-pane -->
                                                                                    </div><!-- End .tab-content -->
                                                                                </div><!-- End .form-tab -->
                                                                            </div><!-- End .form-box -->
                                                                        </div><!-- End .modal-body -->
                                                                    </div><!-- End .modal-content -->
                                                                </div><!-- End .modal-dialog -->
                                                            </div>
                                                        @else
                                                            <td>
                                                                <a  type="button" onclick="expiredDate();" class="btn btn-info btn-sm">
                                                                    Return date expired
                                                                </a>
                                                            </td>
                                                        @endif
                                                    @else
                                                        <td>
                                                            <a type="button" class="btn disabled btn-warning btn-sm">
                                                                Cannot be Return
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endif
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <h3 class="summary-title text-center" style="font-size: 24px; margin-top: -40px"></h3><!-- End .summary-title -->
                                <div class="d-flex">
                                    <div class="mr-auto p-2"><h3>Grand Total</h3></div>
                                    <div class="p-2"><h3>&#8369; {{ number_format($orders->total_price,2) }}</h3></div>
                                </div>
                                <div class="d-flex">
                                    <div class="mr-auto p-2"><h4>Order Status:</h4></div>
                                    <div class="p-2">
                                        <h3>
                                            @if ($orders->status == '0')
                                        <span class="badge bg-primary text-white">Pending</span>
                                        @elseif ($orders->status == '1')

                                        <span class="badge bg-info text-dark">Processing Orders</span>
                                        @elseif ($orders->status == '2')

                                        <span class="badge bg-warning text-dark">For Delivery</span>
                                        @elseif ($orders->status == '3')
                                        <span class="badge bg-success">Delivered</span>
                                        @elseif ($orders->status == '4')
                                            @if ($orders->reason == NULL)
                                                <span class="badge bg-danger text-white">You cancelled this order.</span>
                                            @else
                                                <span class="badge bg-danger text-white">Order has been cancelled.</span>
                                            @endif
                                        @elseif ($orders->status == '5')
                                        <span class="badge bg-danger">Returned</span>
                                        @else
                                        <span class="badge bg-warning text-dark">Request Order Cancellation</span>
                                        @endif
                                        </h3>
                                    </div>
                                </div>
                                @if  ($orders->status == '3')
                                    <div class="d-flex">
                                        <div class="mr-auto p-2"><h4>Date Delivered:</h4></div>
                                        <div class="p-2">
                                            <h3>
                                                <span class="badge bg-info">{{ date('F d, Y', strtotime($orders->completed_at)) }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                @elseif  ($orders->status == '4' && $orders->reason != NULL)
                                    <div class="d-flex">
                                        <div class="mr-auto p-2"><h4>Reason:</h4></div>
                                        <div class="p-2">
                                            <h3>
                                                <span class="badge bg-info text-white">{{ $orders->reason }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                @endif
                                <div class="d-flex">
                                    <div class="mr-auto p-2">
                                        @if($orders->status == 0 && $orders->payment_method == 'COD')
                                            <a class="btn btn-warning float-right" href="#cancelModal" data-toggle="modal">
                                                Cancel My Order
                                            </a>
                                            <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true"><i class="icon-close"></i></span>
                                                            </button>

                                                            <div class="form-box">
                                                                <div class="form-tab">
                                                                    <ul class="nav nav-pills nav-fill" role="tablist">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link active" id="address-tab" data-toggle="tab" href="#new-address" role="tab" aria-controls="new-address" aria-selected="true">Cancel My Order</a>
                                                                        </li>
                                                                    </ul>
                                                                    <div class="tab-content" id="tab-content-5">
                                                                        <form action="{{ url('user-cancel-order/'.$orders->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="tab-pane fade show active" id="new-address" role="tabpanel" aria-labelledby="address-tab">
                                                                                <div class="modal-body text-center">
                                                                                    <div class="mb-3 mt-3">
                                                                                        <input type="hidden" value="{{ $orders->id }}" >
                                                                                        <h3>
                                                                                            <strong><center>Are you sure you want to delete this order?</center></strong>
                                                                                        </h3>
                                                                                        <h6 class="text-muted">Once cancelled, you cannot recovered this order.</h6>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                                                </div>
                                                                            </div><!-- .End .tab-pane -->
                                                                        </form>
                                                                    </div><!-- End .tab-content -->
                                                                </div><!-- End .form-tab -->
                                                            </div><!-- End .form-box -->
                                                        </div><!-- End .modal-body -->
                                                    </div><!-- End .modal-content -->
                                                </div><!-- End .modal-dialog -->
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div><!-- End .summary -->
                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .checkout -->
    </div><!-- End .page-content -->

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>


    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
            })
        })()
    </script>
    @if(session('request'))
        <script>
            swal("",{
                title: "{{ session('request') }}",
                text: 'Thank you for reaching out with us! We will process your request immediately.',
                icon: "success"
            });
        </script>
    @endif
    @if(session('not-found'))
        <script>
            swal("",{
                title: "{{ session('not-found') }}",
                icon: "error"
            });
        </script>
        @endif
    @if(session('alert-cancel'))
        <script>
            swal("",{
                title: "{{ session('alert-cancel') }}",
                icon: "success"
            });
        </script>
        @endif
        <script>
            // Put this script in header or above select element
    function check(elem) {
        // use one of possible conditions
        // if (elem.value == 'Other')
        if (elem.selectedIndex == 6) {
            document.getElementById("other-div").style.display = 'block';
        } else {
            document.getElementById("other-div").style.display = 'none';
        }
    }
        </script>
        <script>
            function already(){
                swal("",{
                title: "Your request is on the process.",
                icon: "info"
            });
            }
        </script>
        <script>
            function approved(){
                swal("",{
                title: "Your request for return item was approved.",
                text: "Please go to our store to change your item. Thankyou!",
                icon: "info"
            });
            }
        </script>
        <script>
            function expiredDate(){
                swal("",{
                title: "Return item is not allowed.",
                text: "You are allowed to return items within just three days after your order. Thankyou!",
                icon: "info"
            });
            }
        </script>

@endsection
