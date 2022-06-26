
@php
    use App\Order;

    $order = Order::orderBy('id','DESC')->count();
    $pending_order = Order::where('status','0')->count();
    $processing_order = Order::where('status','1')->count();
    $delivery_order = Order::where('status','2')->count();
    $completed_order = Order::where('status','3')->count();
    $cancelled_order = Order::where('status','4')->count();

@endphp
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 col-md-12">
                <!-- small box -->
                <div class="small-box bg-gradient-success">
                    <div class="inner">
                        <h3><span id="count-allOrders">{{ $order }}</span></h3>
                        <p>All Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-bag fa-2x text-gray-300"></i>
                    </div>
                    <a href="{{ route('admin.delivery.view-order') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-xl-4 col-md-12">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><span id="count-pendingOrders">{{ $pending_order }}</span></h3>
                        <p>Pending Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-spinner fa-2x text-gray-300"></i>
                    </div>
                        <a href="{{ route('admin.delivery.view-order.pending') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-xl-4 col-md-12">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><span id="count-processingOrders">{{ $processing_order }}</span></h3>
                        <p>Processing Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                    </div>
                    <a href="{{ route('admin.delivery.view-order.processing') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 col-md-12">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><span id="count-deliveryOrders">{{ $delivery_order }}</span></h3>
                        <p>For Delivery Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-truck fa-2x text-gray-300"></i>
                    </div>
                    <a href="{{ route('admin.delivery.view-order.for-delivery') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-xl-4 col-md-12">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><span id="count-completedOrders">{{ $completed_order }}</span></h3>
                        <p>Completed Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-thumbs-up fa-2x text-gray-300"></i>
                    </div>
                    <a href="{{ route('admin.delivery.view-order.delivered') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-xl-4 col-md-12">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><span id="count-cancelOrders">{{ $cancelled_order }}</span></h3>
                        <p>Cancelled Orders </p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                    </div>
                    <a href="{{ route('admin.delivery.view-order.cancelled-returned') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card" style="border-radius: 0px!important">
                <div class="card-header">

                <h3 class="card-title">Total Orders For Delivery </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                </div>
                <div class="card-body">
                    <table id="example4" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Order Date</th>
                            <th>Tracking Number</th>
                            <th>Total Price</th>
                            <th>Payment Method</th>
                            {{-- <th>Status</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $('#example4').DataTable({
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
            "ajax": '/admin/ajax-delivery',
            "columns": [
                { mData: 'created_at'},
                { mData: 'tracking_no'},
                { mData: 'total_price'},
                { mData: 'payment_method'},
                { data: 'id', name: 'id', render:function(data, type, row){
                    return "<a class='btn btn-primary btn-sm' href='/admin/delivery/view-update-order/"+ row.id +"'>View</a>"
                }},
            ]
        });
    });
</script>

