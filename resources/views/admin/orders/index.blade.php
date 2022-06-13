@extends('layouts.admin')

@section('title')

    Orders
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class = 'text-white'>New Orders
                        <a href="{{url('order-history')}}" class="btn btn-outline-warning text-white float-right">Order History
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                  
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Order Date</th>
                                <th>Tracking Number</th>
                                <th>total Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1; @endphp
                            @foreach ($orders as $order)
                            <tr>
                                <td width = "1px">{{$i++}}</td>
                                <td>{{date('d-m-y H:m:s', strtotime($order->created_at))}}</td>
                                <td>{{$order->tracking_no}}</td>
                                <td>{{$order->total_price}}</td>
                                <td>{{$order->status == '0' ? 'Pending' : 'Completed'}}</td>
                                <td>
                                    <a href="{{url('admin/view-order/'.$order->id)}}" class="btn btn-sm btn-primary">View</a>
                                </td>
                            </tr>
                            @endforeach
                      
                        </tbody>
                    </table>
                </div>
            </div>   
        </div>
    </div>
</div>


@endsection