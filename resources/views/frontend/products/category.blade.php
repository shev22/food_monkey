@extends('layouts.inc.front')

@section('title')
   Category
@endsection

@section('content')
    <div class="py-5">
        <div class="row">
            <div class="col-md-12">
                <h2>All Categories</h2>
                <div class="row">
                    @foreach ($category as $item)
                        <div class="col-md-4 mb-3">   
                                <a href="{{url('view-category/'$item->slug)}}">            
                                    <div class="card">
                                    <img src="{{asset('assets/uploads/category/'.$item->image)}}"    alt="">
                                        <div class="card-body">
                                            <h5>{{$item->name}}</h5>
                                            <p>
                                            {{-- {{$item->description}} --}}
                                            </p>
                                        </div>
                                    </div> 
                                </a>  
                        </div>                   
                    @endforeach
                </div>
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