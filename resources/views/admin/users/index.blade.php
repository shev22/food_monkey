@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-body">
            <h1>Registered Users</h1>
            <hr>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $users  as $item)
                <tr>
                    <td>{{ $item ->id}}</td>
                    <td>{{ $item ->fname.' '.$item ->lname}}</td>
                    <td>{{ $item ->email}}</td>
                    <td>{{ $item ->phone}}</td>
                    <td>
                        <a href="{{url('view-users/'.$item->id)}}" class="btn btn-primary btn-sm">View User</a>
                    </td>
                    <td>
                        <a href="" class="btn btn-primary btn-sm">Edit</a>
                        <a href="" class="btn btn-danger btn-sm">Delete</a>
                      
                    </td>
                   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection