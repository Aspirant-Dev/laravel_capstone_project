<head>
    <!-- ALERTIFY CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- ALERTIFY Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
</head>
@php
    use App\Admin;
    use App\ReturnedProducts;
    use App\Order;
@endphp
<style>
    .swal-modal .swal-text
    {
        text-align: center;
    }
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a style="cursor: default; text-decoration: none" class="brand-link" style="text-decoration: none">
        <img src="{{ asset('assets/landing_page/assets/logo.png') }}" alt="Admin Logo" class="brand-image img-circle elevation-3" >
        <span class="brand-text ">Real Value Ent. </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (Auth::user()->user_type == 'Admin')
                    <img src="{{  asset('assets/admin/Admin-icon.png')}}" class="img-circle elevation-2" alt="User Image">
                @elseif (Auth::user()->user_type == 'Cashier')
                    <img src="{{ asset('uploads/profile/cashier.png') }}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{ asset('uploads/profile/delivery.png') }}" class="img-circle elevation-2" alt="User Image">
                @endif

            </div>
            <div class="info">
                <a  class="d-block" style="text-decoration: none; cursor: default"><span>Logged in as: </span> {{ Auth::user()->user_type }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

        @if (Auth::user()->user_type == 'Admin')
            <li class="nav-item {{ Route::is('admin.dashboard') ? 'menu-open':'' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active':'' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
                </a>
            </li>
            <li class="nav-item @if (Route::is('admin.add-product') || Route::is('admin.edit-product') || Route::is('admin.add-category') || Route::is('admin.edit-category') || Route::is('admin.add-product-unit') || Route::is('admin.products-unit') || Route::is('admin.edit-product-unit') || Route::is('admin.banners')  ||(Route::is('admin.add.banner')) || Route::is('admin.edit.banner') || Route::is('admin.ratings')) menu-open @endif">
                <a href="#" class="nav-link @if (Route::is('admin.add-product') || Route::is('admin.edit-product') || Route::is('admin.add-category') || Route::is('admin.edit-category') || Route::is('admin.add-product-unit')|| Route::is('admin.products-unit') || Route::is('admin.edit-product-unit') || Route::is('admin.banners') ||(Route::is('admin.add.banner')) || Route::is('admin.edit.banner') || Route::is('admin.ratings')) active @endif">
                  <i class="nav-icon fas fa-tools"></i>
                  <p>
                    Maintenance
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('/admin/add-category') }}" class="nav-link @if (Route::is('admin.add-category') || Route::is('admin.edit-category')) active @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Category</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/admin/add-product') }}" class="nav-link @if (Route::is('admin.add-product') || Route::is('admin.edit-product')) active @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Product</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.add-product-unit') }}" class="nav-link @if (Route::is('admin.add-product-unit') || Route::is('admin.edit-product-unit')) active @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Product Unit</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.products-unit') }}" class="nav-link @if (Route::is('admin.products-unit')) active @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>View Product Unit</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.banners') }}" class="nav-link @if (Route::is('admin.banners') ||(Route::is('admin.add.banner')) || Route::is('admin.edit.banner')) active @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Banners</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.ratings') }}" class="nav-link @if (Route::is('admin.ratings')) active @endif">
                      <i class="far fa-star nav-icon"></i>
                      <p>Ratings and Reviews</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.ratings') }}" class="nav-link @if (Route::is('admin.ratings')) active @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add User Account</p>
                    </a>
                  </li>

                </ul>
            </li>
            <li class="nav-item @if(Route::is('admin.products') || Route::is('admin.critical-stocks'))  menu-open @endif">
                <a href="{{ url('/admin/products') }}" class="nav-link  @if(Route::is('admin.products') || Route::is('admin.critical-stocks'))  active @endif">
                    <i class="nav-icon fas fa-truck-loading fa-2x text-gray-300"></i>
                    <p>
                        Products
                    </p>
                </a>
            </li>
            <li class="nav-item {{ Route::is('admin.categories') ? 'menu-open':'' }}">
                <a href="{{ url('/admin/categories') }}" class="nav-link {{ Route::is('admin.categories') ? 'active':'' }}">
                  <i class="nav-icon fas fa-list fa-2x text-gray-300"></i>
                  <p>
                    Categories
                  </p>
                </a>
            </li>
            <li class="nav-item  @if(Route::is('admin.customers')) menu-open @endif">
                <a href="{{ url('/admin/customers') }}" class="nav-link @if(Route::is('admin.customers')) active @endif">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Customers
                  </p>
                </a>
            </li>
            {{-- <li class="nav-item @if(Route::is('admin.orders') || Route::is('admin.order.update')|| Route::is('admin.view-order.pending')
                || Route::is('admin.view-order.processing')||Route::is('admin.view-order.for-delivery')
                || Route::is('admin.view-order.delivered') || Route::is('admin.view-order.cancelled-returned')) menu-open @endif">
                <a href="{{ url('/admin/view-orders') }}" class="nav-link @if(Route::is('admin.orders') || Route::is('admin.order.update')|| Route::is('admin.view-order.pending')
                || Route::is('admin.view-order.processing')||Route::is('admin.view-order.for-delivery')
                || Route::is('admin.view-order.delivered') || Route::is('admin.view-order.cancelled-returned')) active @endif">
                  <i class="fas fa-shopping-bag nav-icon"></i>
                  <p>Orders</p>
                </a>
            </li> --}}
            {{-- <li class="nav-item @if(Route::is('admin.orders') || Route::is('admin.order.update')|| Route::is('admin.view-order.pending')
                                || Route::is('admin.view-order.processing')||Route::is('admin.view-order.for-delivery')
                                || Route::is('admin.view-order.delivered') || Route::is('admin.view-order.cancelled-returned')
                                || Route::is('admin.walkin.orders') || Route::is('admin.walkin.order.view')) menu-open @endif"> --}}
            <li class="nav-item menu-open">
            <a href="#" class="nav-link @if(Route::is('admin.orders') || Route::is('admin.order.update')|| Route::is('admin.view-order.pending')
                                || Route::is('admin.view-order.processing')||Route::is('admin.view-order.for-delivery')
                                || Route::is('admin.view-order.delivered') || Route::is('admin.view-order.cancelled-returned')
                                || Route::is('admin.walkin.orders') || Route::is('admin.walkin.order.view')) active @endif">
                <i class="nav-icon fas fa-shopping-bag"></i>
                <p>
                Orders Transactions
                <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item ">
                <a href="{{ url('/admin/view-orders') }}" class="nav-link @if(Route::is('admin.orders') || Route::is('admin.order.update')|| Route::is('admin.view-order.pending')
                || Route::is('admin.view-order.processing')||Route::is('admin.view-order.for-delivery')
                || Route::is('admin.view-order.delivered') || Route::is('admin.view-order.cancelled-returned')) active @endif">
                    <i class="fas fa-globe-asia nav-icon"></i>
                    <p>Online Orders</p>
                    @php
                        $countCod = Order::where('status',0)->where('payment_method','=','COD')->count();
                        $countOnline = Order::where('status',1)->where('payment_method','!=','COD')->count();

                        $counterO = 0;
                        if($countOnline > 0)
                        {
                            $counterO += $countOnline;
                        }
                        if($countCod > 0)
                        {
                            $counterO += $countCod;
                        }
                    @endphp
                    <span id="onlinesOrders" class="right badge badge-pill bg-danger">{{ $counterO > 0 ? $counterO : '' }}</span>
                </a>
                </li>
                <li class="nav-item ">
                <a href="{{ url('/admin/view-walkin-orders') }}" class="nav-link @if(Route::is('admin.walkin.orders') || Route::is('admin.walkin.order.view')) active @endif ">
                    <i class="fas fa-walking nav-icon"></i>
                    <p>View Walk-in Orders</p>
                </a>
                </li>
            </ul>
            </li>

            <li class="nav-item @if(Route::is('admin.delivery') || Route::is('admin.delivery-details')) menu-open @endif">
                <a href="{{ url('/admin/delivery-record') }}" class="nav-link @if(Route::is('admin.delivery') || Route::is('admin.delivery-details')) active @endif">
                  <i class="nav-icon fas fa-truck"></i>
                  <p>
                    Delivery
                  </p>
                </a>
            </li>
            <li class="nav-item @if(Route::is('admin.return-products')) menu-open @endif">
                <a href="{{ url('/admin/return-products') }}" class="nav-link @if(Route::is('admin.return-products')) active @endif">
                    <i class="nav-icon fas fa-exchange-alt"></i>
                  <p>
                    Return Products
                  </p>
                  @php
                      $counter = ReturnedProducts::all()->count();
                  @endphp
                  <span id="returns" class="right badge badge-pill bg-danger">{{ $counter > 0 ? $counter: '' }}</span>
                </a>
            </li>
            <li class="nav-item @if (Route::is('admin.reports.orders') || Route::is('admin.reports.inventory')
                                || Route::is('admin.reports.overall.sales') || Route::is('admin.reports.overall.sales.search-from-date')
                                || Route::is('admin.reports.overall.sales.yesterday') || Route::is('admin.reports.overall.sales.last-7-days') || Route::is('admin.reports.overall.sales.this-month')
                                || Route::is('admin.reports.online.sales') || Route::is('admin.reports.online.sales.search-from-date')
                                || Route::is('admin.reports.walkin.sales') || Route::is('admin.reports.walkin.sales.search-from-date')
                                || Route::is('admin.reports.online.sales.yesterday') || Route::is('admin.reports.online.sales.last-7-days') || Route::is('admin.reports.online.sales.this-month')
                                || Route::is('admin.reports.walkin.sales.yesterday') || Route::is('admin.reports.walkin.sales.last-7-days') || Route::is('admin.reports.walkin.sales.this-month'))
                                menu-open @endif">
                <a href="#" class="nav-link @if (Route::is('admin.reports.orders')  || Route::is('admin.reports.inventory')
                                || Route::is('admin.reports.overall.sales') || Route::is('admin.reports.overall.sales.search-from-date')
                                || Route::is('admin.reports.overall.sales.yesterday') || Route::is('admin.reports.overall.sales.last-7-days') || Route::is('admin.reports.overall.sales.this-month')
                                || Route::is('admin.reports.online.sales') || Route::is('admin.reports.online.sales.search-from-date')
                                || Route::is('admin.reports.walkin.sales') || Route::is('admin.reports.walkin.sales.search-from-date')
                                || Route::is('admin.reports.online.sales.yesterday') || Route::is('admin.reports.online.sales.last-7-days') || Route::is('admin.reports.online.sales.this-month')
                                || Route::is('admin.reports.walkin.sales.yesterday') || Route::is('admin.reports.walkin.sales.last-7-days') || Route::is('admin.reports.walkin.sales.this-month'))
                                active @endif">
                  <i class="nav-icon fas fa-chart-bar"></i>
                  <p>
                    Reports
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item ">
                    <a href="{{ url('/admin/reports/inventory') }}" class="nav-link @if (Route::is('admin.reports.inventory')) active @endif">
                      <i class="fas fa-boxes nav-icon"></i>
                      <p>Inventory</p>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a href="{{ url('/admin/reports/overall-sales') }}" class="nav-link @if(Route::is('admin.reports.overall.sales') || Route::is('admin.reports.overall.sales.search-from-date')
                    || Route::is('admin.reports.overall.sales.yesterday') || Route::is('admin.reports.overall.sales.last-7-days') || Route::is('admin.reports.overall.sales.this-month')
                    || Route::is('admin.reports.online.sales') || Route::is('admin.reports.online.sales.search-from-date')
                                || Route::is('admin.reports.walkin.sales') || Route::is('admin.reports.walkin.sales.search-from-date')
                                || Route::is('admin.reports.online.sales.yesterday') || Route::is('admin.reports.online.sales.last-7-days') || Route::is('admin.reports.online.sales.this-month')
                                || Route::is('admin.reports.walkin.sales.yesterday') || Route::is('admin.reports.walkin.sales.last-7-days') || Route::is('admin.reports.walkin.sales.this-month')) active @endif">
                      <i class="fas fa-poll nav-icon"></i>
                      <p>Sales</p>
                    </a>
                  </li>
                    {{-- <li class="nav-item @if (Route::is('admin.reports.online.sales') || Route::is('admin.reports.online.sales.search-from-date') || Route::is('admin.reports.walkin.sales') || Route::is('admin.reports.walkin.sales.search-from-date')
                                        || Route::is('admin.reports.online.sales.yesterday') || Route::is('admin.reports.online.sales.last-7-days') || Route::is('admin.reports.online.sales.this-month')
                                        || Route::is('admin.reports.walkin.sales.yesterday') || Route::is('admin.reports.walkin.sales.last-7-days') || Route::is('admin.reports.walkin.sales.this-month'))
                                        menu-open @endif">
                        <a  class="nav-link @if (Route::is('admin.reports.online.sales') || Route::is('admin.reports.online.sales.search-from-date') || Route::is('admin.reports.walkin.sales') || Route::is('admin.reports.walkin.sales.search-from-date')
                                            || Route::is('admin.reports.online.sales.yesterday') || Route::is('admin.reports.online.sales.last-7-days') || Route::is('admin.reports.online.sales.this-month')
                                            || Route::is('admin.reports.walkin.sales.yesterday') || Route::is('admin.reports.walkin.sales.last-7-days') || Route::is('admin.reports.walkin.sales.this-month')) active @endif">
                          <i class="nav-icon fas fa-poll"></i>
                          <p>
                            Sales
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item ">
                                <a href="{{ url('/admin/reports/online-sales') }}" class="nav-link @if (Route::is('admin.reports.online.sales') || Route::is('admin.reports.online.sales.search-from-date') || Route::is('admin.reports.online.sales.yesterday') || Route::is('admin.reports.online.sales.last-7-days') || Route::is('admin.reports.online.sales.this-month')) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Overall Sales</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ url('/admin/reports/online-sales') }}" class="nav-link @if (Route::is('admin.reports.online.sales') || Route::is('admin.reports.online.sales.search-from-date') || Route::is('admin.reports.online.sales.yesterday') || Route::is('admin.reports.online.sales.last-7-days') || Route::is('admin.reports.online.sales.this-month')) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Online Transactions</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ url('/admin/reports/walk-in-sales') }}" class="nav-link @if(Route::is('admin.reports.walkin.sales') || Route::is('admin.reports.walkin.sales.search-from-date')
                                        || Route::is('admin.reports.walkin.sales.yesterday') || Route::is('admin.reports.walkin.sales.last-7-days') || Route::is('admin.reports.walkin.sales.this-month')) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Walk-in Transactions</p>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                </ul>
            </li>
            <li class="nav-item @if(Route::is('admin.user-management') || Route::is('admin.add-user') || Route::is('admin.edit-user')) menu-open @endif">
                <a href="{{ url('/admin/user-management') }}" class="nav-link @if(Route::is('admin.user-management') || Route::is('admin.add-user') || Route::is('admin.edit-user')) active @endif">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        User Management
                    </p>
                </a>
            </li>
            <li class="nav-item @if(Route::is('trash.productsUnits') || (Route::is('trash.products')) || (Route::is('trash.categories')) || Route::is('trash.userAccounts') || Route::is('trash.banners')) menu-open @endif">
                <a href="#" class="nav-link @if(Route::is('trash.productsUnits') || (Route::is('trash.products')) || (Route::is('trash.categories')) || Route::is('trash.userAccounts') || Route::is('trash.banners')) active @endif">
                <i class="nav-icon fas fa-recycle"></i>
                  <p>
                   Restore
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item ">
                    <a href="{{ route('trash.banners') }}" class="nav-link @if(Route::is('trash.banners')) active @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Banners</p>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a href="{{ route('trash.categories') }}" class="nav-link @if(Route::is('trash.categories')) active @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Categories</p>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a href="{{ route('trash.products') }}" class="nav-link @if(Route::is('trash.products')) active @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Products</p>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a href="{{ route('trash.productsUnits') }}" class="nav-link @if(Route::is('trash.productsUnits')) active @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Product Units</p>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a href="{{ route('trash.userAccounts') }}" class="nav-link @if(Route::is('trash.userAccounts')) active @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Admin User Accounts</p>
                    </a>
                  </li>
                </ul>
            </li>

            <!-- JavaScript -->
            <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
            <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
            <script>
                $(document).ready(function () {

                    // Enable pusher logging - don't include this in production
                    Pusher.logToConsole = false;

                    var pusher = new Pusher('bdd702fa83485adf2106', {
                    cluster: 'mt1'
                    });

                    var channel = pusher.subscribe('my-channel');
                    channel.bind('return-submitted', function(data) {
                        $('#returns').html(data.text);
                    });

                    channel.bind('new-orders', function(data) {
                        $('#onlinesOrders').html(data.text);
                    });
                    channel.bind('alert-message', function(data) {
                        alertify.set('notifier','position', 'top-right');
                        alertify.success(data.alert);
                    });
                    channel.bind('new-delivered', function(data) {
                        alertify.set('notifier','position', 'top-right');
                        alertify.success(data.msgAlert);
                    });
                    channel.bind('new-rating', function(data) {
                        alertify.set('notifier','position', 'top-right');
                        alertify.success(''+data.text+'');
                    });
                });

            </script>
        @elseif (Auth::user()->user_type == 'Cashier')
                <li class="nav-item {{ Route::is('admin.dashboard') ? 'menu-open':'' }}">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active':'' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.cashier.viewproducts') ? 'menu-open':'' }}">
                    <a href="{{ route('admin.cashier.viewproducts') }}" class="nav-link {{ Route::is('admin.cashier.viewproducts') ? 'active':'' }}">
                        <i class="nav-icon fas fa-truck-loading fa-2x text-gray-300"></i>
                    <p>
                        View Products
                    </p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.cashier.view.critical-stocks') ? 'menu-open':'' }}">
                    <a href="{{ route('admin.cashier.view.critical-stocks') }}" class="nav-link {{ Route::is('admin.cashier.view.critical-stocks') ? 'active':'' }}">
                        <i class="nav-icon fas fa-exclamation fa-2x text-gray-300"></i>
                    <p>
                        View Critical Stocks
                    </p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.cashier.pos') ? 'menu-open':'' }}">
                    <a href="{{ url('/admin/point-of-sales') }}" class="nav-link {{ Route::is('admin.cashier.pos') ? 'active':'' }}">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>
                            Point of Sales
                        </p>
                    </a>
                </li>
                <li class="nav-item @if(Route::is('admin.cashier.transaction') || Route::is('admin.cashier.view')) menu-open @endif">
                    <a href="{{ url('/admin/walk-in-transactions') }}" class="nav-link @if(Route::is('admin.cashier.transaction') || Route::is('admin.cashier.view')) active @endif">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>
                            Walk-in Transactions
                        </p>
                    </a>
                </li>
                <li class="nav-item @if(Route::is('admin.cashier.reports.walkin.sales') || Route::is('admin.cashier.reports.walkin.sales.search-from-date') || Route::is('admin.cashier.reports.walkin.sales.yesterday') || Route::is('admin.cashier.reports.walkin.sales.last-7-days') || Route::is('admin.cashier.reports.walkin.sales.this-month')) menu-open @endif">
                    <a href="{{ url('/admin/cashier/reports/walk-in-sales') }}" class="nav-link @if(Route::is('admin.cashier.reports.walkin.sales') || Route::is('admin.cashier.reports.walkin.sales.search-from-date') || Route::is('admin.cashier.reports.walkin.sales.yesterday') || Route::is('admin.cashier.reports.walkin.sales.last-7-days') || Route::is('admin.cashier.reports.walkin.sales.this-month')) active @endif">
                        <i class="nav-icon fas fa-poll"></i>
                        <p>
                            Walk-In Sales Report
                        </p>
                    </a>
                </li>
        @elseif (Auth::user()->user_type == 'Delivery')
            <li class="nav-item {{ Route::is('admin.dashboard') ? 'menu-open':'' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active':'' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
                </a>
            </li>
            <li class="nav-item menu-open ">
                <a href="#" class="nav-link @if (Route::is('admin.delivery.manage-order') || Route::is('admin.delivery.view-update.order')) active @endif">
                    <i class="nav-icon fas fa-cogs fa-2x text-gray-300"></i>
                    <p>
                    Manage Orders
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="{{ url('/admin/delivery/manage-orders/for-delivery') }}" class="nav-link @if (Route::is('admin.delivery.manage-order') || Route::is('admin.delivery.view-update.order')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>For Delivery</p>
                        @php
                            $counterD = Order::where('status',2)->count();
                        @endphp
                        <span id="count-fordelivery" class="right badge badge-pill bg-danger">{{ $counterD > 0 ? $counterD: '' }}</span>
                        </i>
                    </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item @if(Route::is('admin.delivery.view-order') || Route::is('admin.delivery.view-order.pending')
                                || Route::is('admin.delivery.view-order.processing')||Route::is('admin.delivery.view-order.for-delivery')
                                || Route::is('admin.delivery.view-order.delivered') || Route::is('admin.delivery.view-order.cancelled-returned'))
                                menu-open @endif">
                <a href="{{ route('admin.delivery.view-order') }}" class="nav-link @if(Route::is('admin.delivery.view-order')|| Route::is('admin.delivery.view-order.pending')
                                || Route::is('admin.delivery.view-order.processing')||Route::is('admin.delivery.view-order.for-delivery')
                                || Route::is('admin.delivery.view-order.delivered') || Route::is('admin.delivery.view-order.cancelled-returned'))
                                active @endif">
                    <i class="fas fa-shopping-bag nav-icon"></i>
                    <p>View Orders</p>
                </a>
                </li>

            <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
            <script>
                $(document).ready(function () {
                    // count delivery orders

                    function countDeliveryBadge() {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('admin.delivery.count-delivery') }}"
                        })
                        .done(function( data ) {
                            if(data > 0)
                            {
                                $('#count-fordelivery').html(data);
                            }
                        });
                    }
                    // Enable pusher logging - don't include this in production
                    Pusher.logToConsole = false;

                    var pusher = new Pusher('bdd702fa83485adf2106', {
                    cluster: 'mt1'
                    });

                    var channel = pusher.subscribe('my-channel');
                    channel.bind('new-orders', function(data) {
                        countDeliveryBadge();
                    });
                });
            </script>
        @endif
            <li class="nav-item">
                <a class="nav-link"  href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="nav-icon fas fa-sign-out-alt"></i>
                <p> Logout</p>
            </a>
                {{-- <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;"> --}}
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            </li>
        </nav>
    </div>
</aside>
