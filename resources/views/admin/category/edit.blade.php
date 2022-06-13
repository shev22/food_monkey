@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
            <h4>Edit/Update Category</h4>
    </div>
    <div class="card-body">
        <form action="{{url('update-category/'.$category->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-md-6 md-3">
                    <label for="">Name</label>
                    <input type="text" value = "{{$category->name}}" class="form-control" name="name">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Slug</label>
                    <input type="text"  value = "{{$category->slug}}" class="form-control" name="slug">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Description</label>
                    <textarea name="description"  cols="30" rows="5" class="form-control">{{$category->desrip}}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Status</label>
                    <input type="checkbox" {{$category->status == '1' ? 'checked': ''}} name="status">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Porpular</label>
                    <input type="checkbox" {{$category->popular == '1' ? 'checked': ''}}  name="popular">
                </div>
                <div class="col-md-12  mb-3">
                    <label for="">Meta_title</label>
                    <input type="text"  value = "{{$category->title}}" class="form-control" name="meta_title">
                </div>
                <div class="col-md-12  mb-3">
                    <label for="">Meta_keywords</label>
                    <textarea name="meta_keywords"  cols="30" rows="5" class="form-control">{{$category->meta_keywords}}</textarea>
                </div>
                <div class="col-md-12  mb-3">
                    <label for="">Meta_description</label>
                    <textarea name="meta_descrip"  cols="30" rows="5" class="form-control">{{$category->desctip}}</textarea>
                </div>
                @if($category->image)
                    <img src="{{asset('assets/uploads/category/'.$category->image)}}"  width="150px" height="150px">
                @endif    
                <div class="col-md-12">
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>              
        </form>
    </div>
</div>

@endsection