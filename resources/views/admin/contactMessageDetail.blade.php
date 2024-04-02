@extends('admin.layout')
@section('title', 'ORDER DETAIL PAGE')
@section('content')
    <div class="main" style="padding-top: 120px">
        <p class="text-light fs-5">
            DASHBOARD <span class="fs-3">></span> CONTACT MESSAGE <span class="fs-3">></span>
            CONTACT MESSAGE LIST
            <span class="fs-3">></span>
            <span class="text-info fs-5">
                CONTACT MESSAGE DETAILS
            </span>
        </p>
        <h1 class="text-center text-primary" style="margin-top: 40px">Contact Message Detail</h1>
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 col-md-5 row mt-5 text-info text-lg-start text-center">
                    <p class="fs-5">First Name : <span class="text-warning">{{ $mesDetail->firstName }}</span></p>
                    <p class="fs-5">Sur Name : <span class="text-warning">{{ $mesDetail->surName }}</span></p>
                    @if ($mesDetail->phone)
                        <p class="fs-5">Phone : <span class="text-warning">{{ $mesDetail->phone }}</span></p>
                    @endif
                    @if ($mesDetail->streetAddress)
                        <p class="fs-5"> Street Address : <span
                                class="text-warning">{{ $mesDetail->streetAddress }}</span></p>
                    @endif
                    @if ($mesDetail->city)
                        <p class="fs-5">City : <span class="text-warning">{{ $mesDetail->city }}</span></p>
                    @endif
                </div>
                <div class="col-12 col-lg-6 col-md-5 text-info text-lg-start text-center  mt-0 mt-md-5">
                    <p class="fs-5"> Email: <span class="text-warning">{{ $mesDetail->email }}</span></p>
                    <p class="fs-5"> Country : <span class="text-warning">{{ $mesDetail->country }}</span></p>
                    @if ($mesDetail->orderNumber)
                        <p class="fs-5">Order Number : <span class="text-warning">{{ $mesDetail->orderNumber }}</span>
                        </p>
                    @endif
                    @if ($mesDetail->postcode)
                        <p class="fs-5">Postcode : <span class="text-warning">{{ $mesDetail->postcode }}</span></p>
                    @endif
                </div>
                <div class="col-12  text-info">
                    @if ($mesDetail->message)
                        <p class="fs-5"> Message: <span class="text-warning">{{ $mesDetail->message }}</span></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
