@extends('layouts.inc.front')

@section('title')
    My Cart
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0"><a href="{{ url('/') }}">Home</a> / Wishlist</h6>
        </div>
    </div>

    <div class="container my-5">
        <div class="card shadow wishlistitems">
            <div class="card-body">
                @if ($wishlist->count() > 0)
                    @foreach ($wishlist as $item)
                        <div class="row product_data">
                            <div class="col-md-2 my-auto">

                                <a href="{{ url('category/' . $item->product->category->slug . '/' . $item->product->slug) }}"><img
                                        src="{{ asset('assets/uploads/products/' . $item->product->image) }}" height="150px"
                                        width="100px" class="w-100"></a>
                            </div>
                            <div class="col-md-2 my-auto">
                                <h6>
                                    {{ $item->product->name }}
                                </h6>
                            </div>
                            <div class="col-md-2 my-auto">
                                <h6>
                                    ₦{{ $item->product->selling_price }}.00K
                                </h6>
                            </div>
                            <div class="col-md-2 my-auto">
                                <input type="hidden" value="{{ $item->prod_id }}" class="prod_id">
                                @if ($item->product->qty > 0)
                                    <label for="Quantity">Quantity</label>
                                    <div class="input-group text-center mb-3" style="width:130px;">
                                        <button class="input-group-text  minus-btn">-</button>
                                        <input type="text" name="quantity " class="form-control qty-input text-center"
                                            value=" 1" class="form-control" />
                                        <button class="input-group-text plus-btn">+</button>
                                    </div>
                                    <h6 class="text-success ">In Stock</h6>
                                @else
                                    <h6 class="badge bg-danger">Out of Stock</h6>
                                @endif
                            </div>
                            <div class="col-md-2 my-auto  mt-5">
                                <button class="btn btn-success addToCartBtn btn-sm"> <i class="fa fa-shopping-cart"> </i>
                                    Add to Cart</button>
                            </div>

                            <div class="col-md-2 my-auto mt-5">
                                <button class="btn btn-danger btn-sm delete-wishlist-item"> <i class="fa fa-trash"> </i>
                                    Remove</button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h4>There are no products in your Wishlist</h4>
                @endif
            </div>
        </div>
    </div>
@endsection
