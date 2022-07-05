@extends('layouts.inc.front')
@section('title', 'Write a review')
@section('content')
 
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>You are writing a review for {{$product->name}}</h5>
                    <form action="/add-review" method="POST">
                        @csrf
                        
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <textarea name="user_review" class="form-control" cols="30" rows="5" placeholder="write a review"></textarea>
                        <button type="submit" class="btn btn-primary mt-3">Post review</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection