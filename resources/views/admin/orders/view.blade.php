@extends('layouts.admin')

@section('title')
    Order View
@endsection

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">New Orders
                            <a href="{{ url('order-history') }}" class="btn btn-outline-warning text-white float-end">Order
                                History
                            </a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order-details">
                                <h4>Shipping Details</h4>
                                <hr>
                                <label for="">First Name</label>
                                <div class="border ">{{ $orders->fname }}</div>
                                <label for="">Last Name</label>
                                <div class="border ">{{ $orders->lname }}</div>
                                <label for="">Email</label>
                                <div class="border ">{{ $orders->email }}</div>
                                <label for="">Phone №</label>
                                <div class="border ">{{ $orders->phone }}</div>
                                <label for="">Shipping Address</label>
                                <div class="border ">{{ $orders->address }}</div>
                            </div>
                            <div class="col-md-6">
                                <h4>Order Details</h4>
                                <hr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders->orderitems as $order)
                                            <tr>
                                                <td>{{ $order->products->name }}</td>
                                                <td>{{ $order->qty }}</td>
                                                <td>{{ $order->price }}</td>
                                                <td>
                                                    <img src="{{ asset('assets/uploads/products/' . $order->products->image) }}"
                                                        width="50px" alt="">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h4 class="px-2"><span class="float-end">Total:
                                        ₦{{ $orders->total_price }}.00k</span> </h4>

                                <div class="mt-5 p-2">
                                    <label for="">Order Status</label>

                                    <form action="{{ url('update-order/' . $orders->id) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <select class="form-select" name="order_status">
                                            <option {{ $orders->status == '0' ? 'selected' : '' }}value="0">Pending</option>
                                            <option {{ $orders->status == '1' ? 'selected' : '' }}value="1">Completed
                                            </option>
                                        </select>
                                        <button type="submit" class="btn btn-primary mt-3 btn-sm float-end">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
