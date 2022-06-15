@extends('layouts.inc.front')
@section('title', $product->name)
@section('content')

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{url('/add-rating')}}" method="POST">
                    @csrf

                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rate this product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-css">
                            <div class="star-icon">
                                
                                <input type="radio" value="1" name="product_rating" checked id="rating1">
                                <label for="rating1" class="fa fa-star"></label>
                                <input type="radio" value="2" name="product_rating" id="rating2">
                                <label for="rating2" class="fa fa-star"></label>
                                <input type="radio" value="3" name="product_rating" id="rating3">
                                <label for="rating3" class="fa fa-star"></label>
                                <input type="radio" value="4" name="product_rating" id="rating4">
                                <label for="rating4" class="fa fa-star"></label>
                                <input type="radio" value="5" name="product_rating" id="rating5">
                                <label for="rating5" class="fa fa-star"></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Rate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0 text-black"><a href="{{ url('category')}}" class="text-black text-decoration-underline">Category</a> / <a class="text-black text-decoration-underline"
                    href="{{ url('view-category/' . $product->category->slug) }}">{{ $product->category->name }}</a> /
                {{ $product->name }}</h6>
        </div>
    </div>

    <div class="container pb-5">
        <div class="product_data">
            <div class="">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <img src="{{ asset('assets/uploads/products/' . $product->image) }}" class="w-100">
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0">
                            {{ $product->name }}
                            <label style="font-size: 16px;"
                                class="float-end badge bg-danger trending_tag">{{ $product->trending == '1' ? 'Trending' : '' }}</label>
                        </h2>

                        <hr>
                        <label class="me-3">Original Price: <s class="text-danger"> ₦ {{ $product->original_price }}</s></label>
                        <label class="fw-bold">Selling Price:  ₦ {{ $product->selling_price }}.{{rand(10,100)}}k</label>
                        @php $rate_number = number_format($rating_value) @endphp
                        <div class="rating">
                        @for($i = 1; $i<=$rate_number; $i++)
                            <i class="fa fa-star checked"></i>
                            @endfor
                            @for($j = $rate_number+1; $j <= 5; $j++)
                            <i class="fa fa-star"></i>
                            @endfor

                            @if($rating->count() > 0)
                            <span> {{$rating->count()}} Rating </span>
                            @else
                            @endif
                        </div>
                        <p class="mt-3">
                            {!! $product->small_description !!}
                        </p>
                        <hr>
                        @if ($product->qty > 0)
                            <label class="badge bg-success">in stock</label>
                        @else
                            <label class="badge bg-danger">Out of stock</label>
                        @endif
                        <div class="row mt-2">
                            <div class="col-md-2">
                                <input type="hidden" value="{{ $product->id }}" class="prod_id">
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center mb-3">
                                    <button class="input-group-text minus-btn">-</button>
                                    <input type="text" name="quantity " class="form-control qty-input text-center" value="1"
                                        class="form-control" />
                                    <button class="input-group-text plus-btn">+</button>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <br />
                                @if ($product->qty > 0)
                                    <button type="button" class="btn btn-primary me-3 add_session addToCartBtn float-start">Add to Cart
                                        <i class="fa fa-shopping-cart" id='25' ></i></button>
                                @endif
                                <button type="button" class="btn btn-success me-3 addToWishlistBtn float-start">Add to
                                    Wishlist <i class="fa fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <h3>Description</h3>
                        <p class="mt-3">
                            {!! $product->description !!}
                        </p>
                    </div>
                    <hr>
                </div>
               
                <div class="row">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Rate this product
                        </button>
                        <a href="{{url('add-review/'.$product->slug.'/userreview')}}" class="btn btn-outline-primary">Write a review</a>
                    </div>
                    <div class="col-md-8">
                        @foreach ($reviews as $review)

                        <div class="user-review">

                            <label for="">{{$review->user->fname.' '.$review->user->lname}}</label>      
                            <br>
                            @php
                                   $rating_stars = App\Models\Rating::where('prod_id', $product->id)->where('user_id', $review->user->id)->get();
                            @endphp
                     
                          @if($rating_stars)

                            @php 
                            $user_rated = $review->rating->stars_rated
                            
                            @endphp
                            
                                @for($i = 1; $i<=$user_rated; $i++)
                                <i class="fa fa-star checked"></i>
                                @endfor
                                @for($j = $user_rated+1; $j <= 5; $j++)
                                <i class="fa fa-star"></i>
                                @endfor
                            
                            @endif
                          
                            <small>Reviewed on {{$review->created_at->format('d M Y H:m:s')}}</small>
                            <p>
                               {{$review->user_review}}
                            </p>
                                  
                        </div>
                      
                        @endforeach
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
