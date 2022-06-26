@extends('layouts.front')

@section('title','My Adresses')
<head>
    <style>
        @media screen and (max-width: 376px) {
            .response2 {
                font-size: 18px!important;
            }
        }
        @media screen and (max-width: 320px) {
            .response {
                font-size: 12px;
            }
            .response2 {
                font-size: 12px!important;
            }
        }
    </style>
</head>
@section('content')
<div class="py-3 mb-4 bg-light shadow-sm">
    <div class="container">
        <h6 class="mb-0"><a href="{{ url('/') }}">Home</a> / My Profile / My Addresses</h6>
    </div>
</div>
    <!-- Page Content-->
    <div class="container-fluid px-4 px-lg-5">

        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="card shadow" style="border-radius: 0px">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><i class="fas fa-user"></i> My Account
                                <div class="ms-3 ">
                                    <a href="{{ url('my-profile') }}" class="nav-link text-dark"> Profile</a>
                                </div>
                                <div class="ms-3">
                                    <a href="{{ url('my-address') }}" class="nav-link active" style="margin-top: -10px"> Addresses</a>
                                </div>
                            </li>
                            <li class="list-group-item"><i class="fas fa-store"></i> <a href="{{ url('/my-purchases') }}"> My Purchases</a>
                            </li>
                            <li class="list-group-item" ><i class="fas fa-shopping-bag"></i> <a href="{{ url('/cart') }}"> My Cart (<span class="fw-bold cart-count" style="color: #ee4d2d"></span>)</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="col-md-9">
                    <div class="card shadow"style="border-radius: 0px!important;">
                        <div class="card-body">
                            <h4 class="d-flex justify-content-between align-items-center response2">
                                <span style="color:#ee4d2d; font-style: 14px;">
                                    Edit My Addresses
                                </span>
                                <div class="response2">
                                    <a href="{{ url('my-address') }}" style="cursor: pointer; color:#003a5c; font-size: 14px!important;"><i class="fas fa-undo-alt"></i> Back</a>
                                </div>
                            </h4>
                            <hr style="background-color: #ee4d2d">

                            <form action="{{ url('update-address/'.$address['id']) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <!-- First Name && Last Name -->
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="email" value="{{ Auth::user()->email }}">

                                        <label for="fname" class="col-md-6 col-form-label">{{ __('First Name') }}</label>
                                        <input id="fname"  placeholder="Ex. Juan" type="text"  class="form-control @error('fname') is-invalid @enderror"
                                        name="fname"
                                        @if(isset($address['fname']))
                                        value="{{ $address['fname'] }}"
                                        @else
                                        value="{{ old('fname') }}"
                                        @endif   autocomplete="off">

                                        @error('fname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ ('First name is required') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lname" class="col-md-6 col-form-label">{{ __('Last Name') }}</label>
                                        <input id="lname" placeholder="Ex. Dela Cruz" type="text" class="form-control @error('lname') is-invalid @enderror"
                                        name="lname" value="{{ $address['lname'] }}"  autocomplete="off" >
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
                                        <label for="contact-no" class="col-form-label">{{ __('Contact No.') }}<small style="font-style: italic"> (09xx-xxx-xxxx)</small></label>
                                        <input id="contact-no"  placeholder="Enter you contact no." type="tel" pattern="[0]{1}[9]{1}[0-9]{2}-[0-9]{3}-[0-9]{4}" id="contact-no" type="text"
                                        class="form-control @error('phone_no') is-invalid @enderror"
                                        name="phone_no" value="{{ $address['phone_no'] }}"  autocomplete="off">

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
                                    <p style="font-style:italic; margin-top: 2px; margin-bottom: -2px"><small><b>Note: </b>Please select first the city to choose barangay and the postal code will auto filled.</small></p>
                                    <div class="col-md-4">
                                        <label for="city" class=" col-form-label">{{ __('City') }}</label>
                                        <select id="options" class="custom-select form-control @error('city') is-invalid @enderror"  name="city">
                                            <option value="" disabled hidden selected>Please select...</option>
                                            <option value="Bocaue">Bocaue</option>
                                            <option value="Marilao">Marilao</option>
                                            <option value="Meycauayan">Meycauayan</option>
                                        </select>
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ ('Please select a city in the list') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="barangay" class=" col-form-label">{{ __('Barangay') }}</label>
                                        <select id="choices" class="custom-select form-control @error('barangay') is-invalid @enderror" name="barangay">
                                            <option value="" disabled hidden selected>Please select...</option>
                                        </select>
                                        @error('barangay')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ ('Please select a barangay in the list') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="postal-code" class=" col-form-label">{{ __('Postal Code') }}</label>
                                        <select id="pc" class=" form-control @error('postal_code') is-invalid @enderror" name="postal_code">
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
                                        <input id="detailed-address" placeholder="Set Detailed Address" type="text" class="form-control @error('detailed_address') is-invalid @enderror" name="detailed_address" value="{{ old('detailed_address') }}"  autocomplete="off" >
                                        @error('detailed_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ ('Please set your detailed address') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <div class="container">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
<script src="{{ asset('assets/js/auto-select.js') }}"></script>
@endsection
@endsection
