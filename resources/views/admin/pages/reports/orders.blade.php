@extends('layouts.admin-front')
@section('title')
   Admin | Reports | Orders
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Orders Report</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Orders Report</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@section('scripts')

<!-- Custom Script -->
@if(session('alert'))
        <script>
             swal(" ",{
                  title: "{{ session('alert') }}"+' '+"{{ Auth::user()->user_type }}",
                  icon: 'success',
                  buttons: false,
                  timer: 2000,
                  closeOnClickOutside: false,
                  });
        </script>
    @endif
    <!-- jQuery -->
<script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI -->
<script src="{{ asset('assets/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
@endsection
@endsection
