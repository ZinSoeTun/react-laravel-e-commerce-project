@extends('admin.layout')
@section('title', 'ORDER DETAIL PAGE')
@section('content')
    <div class="main" style="padding-top: 120px">
        <p class="text-light fs-5">
            DASHBOARD <span class="fs-3">></span> ORDERS <span class="fs-3">></span>
            ORDER LIST
            <span class="fs-3">></span>
            <span class="text-info fs-5">
                ORDER DETAILS
            </span>
        </p>
        <h1 class="text-center text-primary" style="margin-top: 40px">Order Detail</h1>
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7 col-md-8 row mt-5">
                    <p class="text-center text-success fs-4">User Detail</p>
                    <div class="text-md-start text-center mb-4 mt-2 col-lg-4">
                        <img class=" img-fluid img-thumbnail" src="{{ asset('storage/user/profile/' . $data->image) }}"
                            alt="image" width="150" height="150">
                    </div>
                    <div class="text-warning text-md-start text-center col-lg-4">
                        <p class="fs-5">{{ $data->name }}</p>
                        <p class="fs-5">{{ $data->email }}</p>
                        <p class="fs-5">{{ $data->address }}</p>
                        <p class="fs-5">{{ $data->phone }}</p>
                    </div>
                </div>
                <div class="col-12 col-lg-5 col-md-4 text-info text-lg-start text-center  mt-0 mt-md-5">
                    <p class="text-center text-success fs-4">Order Detail</p>
                    <p class="fs-5">Order Number - 23467{{ $data->order_id }}</p>
                    <p class="fs-5">All Product Price - ${{ $data->allProduct_price }}</p>
                    <p class="fs-5">Shipping Price - $1000</p>
                    <p class="fs-5">Total Price - ${{ $data->total_price }}</p>
                    <p class="fs-5">Ordered Date - {{ $data->orderCreated_date }}</p>
                </div>
            </div>
            <div class="row">
                <p class="text-center text-success fs-4">Ordered Products</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col-2"> Name</th>
                            <th scope="col-2"> Image</th>
                            <th scope="col-2"> Price</th>
                            <th scope="col-2"> Quantity</th>
                            <th scope="col-2"> Total Price</th>
                        </tr>
                    </thead>
                    @foreach ($newData as $item)
                        <tbody>
                            <tr>
                                <td scope="col-2">{{ $item->name }}</td>
                                <td scope="col-2">
                                    <div class="text-md-start text-center">
                                        <img
                                            src="{{ asset('storage/product/' . $item->image) }}" alt="image"
                                            width="100" height="100">
                                    </div>
                                </td>
                                <td scope="col-2">${{ $item->price }}</td>
                                <td scope="col-2">{{ $item->qty }}</td>
                                <td scope="col-2">${{ $item->total_price}}</td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
