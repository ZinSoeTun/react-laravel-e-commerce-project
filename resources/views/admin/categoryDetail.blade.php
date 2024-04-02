@extends('admin.layout')
@section('title', 'CATEGORY DETAIL PAGE')
@section('content')
    <div class="main" style="padding-top: 120px">
        <p class="text-light fs-5">
            DASHBOARD <span class="fs-3">></span> CATEGORIES <span class="fs-3">></span>
            CATEGORIES LIST
            <span class="fs-3">></span>
            <span class="text-info fs-5">
                CATEGORIES DETAIL
            </span>
        </p>
        <div class="mb-3  row">
            <div class="col-lg-4 col-md-4 p-3">
                {{-- category detail --}}
                @if ($categoryData->image !== null)
                    {{-- category image --}}
                    <div class="text-center mb-4">
                        <img class=" img-fluid img-thumbnail mt-3"
                            src="{{ asset('storage/category/' . $categoryData->image) }}" alt="image" width="150"
                            height="150">
                    </div>
                @else
                    <div class="text-center mb-4 mt-3">
                        <img src="{{ asset('admin/img/noimage.png') }}" alt="noimage" width="150" height="150">
                    </div>
                @endif
                <h5 class="text-warning text-center">ID</h5>
                <h5 class="text-primary text-center">{{ $categoryData->id }}</h5>
                <h5 class="text-warning text-center">Name</h5>
                <h5 class="text-primary text-center">{{ $categoryData->name }}</h5>
            </div>
            {{-- category data --}}
            <div class="col-lg-7 col-md-8 text-center text-primary">
                <h5 class="text-warning">Description</h5>
                <p class="fs-5 mb-3" style="word-break: break-all"> {{ $categoryData->description }}</p>
                <h5 class="text-warning">Created Date</h5>
                <p class="fs-5 mb-3"> {{ $categoryData->created_at }}</p>
            </div>
        </div>
    </div>
@endsection
