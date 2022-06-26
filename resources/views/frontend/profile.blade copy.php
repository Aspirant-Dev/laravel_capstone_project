@extends('layouts.front')

@section('title','My Profile')


@section('content')
<div class="py-3 mb-4 bg-light shadow-sm">
    <div class="container">
        <h6 class="mb-0"><a href="{{ url('/') }}">Home</a> / My Profile</h6>
    </div>
</div>
    <!-- Page Content-->
    <div class="container px-4 px-lg-5">
        <div class="container py-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-center">My Profile <a href="{{ url('/') }}" class="btn btn-primary float-end">Back</a></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label class="lbl">Usermame</label>
                                    <div class=" p-2 fw-bold border-bottom">{{ Auth::user()->username }}</div>
                                    <br/>
                                    <label class="lbl">First Name</label>
                                    <div>
                                        <input name="fname" class="form-control border p-2 fw-bold" value="{{ Auth::user()->fname }}">
                                    </div>
                                    <br/>
                                    <label class="lbl">Last Name</label>
                                    <div>
                                        <input name="lname" class="form-control border p-2 fw-bold" value="{{ Auth::user()->lname }}">
                                    </div>
                                    <br/>
                                    <label class="lbl">Email</label>
                                    <div class=" p-2 fw-bold border-bottom">{{ Auth::user()->email }}</div>
                                    <br/>
                                    <label class="lbl">Contact No.</label>
                                    <div>
                                        <input placeholder="09xx-xxx-xxxx" type="tel" pattern="[0]{1}[9]{1}[0-9]{2}-[0-9]{3}-[0-9]{4}" id="phone_no" type="text" class="form-control p-2 fw-bold" name="phone_no" value="{{ Auth::user()->phone_no }}" >
                                    </div>
                                    <br/>
                                    <label class="lbl">Shipping Address</label>
                                    <div>
                                        <input id="home_address" placeholder="House No/Street No., Barangay, City, Province" type="text" class="form-control p-2 fw-bold" name="home_address" value="{{ Auth::user()->home_address }}">
                                    </div>

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-warning">Update</button>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 text-center">
                                    <label class="fw-bold" for="">Verified Email?</label>


                                    @if(!Auth::user()->hasVerifiedEmail())
                                    <section class="py-3 bg-light mt-3">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>Your email is not verified. Please verify your email address.</h2>
                                                        <a style="color: blue !important" href="{{ route('verification.resend') }}">{{ __('Click here to request verification.') }}</a>
                                                    @if (session('resent'))
                                                        <div class="alert alert-success" role="alert">
                                                            {{ __('A fresh verification link has been sent to your email address.') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    @else

                                    <section class="py-3 bg-light mt-3">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2> Your email has been verified</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
</div>
@endsection
