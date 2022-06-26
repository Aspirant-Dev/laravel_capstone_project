<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ count($walkin) }}</h3>
                        <p>Walk-in Transactions</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-walking fa-2x text-gray-300"></i>
                    </div>
                    <a href="{{ url('/admin/walk-in-transactions') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>&#8369; {{ number_format($walkin_sales,2) }}</h3>
                        <p>Walk-In Total Sales</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <a href="{{ route('admin.cashier.transaction') }}" class="small-box-footer">View Transactions<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><span id="count-prods">{{ count($prods) }}</span></h3>
                        <p>Total Products</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-truck-loading fa-2x text-gray-300"></i>
                    </div>
                        <a href="{{ url('/admin/view-products') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><span id="count-crits">{{ count($crit_stocks) }}</span></h3>
                        <p>Critical Stocks</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-exclamation-circle fa-2x text-gray-300"></i>
                    </div>
                    <a href="{{ route('admin.cashier.view.critical-stocks') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{ asset('assets/js/sweetalert.js') }}"></script>

@if(session('info'))
    <script>
            swal(" ",{
                title: "{{ session('info') }}",
                icon: 'info',
                buttons: false,
                timer: 2000,
                closeOnClickOutside: false,
                });
    </script>
@endif
