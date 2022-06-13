@extends('layouts.admin')

@section('content')
    <div class="card py-4">
        <div class="card-body">
            <h1>Welcome, {{ Auth::user()->fname . ' ' . Auth::user()->lname }}</h1>
            <hr>
        </div>

        <div class="dashboard-container">

            <div class="dashboard-box1">

                <p class="dash-text">Total Categories : {{$category}}</p>

            </div>
            <div class="dashboard-box2">

                <p class="dash-text">Total Products :  {{$products}}</p>

            </div>
            <div class="dashboard-box3">

                <p class="dash-text3">Total Users :  {{$users}}</p>

            </div>
            <div class="dashboard-box4">

                <p class="dash-text">Total Orders :  {{$orders}}</p>

            </div>
            <div class="dashboard-box5">

                <p class="dash-text">Pending Orders : {{$pending_orders}}</p>

            </div>
            <div class="dashboard-box6">

                <p class="dash-text">Completed Orders : {{$completed_orders}}</p>

            </div>
        </div>
    </div>
   
   
@endsection
