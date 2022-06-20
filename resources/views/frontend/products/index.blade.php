@extends('layouts.inc.front')

@section('title')
    {{ $category->name }}
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0 text-black">Collections / <a class="text-black text-decoration-underline"
                    href="{{ url('category') }}">Category</a> /<a class="text-black text-decoration-underline"
                    href="">{{ $category->name }}</a></h6>
        </div>
    </div>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>{{ $category->name }}</h2>
                @foreach ($products as $prod)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <a class="text-black" href="{{ url('category/' . $category->slug . '/' . $prod->slug) }}">
                                <img src="{{ asset('assets/uploads/products/' . $prod->image) }}" height="140px">

                                <div class="card-body">
                                    <h6>{{ $prod->name }} <br><span class="float-start">
                                            ₦{{ $prod->selling_price }}.{{ rand(10, 99) }}k</span></h6>
                                    <br>
                                    <p class="category-text">
                                        {{ $prod->meta_description }}
                                    </p>
                                </div>

                        </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    
    <!--floating cart-->
    @if (Auth::check())
        @php
            $count = App\Models\Cart::where('user_id', Auth::id())->count();
            $count_wish = App\Models\Wishlist::where('user_id', Auth::id())->count();
        @endphp
        <a class="nav-link float-button" href="{{ url('cart') }}"><i class="fa fa-shopping-cart"></i>
            <span class="badge badge-pill bg-danger cart-count">{{ $count }}</span>
        </a>
    @else
        @php
            $count='';
            session('cart') ? ($count = count(session('cart'))) : ($count = 0);
            
        @endphp
        <a class="nav-link float-button" href="{{ url('view-cart') }}"><i class="fa fa-shopping-cart"></i>
            <span class="badge badge-pill bg-danger cart_count">{{ $count }}</span>
        </a>
    @endif
 <!--floating cart-->
@endsection
