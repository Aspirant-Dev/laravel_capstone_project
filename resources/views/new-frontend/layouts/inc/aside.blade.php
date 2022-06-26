<aside class="col-md-4 col-lg-3 ">
    <ul class="nav nav-dashboard flex-column mb-3 mb-md-0 " @if(Route::is('user.address')) style="margin-top: 10px; border:1px solid rgb(184, 184, 184);"  @else style="margin-top: 1px;  border:1px solid rgb(184, 184, 184);" @endif role="tablist">
        <li class="nav-item pl-3 bg-white">
            <a class="nav-link @if(Route::is('user.dashboard')) active @endif" @if(!Route::is('user.dashboard')) href="{{ route('user.dashboard') }}"
            @else id="tab-dashboard-link" data-toggle="tab"  href="#tab-dashboard" aria-selected="true" @endif><i class="fa fa-tachometer"></i> Dashboard </a>
        </li>
        <li class="nav-item pl-3 bg-white">
            <a class="nav-link @if(Route::is('user.all.orders')) active @endif" @if(Route::is('user.all.orders'))  id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="true" @else href="{{ route('user.all.orders') }}"  @endif><i class="fas fa-store"></i> My Orders</a>
        </li>
        <li class="nav-item pl-3 bg-white">
            <a class="nav-link @if(Route::is('user.address') || (Route::is('user.edit-address'))) active @endif" @if(Route::is('user.address') || (Route::is('user.edit-address'))) id="tab-address-link" data-toggle="tab" href="#tab-address" role="tab" aria-controls="tab-address" aria-selected="true" @else href="{{ route('user.address') }}" @endif><i class="fas fa-map-marker-alt"></i> Addresses</a>
        </li>
        <li class="nav-item pl-3 bg-white">
            <a class="nav-link @if(Route::is('user.profile')) active @endif"

            @if(!Route::is('user.profile')) href="{{ route('user.profile') }}"
            @else id="tab-account-link" data-toggle="tab" role="tab" aria-controls="tab-account" href="#tab-account" aria-selected="true" @endif><i class="fas fa-user-circle"></i> Account Details</a>
        </li>
        <li class="nav-item pl-3 bg-white">

            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</aside>
