@extends('new-frontend.layouts.front')

@section('title','My Address')
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- <style>
        @media  screen and (max-width: 376px) {
            .address_data {
                font-size: 12px!important;
            }
        }
        @media  screen and (max-width: 426px) {
            .address_data {
                font-size: 12px!important;
            }
        }
        @media  screen and (max-width: 320px) {
            .address_data {
                font-size: 10px!important;
            }
            .address_data {
                font-size: 12px!important;
            }
        }
    </style> --}}
</head>
@section('content')
{{-- <main class="main bg-light"> --}}
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3 bg-white">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.shop') }}">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                                    <a class="nav-link active" id="address-tab" data-toggle="tab" href="#new-address" role="tab" aria-controls="new-address" aria-selected="true">Add New Address</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="new-address" role="tabpanel" aria-labelledby="address-tab">
                                    <form method="POST" action="{{ route('delivery-address') }}">
                                        @csrf

                                        <!-- First Name && Last Name -->
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="email" value="{{ Auth::user()->email }}">

                                                <label for="fname" class="col-md-6 col-form-label">{{ __('First Name') }}</label>
                                                <input id="fname"  required placeholder="Ex. Juan" type="text"  class="form-control @error('fname') is-invalid @enderror"
                                                    name="fname" value="{{ old('fname') }}"  autocomplete="off">
                                                <div class="invalid-feedback text-start fw-bold">This field is required.</div>

                                                @error('fname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ ('First name is required') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lname" class="col-md-6 col-form-label">{{ __('Last Name') }}</label>
                                                <input id="lname" required placeholder="Ex. Dela Cruz" type="text" class="form-control @error('lname') is-invalid @enderror"
                                                name="lname" value="{{ old('lname') }}">
                                                <div class="invalid-feedback text-start fw-bold">This field is required.</div>
                                                @error('lname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ ('Last name is required') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Contact -->
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label class="col-form-label">{{ __('Contact No.') }}<small style="font-style: italic"> (09xx-xxx-xxxx)</small></label>
                                                <input required id="contact-no" placeholder="Enter you contact no." maxlength="13" type="tel" pattern="[0]{1}[9]{1}[0-9]{2}-[0-9]{3}-[0-9]{4}" title="Please follow the format."
                                                    class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}"  autocomplete="off"
                                                    oninvalid="setCustomValidity('Please follow the format')" oninput="try{setCustomValidity('')}catch(e){}">
                                                <div class="invalid-feedback text-start fw-bold">This field is required. Please follow the format.</div>

                                                @error('phone_no')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ ('Contact number is required') }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>
                                        <br>
                                        <!-- City -->
                                        <!-- Barangay -->
                                        <!-- Postal Code -->
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <p style="font-style:italic;"><small><b>Note: </b>Please select first the city to choose barangay and the postal code will auto filled.</small></p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="city" class=" col-form-label">{{ __('City') }}</label>
                                                <select id="options" required class="custom-select form-control @error('city') is-invalid @enderror"  name="city">
                                                    <option value="" disabled hidden selected>Please select...</option>
                                                    <option value="Bocaue">Bocaue</option>
                                                    <option value="Marilao">Marilao</option>
                                                    <option value="Meycauayan">Meycauayan</option>
                                                </select>

                                                <div class="invalid-feedback text-start fw-bold">Please select a city from the list.</div>
                                                @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ ('Please select a city in the list') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="barangay" class=" col-form-label">{{ __('Barangay') }}</label>
                                                <select id="choices" required class="custom-select form-control @error('barangay') is-invalid @enderror" name="barangay">
                                                    <option value="" disabled selected>Please select city...</option>
                                                </select>
                                                @error('barangay')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ ('Please select a barangay in the list') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="postal-code" style="display: none" class=" col-form-label">{{ __('Postal Code') }}</label>
                                                <select id="pc" required style="display: none" class=" form-control @error('postal_code') is-invalid @enderror" name="postal_code">
                                                    <option value="" disabled hidden selected></option>
                                                </select>
                                                @error('postal_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ ('Postal code is required') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Detailed Address -->
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="detailed-address" class="col-form-label">{{ __('Detailed Adress') }}</label>
                                                <p style="margin-top: -8px; margin-bottom: 10px"><small>Unit number, house number, building, street name</small></p>
                                                <input id="detailed-address" required placeholder="Set Detailed Address" type="text" class="form-control @error('detailed_address') is-invalid @enderror" name="detailed_address" value="{{ old('detailed_address') }}"  autocomplete="off" >

                                                <div class="invalid-feedback text-start fw-bold">This field is required.</div>
                                                @error('detailed_address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ ('Please set your detailed address') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-footer">
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

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    @include('new-frontend.layouts.inc.aside')
                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-address" role="tabpanel" aria-labelledby="tab-address-link">
                                <p class="text-dark">The following addresses will be used on the checkout page.</p>

                                <div class="row ">
                                    <div class="col-lg-12">
                                        <div class="card card-dashboard bg-white shadow-sm" style="border:1px solid rgb(184, 184, 184);">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                        <h4 class="mr-auto p-2">Shipping Address</h4>
                                                        <a class="p-2" href="#exampleModal" data-toggle="modal"><i class="icon-plus"></i> Add</a>
                                                </div><!-- End .card-title -->
                                                @if($deliveryAdresses->count() > 0)
                                                <div class="row">
                                                    <div class="col-lg-12" style="width: 100%">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-mobile">
                                                                <thead>
                                                                    <th width="20%" class="text-center text-muted response">Name</th>
                                                                    <th width="15%" class="text-center text-muted response">Phone</th>
                                                                    <th width="30%" class="text-center text-muted response">Address</th>
                                                                    <th width="15%" class="text-center text-muted response">Action</th>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($deliveryAdresses as $address)
                                                                    <tr class="address_data">
                                                                        <td class="text-center">
                                                                            <input type="hidden" value="{{ $address['id'] }}" class="address_id">
                                                                            {{ $address['fname'].' '.$address['lname']  }}
                                                                        </td>
                                                                        <td class="text-center">{{ $address['phone_no']  }}</td>
                                                                        <td class="text-center">{{ $address['detailed_address'].', '.$address['barangay'].', '.$address['city'].', '.$address['postal_code'] }}</td>
                                                                        <td class="text-center">
                                                                            <a href="{{ url('edit-my-address/'.$address['id']) }}"><span style="cursor: pointer; border-bottom: 1px solid #0d6efd">Edit</span></a>
                                                                            <a class="delete-address" ><span style="cursor: pointer; border-bottom: 1px solid #fd0d0d">Delete</span></a>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="d-flex">
                                                        <div class="mr-auto p-2"></div>
                                                        <div class="p-2">
                                                            {{ $deliveryAdresses->links() }}
                                                        </div>
                                                    </div>
                                                @else
                                                    <p>You have not set up shipping address yet.</p>
                                                @endif
                                            </div><!-- End .card-body -->
                                        </div><!-- End .card-dashboard -->
                                    </div><!-- End .col-lg-6 -->
                                </div><!-- End .row -->
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
{{-- </main><!-- End .main --> --}}


<!-- JQuery CDN-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
<script>
    var tele = document.querySelector('#contact-no');

    tele.addEventListener('keyup', function(e){
    if (event.key != 'Backspace' && (tele.value.length === 4 || tele.value.length === 8)){
    tele.value += '-';
    }
    });

</script>

<script src="{{ asset('assets/js/custom.js') }}"></script>

<script src="{{ asset('assets/js/auto-select.js') }}"></script>

@if(session('success'))
<script>
    swal("",{
        title: "{{ session('success') }}",
        icon: "success"
    });
</script>
@endif
@if(session('alert'))
<script>
    swal("",{
        title: "{{ session('alert') }}",
        icon: "success"
    });
</script>
@endif
@endsection
