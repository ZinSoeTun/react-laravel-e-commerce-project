@extends('admin.layout')
@section('title', 'PRODUCTS DETAIL PAGE')
@section('content')
    <div class="main" style="padding-top: 120px">
        <p class="text-light fs-5">
            DASHBOARD <span class="fs-3">></span> PRODUCTS <span class="fs-3">></span>
            PRODUCTS LIST
            <span class="fs-3">></span>
            <span class="text-info fs-5">
                PRODUCTS DETAIL
            </span>
        </p>
        <div class=" mb-3 mx-auto row pb-4" >
            <div class="col-lg-4 col-md-4">
                {{-- product detail --}}
                @if ($productData->image !== null)
                    {{-- product image --}}
                    <div class="text-center mb-4">
                        <img class=" img-fluid img-thumbnail mt-3"
                            src="{{ asset('storage/product/' . $productData->image) }}" alt="image" width="300"
                            height="300">
                    </div>
                @else
                    <div class="text-center mb-4 mt-3">
                        <img src="{{ asset('admin/img/noimage.png') }}" alt="noimage" width="300" height="300">
                    </div>
                @endif
            </div>
            {{-- category data --}}
            <div class="col-lg-7 col-md-8 text-center text-primary row">
              <div class="col-lg-5 col-md-5">
                <h5 class="card-title text-warning">ID</h5>
                <h5 class="card-title mb-3">{{ $productData->id }}</h5>
                <h5 class="card-title text-warning">Name</h5>
                <h5 class="card-title mb-3">{{ $productData->name }}</h5>
                <h5 class="card-title text-warning">Price</h5>
                <h5 class="card-title mb-3">{{ $productData->price }}</h5>
              </div>
                 <div class="col-lg-5 col-md-5">
                    <h5 class="card-title text-warning">Category</h5>
                    <h5 class="card-title mb-3">{{ $productData->category->name }}</h5>
                    <h5 class="card-title text-warning">designer</h5>
                    <h5 class="card-title mb-3">{{ $productData->designer->name }}</h5>
                    <h5 class="card-title text-warning">Created Date</h5>
                    <p class="fs-5 mb-3"> {{ $productData->created_at }}</p>
                 </div>
                <h5 class="card-title text-warning">Description</h5>
                <p class="fs-5"  style="word-break: break-all"> {{ $productData->description }}</p>
            </div>
        </div>
    </div>
@endsection
