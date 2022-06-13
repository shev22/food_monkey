@extends('layouts.inc.front')

@section('title')
    {{ $category->name }}
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0 text-black">Collections / <a class="text-black text-decoration-underline"
                    href="{{ url('category') }}">Category</a> /<a class="text-black text-decoration-underline"
                    href="">{{ $category->name }}</a></h6>
        </div>
    </div>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>{{ $category->name }}</h2>
                @foreach ($products as $prod)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <a class="text-black" href="{{ url('category/' . $category->slug . '/' . $prod->slug) }}">
                                <img src="{{ asset('assets/uploads/products/' . $prod->image) }}" height="140px">

                                <div class="card-body">
                                    <h6>{{ $prod->name }} <br><span class="float-start">
                                            ₦{{ $prod->selling_price }}.{{ rand(10, 99) }}k</span></h6>
                                    <br>
                                    <p class="category-text">
                                        {{ $prod->small_description }}
                                    </p>
                                </div>

                        </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
