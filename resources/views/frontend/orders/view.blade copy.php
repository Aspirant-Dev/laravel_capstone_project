@extends('layouts.front')

@section('title')
    My Purchases
@endsection

@section('content')
<div class="py-3 mb-4 bg-light shadow-sm">
    <div class="container">
        <h6 class="mb-0"><a href="{{ url('/') }}">Home</a> / <a href="{{ url('my-purchases') }}">My Purchases</a> / Purchases View</h6>
    </div>
</div>
    <div class="container py-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow" style="border-radius: 0px;">
                    <div class="card-header">
                        <h4 class="text-center"><a href="{{ url('my-purchases') }}" class="btn btn-primary float-start">Back</a>Purchased View (Order #{{ $orders->tracking_no }})</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">First Name</label>
                                <div class="border p-2 fw-bold">{{ $orders->fname }}</div>

                                <label for="">Last Name</label>
                                <div class="border p-2 fw-bold">{{ $orders->lname }}</div>

                                <label for="">Email</label>
                                <div class="border p-2 fw-bold">{{ $orders->email }}</div>

                                <label for="">Contact No.</label>
                                <div class="border p-2 fw-bold">{{ $orders->phone_no }}</div>

                                <label for="">Shipping Address</label>
                                <div class="border p-2 fw-bold">{{ $orders->address.', '.$orders->barangay.', '.$orders->city.', '.$orders->postal_code }}</div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-head-fixed table-striped">
                                        <thead>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Qty.</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Total</th>
                                            @if($orders->status == '3')
                                                <th class="text-center">Action</th>
                                            @endif
                                        </thead>
                                        <tbody>
                                            @foreach ($orders->orderItems as $item )
                                                <tr class="text-center">
                                                    <td><img src="{{ asset('uploads/products/'.$item->products->image) }}" alt="..." height="50px" width="50px"></td>
                                                    <td>{{ $item->products->name }}</td>
                                                    <td><small class="text-muted" style="font-style: italic">x</small>{{ $item->qty }}</td>
                                                    <td>&#8369;{{ number_format($item->price,2) }}</td>
                                                    <td>&#8369;{{ number_format($item->price * $item->qty ,2) }}</td>
                                                        @php

                                                            $now = \Carbon\Carbon::now();
                                                            $startDate = \Carbon\Carbon::parse($orders->completed_at)->format('d.m.Y h:m:sa');
                                                            $endDate = \Carbon\Carbon::parse($orders->completed_at)->addDays(3)->format('d.m.Y h:m:sa');

                                                            // if ($now->between($startDate, $endDate)) {
                                                            //     return 'Date is Active';
                                                            // } else {
                                                            //     return 'Date is Expired';
                                                            // }
                                                        @endphp
                                                    @if($orders->status == '3')
                                                        @if($item->products->returnable != 0)
                                                            @if($now->between($startDate, $endDate))
                                                                <td>
                                                                    @if($item->status == 0)
                                                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#requestModal{{ $item->id }}">
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

                                                                    <!-- Modal Return Product -->
                                                                    <div class="modal fade"  id="requestModal{{ $item->id }}" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                                                            <div class="modal-content" style="border-radius: 0px!important;">
                                                                                <div class="modal-header text-center">
                                                                                    <h5 class="modal-title w-100" id="requestModalLabel" style="color: #ee4d2d">Return Product ({{ $item->products->name }})</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <form class="needs-validation" novalidate action="{{ url('return-order-id-'.$item->order_id.'/order-item-'.$item->id) }}" method="POST" enctype="multipart/form-data">
                                                                                    {{ csrf_field() }}
                                                                                    <div class="modal-body ">
                                                                                        <select name="reason" class="form-select" required>
                                                                                            <option value="" hidden selected>Please select a reason here...</option>
                                                                                            <option value="Incorrect Product Received">Incorrect Product Received</option>
                                                                                            <option value="Duplicate Item">Duplicate Item</option>
                                                                                            <option value="Received a product with physical damage">Received a product with physical damage</option>
                                                                                            <option value="Received a malfunction product (does not work as intended)">Received a malfunction product (does not work as intended)</option>
                                                                                        </select>
                                                                                        <div class="invalid-feedback text-start fw-bold">Please select reason in the list.</div>
                                                                                        <br>
                                                                                        <select name="quantity" class="form-select" required>
                                                                                            <option value="" hidden selected>Please select quantity here...</option>
                                                                                            @php
                                                                                                for($i=1; $i<=$item->qty; $i++)
                                                                                                echo "<option value=".$i.">".$i."</option>";
                                                                                            @endphp
                                                                                        </select>
                                                                                        <div class="invalid-feedback text-start fw-bold">Please select quantity in the list.</div>

                                                                                        <div class="mt-3">
                                                                                            <p for="formFile" class="text-start">Upload product image.</p>
                                                                                            <input type="file" class="form-control mt-0" accept="image/png, image/gif, image/jpeg" required  name="prod_image" id="formFile">

                                                                                        <div class="invalid-feedback text-start fw-bold">Please upload image for proof. Thank you!</div>
                                                                                        </div>
                                                                                        <div class="mt-3">
                                                                                            <p for="formFile" class="text-start">Upload receipt image.</p>
                                                                                            <input type="file" class="form-control mt-0" accept="image/png, image/gif, image/jpeg" required  name="receipt_image" id="formFile">

                                                                                        <div class="invalid-feedback text-start fw-bold">Please upload your receipt image.</div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            @else
                                                                    <td>
                                                                        <a  type="button" class="btn btn-info btn-sm">
                                                                            Return date expired
                                                                        </a>
                                                                    </td>
                                                            @endif
                                                            @else
                                                                <td>
                                                                    <a  type="button" class="btn disabled btn-warning btn-sm">
                                                                        Cannot be Return
                                                                    </a>
                                                                </td>
                                                            @endif
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <h1 ><span class="float-Start"> Grand Total:</span> <span class="float-end" style="color:#fb5533">&#8369;{{ number_format($orders->total_price,2) }}</span> </h1>
                                <h3>
                                    <span class="float-Start"> Order Status:</span> <span class="float-end" style="color:#fb5533">
                                        @if ($orders->status == '0')
                                        <span class="badge bg-info text-dark">Pending</span>
                                        @elseif ($orders->status == '1')
                                        Processing Orders
                                        @elseif ($orders->status == '2')
                                        For Delivery
                                        @elseif ($orders->status == '3')
                                        <span class="badge bg-success">Delivered</span>
                                        @elseif ($orders->status == '4')
                                        <span class="badge bg-danger">Cancelled</span>
                                        @elseif ($orders->status == '5')
                                        <span class="badge bg-danger">Returned</span>
                                        @else
                                        <span class="badge bg-warning text-dark">Request Order Cancellation</span>
                                        @endif
                                    </span>
                                </h3>
                                @if  ($orders->status == '3')
                                    <h3>
                                        <span class="float-Start"> Date Delivered:</span> <span class="float-end" style="color:#fb5533">
                                            <span class="badge bg-success">{{ date('F d, Y', strtotime($orders->completed_at)) }}</span>
                                        </span>
                                    </h3>
                                @endif
                                @if($orders->status == 0 && $orders->payment_method == 'COD')
                                <button type="button" class="btn btn-warning float-right" data-bs-toggle="modal" data-bs-target="#requestModal">
                                    Cancel My Order
                                </button>
                                <!-- Modal Cancel Order -->
                                <div class="modal fade"  id="requestModal" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                        <div class="modal-content" style="border-radius: 0px!important;">
                                            <div class="modal-header text-center">
                                                <h5 class="modal-title w-100" id="requestModalLabel" style="color: #ee4d2d">Order Cancellation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ url('update-order/'.$orders->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body text-center">
                                                    <div class="mb-3 mt-3">
                                                        <input type="hidden" value="{{ $orders->id }}">
                                                        <label class="form-label">
                                                            <strong><center>Are you sure you want to delete this order?</center></strong>
                                                        </label>
                                                        <p class="text-muted">Once cancelled, you cannot recovered this order.</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    @section('scripts')
    @if(Session::has('errors'))
    <script>
        $(document).ready(function(){
            $('#exampleModal').modal('show');
        });
    </script>
    @endif
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
    @endsection
@endsection
