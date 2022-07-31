@php
use Illuminate\Support\Facades\DB;
use App\Order;
$order = Order::where('status','<','1')->where('payment_method','COD')->orderBy('id','DESC')->get();
$orderOnlinePayment = Order::where('status','1')->where('payment_method','!=','COD')->orderBy('id','DESC')->get();
@endphp
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>
                            <span id="mycount">{{ count($orders) }} </span>
                            <span style="font-size: 15px">COD</span> |
                            <span id="mycountOP">{{ count($orderOnlinePayment) }} </span>
                            <span style="font-size: 15px">Online Payment</span></h3>
                        <p>New Orders </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ url('/admin/view-orders') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ count($prods_active) }} <span style="font-size: 15px">Active</span> | {{ count($prods_inactive) }} <span style="font-size: 15px">Inactive</span></h3>
                        <p>Total Products (<b>{{ count($prods) }}</b>)</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-truck-loading fa-2x text-gray-300"></i>
                    </div>
                        <a href="{{ url('/admin/products') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><span id="users-count">{{ count($count) }}</span></h3>
                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ url('/admin/customers') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                    <a href="{{ url('/admin/products/critical-stocks') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-6 mt-3">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3> <span id="completed">{{ count($completed) }}</span></h3>
                        <p>Completed Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <a href="{{ url('/admin/view-orders/delivered') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mt-3">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>&#8369; <span id="onsales">{{ number_format($orders_sales,2) }}</span></h3>
                        <p>Online Total Sales</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <a href="{{ url('/admin/reports/online-sales') }}" class="small-box-footer">View Report <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mt-3">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><span id="walk">{{ count($walkin) }}</span></h3>
                        <p>Walk-in Transactions</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-walking fa-2x text-gray-300"></i>
                    </div>
                    <a href="{{ url('/admin/view-walkin-orders') }}" class="small-box-footer">View Report <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mt-3">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>&#8369; <span id="walk-sales">{{ number_format($walkin_sales,2) }}</span></h3>
                        <p>Walk-in Total Sales</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <a href="{{ route('admin.reports.walkin.sales') }}" class="small-box-footer">View Report <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-xl-6 col-md-12">
            <div class="card card-warning" style="border-radius: 0px!important">
                <div class="card-header">
                <h3 class="card-title"> COD Latest Orders </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Order Date</th>
                            <th >Tracking Number</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    {{-- <tfoot>
                        <tr>
                            <th>Order Date</th>
                            <th >Tracking Number</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </tfoot> --}}
                </table>
                </div>
                <div class="card-footer clearfix">
                    <a href="{{ url('/admin/view-orders') }}" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                  </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12">
            <div class="card card-success" style="border-radius: 0px!important">
                <div class="card-header">
                <h3 class="card-title">Online Payment Latest Orders </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                </div>
                <div class="card-body">
                    <table id="example3" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Order Date</th>
                            <th>Tracking Number</th>
                            <th>Total Price</th>
                            <th>Payment Method</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
                </div>
                <div class="card-footer clearfix">
                    <a href="{{ url('/admin/view-orders') }}" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                  </div>
            </div>
        </div>
    </div>
    </div>
</section>
<script>
    $(document).ready(function () {

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "lengthMenu": [ 5, 10, 20, 50, 100, 200, 500],
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
            "emptyTable": "No orders available in table"
            },
            "serverSide":true,

            "ajax": '{{ route('admin.data') }}',
            "columns": [
                { mData: 'created_at'},
                { data: 'tracking_no', name: 'tracking_no' },
                { mData: 'total_price',  render: function ( data, type, row ) {
                    return "₱ " + data.toFixed(2);
                    }
                },
                { data: 'id', name: 'id', render:function(data, type, row){
                    return "<a class='btn btn-primary btn-sm' href='/admin/view-update-order/"+ row.id +"'>View</a>"
                    // return "<a href='/admin/view-update-order/'"+ row.id +">" + View+ "</a>"
                }},
            ]
        });

        $('#example3').DataTable({
            "paging": true,
            "lengthChange": true,
            "lengthMenu": [ 5, 10, 20, 50, 100, 200, 500],
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
            "emptyTable": "No orders available in table"
            },
            "serverSide":true,
            "ajax": '{{ route('admin.data-op') }}',
            "columns": [
                { mData: 'created_at'},
                { data: 'tracking_no', name: 'tracking_no' },
                { mData: 'total_price',  render: function ( data, type, row ) {
                    return "₱ " + data.toFixed(2);
                    }
                },
                { mData: 'payment_method'},
                { data: 'id', name: 'id', render:function(data, type, row){
                    return "<a class='btn btn-primary btn-sm' href='/admin/view-update-order/"+ row.id +"'>View</a> <button class='btn btn-danger btn-sm' onclick='deleteItem("+row.id+")'>Delete</button>"
                    // return "<a href='/admin/view-update-order/'"+ row.id +">" + View+ "</a>"
                }},
            ]
        });


        // count completed orders
        function getCompleted() {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.count.completed') }}"
            })
            .done(function( data ) {
            $('#completed').html(data);
        });
        }
        // count online sales
        function getOnSales() {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.count.onsales') }}"
            })
            .done(function( data ) {
            $('#onsales').html(data);
        });
        }

        // count walk-in sales
        function getWalk() {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.count.walk') }}"
            })
            .done(function( data ) {
            $('#walk').html(data);
        });
        }
        // count walk-in sales
        function getWalkSales() {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.count.walksales') }}"
            })
            .done(function( data ) {
            $('#walk-sales').html(data);
            });
        }
    });
</script>
<script>
    function deleteItem(id) {

            $.ajax({
                headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
           type: "POST",
           url: "{{ route('delete-item')}}",
           data:{id:id},
           success: function(result) {
           $('#example').DataTable().ajax.reload( null, false );
           }
       });
          }
</script>


