@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
            <h4>add Product</h4>
    </div>
    <div class="card-body">
        <form action="{{url('update-product/'.$products->id)}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="">Category</label>
                    <select class="form-select">
                        <option value="">{{$products->category->name}}</option>
                       
                      </select>        
                </div>
                <div class="col-md-6 md-3">
                    <label for="">Name</label>
                    <input type="text" class="form-control" value= "{{$products->name}}" name="name">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Slug</label>
                    <input type="text" class="form-control" value= "{{$products->slug}}" name="slug">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Small Description</label>
                    <textarea name="small_description"   cols="30" rows="5" class="form-control">{{$products->small_description}}</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Description</label>
                    <textarea name="description"  cols="30" rows="5" class="form-control"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Original Price</label>
                    <input type="number" name="original_price" class="form-control" value= "{{$products->original_price}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Selling Price</label>
                    <input type="number" name="selling_price" class="form-control" value= "{{$products->selling_price}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Tax</label>
                    <input type="text" name="tax" class="form-control" value= "{{$products->tax}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Quantity</label>
                    <input type="number" name="qty"  class="form-control" value= "{{$products->qty}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Status</label>
                    <input type="checkbox" name="status" {{$products->status == '1' ? 'checked': ''}}>
                </div>
             
                <div class="col-md-6 mb-3">
                    <label for="">Trending</label>
                    <input type="checkbox" name="trending" {{$products->trending == '1' ? 'checked': ''}}>
                </div>
                <div class="col-md-12  mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" class="form-control" name="meta_title">
                </div>
                <div class="col-md-12  mb-3">
                    <label for="">Meta_keywords</label>
                    <textarea name="meta_keywords"  cols="30" rows="5" class="form-control">{{$products->meta_keywords}}</textarea>
                </div>
                <div class="col-md-12  mb-3">
                    <label for="">Meta_description</label>
                    <textarea name="meta_description"  cols="30" rows="5" class="form-control">{{$products->meta_description}}</textarea>
                </div>
                @if($products->image)
                <img src="{{asset('assets/uploads/products/'.$products->image)}}"  width="150px" height="150px" alt="">
            @endif    
                <div class="col-md-12">
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>              
        </form>
    </div>
</div>

@endsection