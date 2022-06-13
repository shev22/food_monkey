@extends('layouts.inc.front')

@section('title')
   Category
@endsection

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">All Categories</h2>
                <div class="row">
                    @foreach ($category as $item)
                        <div class="col-md-3 mb-3">   
                                <a class="text-black" href="{{url('view-category/'.$item->slug)}}">            
                                    <div class="card">
                                    <img src="{{asset('assets/uploads/category/'.$item->image)}}"   height="320px" class="img-responsive img-curve">
                                        <div class="card-body">
                                            <h5>{{$item->name}}</h5>
                                            <p class="category-text">
                                           {{$item->meta_descrip}} 
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
</div>


@endsection