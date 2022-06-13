@extends('layouts.inc.front')

@section('title')
    Welcome to Food-Monkey
@endsection

@section('content')
@include('layouts.inc.slider')
    
        <div class="py-3">
            <div class="container product_data">
                <div class="row">
                    <h3>Featured Products</h3>
                    <div class="owl-carousel featured-carousel owl-theme">
                            @foreach($featured_products as $prod)
                            <div class="item">
                                <div class="card">
                                <img src="{{asset('assets/uploads/products/'.$prod->image)}}"  height="150" width="80px"  alt="">
                                    <div class="card-body">
                                        <h6>{{$prod->name}} <br><span>  ₦{{$prod->selling_price}}.{{rand(10,100)}}k</span></h6>
                                  
                                    </div>
                                   
                                    <div class="cart">
  
                                        <button type="button" class="btn w-100 btn-warning btn-sm  addIndex" id="{{ $prod->id }}">Add to Cart
                                            <i class="fa fa-shopping-cart"></i></button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                  </div>
                </div>
            </div>
        </div>

        <div class="py-1">
            <div class="container">
                <div class="row">
                    <h3>Trending Categories</h3>
                    <div class="owl-carousel featured-carousel owl-theme">
                            @foreach($trending_category as $tcategory)
                            <div class="item">
                                <a class = "text-black" href="{{url('view-category/'.$tcategory->slug)}}">
                                <div class="card">
                                <img src="{{asset('assets/uploads/category/'.$tcategory->image)}}"   height="220"   alt="">
                                    <div class="card-body">
                                        <h5 class=" text-center ">{{$tcategory->name}}</h5>
                                        <hr>
                                        <p class="category-text">
                                            {{$tcategory->meta_descrip}}
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
@endsection

@section('scripts')
<script>
    $('.featured-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:4
        },
        1000:{
            items:6
        }
    }
})
</script>
@endsection