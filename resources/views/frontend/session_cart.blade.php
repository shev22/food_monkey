@extends('layouts.inc.front')

@section('title')
   My Cart
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0"><a class = "text-black text-decoration-underline" href="{{url('/')}}">Home</a> / <a  class = "text-black text-decoration-underline"  href="{{url('category')}} ">Category </a> / Cart</h6>
    </div>
</div>

<div class="container my-5">
    <div class="card shadow cartitems">
        @if(session('cart'))
        <div class="card-body">
            @php $total = 0; @endphp
            @foreach (session('cart') as $item)
            <div class="row delete{{$item['prod_id']}} product_data">
                <div class="col-md-2 my-auto">

 
 <a href="{{url('category')}}"><img src="{{asset('assets/uploads/products/'.$item['image'])}}" height="150px" width="100px" class="w-100"></a> 
                </div>
                <div class="col-md-3 my-auto">
                    <h6>
                        {{$item['name']}}
                    </h6>
                </div> 
                <div class="col-md-2 my-auto">
                    <h6>
                        @php 
                         $price = $item['selling_price'] * $item['prod_qty']
                        
                        @endphp
                        ₦{{$price}}.{{rand(10,100)}}k
                    </h6>
                </div> 
                    <div class="col-md-3 my-auto">
                        <input type="hidden" value="{{$item['prod_id']}}" class="prod_id">
                        {{-- @if ($item->product->qty >= $item->prod_qty) --}}
                        <label for="Quantity">Quantity</label>
                        <div class="input-group text-center mb-3" style="width:130px;">
                            <button class="input-group-text changeQuantity minus-btn">-</button>
                            <input type="text" name="quantity " class="form-control qty-input text-center" value=" {{$item['prod_qty']}}" class="form-control" />
                            <button class="input-group-text changeQuantity plus-btn">+</button>
                        </div>
                        @php $total += $item['selling_price']* $item['prod_qty']; @endphp 
                        {{-- @else --}}
                        <h6 class="badge bg-success">In Stock</h6>
                        {{-- @endif --}}
                    </div>
                    <div class="col-md-2 my-auto">
                        <button class="btn btn-danger mt-2 delete-session-item"> <i class="fa fa-trash">  </i>    Remove</button>
                    </div> 
                </div>
                @endforeach
            </div>
            <div class="card-footer ">
                <h6>
                    Total Price : ₦{{$total}}.{{rand(10,100)}}k
                    <a href="{{url('checkout')}}" class="btn btn-outline-success px-5 float-end ">Proceed to Checkout</a>
                </h6>
            </div>
            @else
            <div class="card-body text-center">
                <h2>Your <i class = "fa fa-shopping-cart"></i>Cart is empty</h2>
                <a href="{{url("category")}}" class="btn btn-outline-primary float-end">Continue Shopping</a>
            </div>
            @endif
        </div>
    </div>
@endsection
