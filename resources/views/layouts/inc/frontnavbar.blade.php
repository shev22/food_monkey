<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{asset('assets/images/logo3.png')}}" height="30px" width="30px" >
            Food-Monkey</a>


        <div class="search-bar">
          <form action="{{URL('search-product')}}" method="POST">
            @csrf

            <div class="input-group">
                <input type="search" class="form-control" id = "search_product" placeholder="Search products" required name="product_name" aria-label="Username"
                    aria-describedby="basic-addon1">
                <button type= "submit" class="input-group-text"><i class="fa fa-search"></i></button>
            </div>
          </form>
        </div>



        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('category') }}">Category</a>
                </li>

                @if(Auth::check())
                <li class="nav-item">

                    @php
                        $count = App\Models\Cart::where('user_id', Auth::id())->count();
                        $count_wish = App\Models\Wishlist::where('user_id', Auth::id())->count();
                    @endphp
                    <a class="nav-link" href="{{ url('cart') }}">Cart<i class="fa fa-shopping-cart"></i>
                        <span class="badge badge-pill bg-danger cart-count">{{ $count }}</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('wishlist') }}">Wishlist<i class="fa fa-heart"></i>
                        <span class="badge badge-pill bg-success wishlist-count">{{ $count_wish }}</span>
                    </a>
                </li>
                @else
                @endif


                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->fname . ' ' . Auth::user()->lname }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="#">My profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('my-orders') }}">My Orders</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('dashboard') }}">Admin Panel</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();  document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </li>

                        </ul>
                    </li>

                @endguest
            </ul>
        </div>
    </div>
</nav>