<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark pb-2" >
    <div class="container">
        <a class="navbar-brand" href="/">
            <span>
                <img src="{{ asset('assets/landing_page/assets/logo.png') }}" width="40px" height="40px">
            </span>
            <span style="font-size: 14px; font-family: 'Nunito', sans-serif;">
                Real Value Ent.
            </span>
        </a>

      {{-- <a href="{{ url('/cart')}}" class="navbar-toggler ms-auto m-1" style="border: none;">
        <span><i class="fas fa-shopping-bag "></i>
            @php
                use App\Carts;
                if(Auth::check())
                {
                    if(Carts::all()->count() > 0)
                    {
                        echo '<span class="badge rounded-pill bg-danger cart-count" style="position:absolute; margin-top:-10px; margin-left:-8px; font-size:10px">0</span>';
                    }
                }
            @endphp
        </span>
      </a> --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse text-center" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active fw-bold':'' }}" aria-current="page" href="{{ url('/') }}">Home</a>
                </li>

                @guest
                    <li class="nav-item {{ Request::is('login') ? 'active fw-bold' :'' }}">
                        <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('register') ? 'active fw-bold':'' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('cart') ? 'active fw-bold':'' }} " aria-current="page" href="{{ url('cart') }}">Cart <span class="badge rounded-pill cart-count" style="background-color: #ee4d2d">0</span></a>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle @if(Request::is('my-profile') || Request::is("my-purchases")) active fw-bold @endif" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->username }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('/my-profile') }}"><span><i class="fas fa-user-alt"></i></span> My Profile</a>
                            <a class="dropdown-item" href="{{ url('/my-purchases') }}"><span><i class="fas fa-store"></i></span> My Purchase</a>
                            <hr class="m-1">

                            <a class="dropdown-item" href="{{ route('logout') }}"
                            {{-- <a class="dropdown-item" href="{{ route('users.logout') }}" --}}
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"><span><i class="fas fa-sign-out-alt"></i></span>
                                    {{ __('Logout') }}
                             </a>
                            {{-- <form id="logout-form" action="{{ route('users.logout') }}" method="POST" style="display: none;"> --}}
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

@if (Request::is('password/reset') || Request::is('login') || Request::is('register') || Route::is('password.reset') || Request::is('email/verify') || Route::is('contact-us') || Request::is('paypal') || Request::is('gcash'))
    <div class="mt-3"></div>

@else
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark pb-3 border-bottom border-danger" style="border-width:2px !important; color: 4px solid #ee4d2d" >
        <div class="container ">
            <form class="container-fluid" action="/search">
                <div class="input-group">
                    <!-- category button -->
                    <button class="btn btn-light input-group-text" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        <span><i class="fas fa-ellipsis-v"></i></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li><a href="{{ url('categories') }}" class="dropdown-item" type="button">All Categories</a></li>
                        @foreach ($categories as $item )
                            <li><a class="dropdown-item" type="button" href="{{ url('view-category/'.$item->slug) }}">{{ $item->name }}</a></li>
                        @endforeach
                    </ul>

                    <!-- search field -->
                    <input type="text" value="{{ request()->input('query') }}"  class="form-control" name="query" required id="search_text" placeholder="Search product here..."
                         oninvalid="this.setCustomValidity('No items to be search.')" oninput="this.setCustomValidity('')"/>

                    <!-- search button -->
                    <button type="submit" class="input-group-text" >
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </nav>
@endif
