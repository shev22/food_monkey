@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-body">
            <h1>Category</h1>
            <hr>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->description}}</td>
                    <td>
                        <img src="{{asset('assets/uploads/category/'.$item->image)}}" class="cate-image" >
                    </td>
                    <td width = "150px">
                        <a href="{{url('edit-category/'.$item->id)}}" class="btn  btn-primary btn-sm">Edit</a>
                        <a href="{{url('delete-category/'.$item->id)}}" class="btn btn-danger btn-sm "><i class="fa fa-trash">  </i> </a>
                      
                    </td>
                   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection