@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
            <h4>add Category</h4>
    </div>
    <div class="card-body">
        <form action="{{url('insert-category')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 md-3">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Slug</label>
                    <input type="text" class="form-control" name="slug">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Description</label>
                    <textarea name="description"  cols="30" rows="5" class="form-control"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Status</label>
                    <input type="checkbox" name="status">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Porpular</label>
                    <input type="checkbox" name="popular">
                </div>
                <div class="col-md-12  mb-3">
                    <label for="">Meta_title</label>
                    <input type="text" class="form-control" name="meta_title">
                </div>
                <div class="col-md-12  mb-3">
                    <label for="">Meta_keywords</label>
                    <textarea name="meta_keywords"  cols="30" rows="5" class="form-control"></textarea>
                </div>
                <div class="col-md-12  mb-3">
                    <label for="">Meta_description</label>
                    <textarea name="meta_descrip"  cols="30" rows="5" class="form-control"></textarea>
                </div>
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