@extends('admin.layout')
@section('title', 'ROOM DETAIL PAGE')
@section('content')
    <div class="main" style="padding-top: 120px">
        <p class="text-light fs-5">
            DASHBOARD <span class="fs-3">></span> ROOMS <span class="fs-3">></span>
            ROOMS LIST
            <span class="fs-3">></span>
            <span class="text-info fs-5">
                ROOMS DETAIL
            </span>
        </p>
        <div class=" mb-3 row">
            <div class="col-lg-4 col-md-4 p-3">
                {{-- room detail --}}
                @if ($roomData->image !== null)
                    {{-- room image --}}
                    <div class="text-center mb-4">
                        <img class=" img-fluid img-thumbnail mt-3" src="{{ asset('storage/room/' . $roomData->image) }}"
                            alt="image" width="150" height="150">
                    </div>
                @else
                    <div class="text-center mb-4 mt-3">
                        <img src="{{ asset('admin/img/noimage.png') }}" alt="noimage" width="150" height="150">
                    </div>
                @endif
                <h5 class="text-warning text-center">ID</h5>
                <h5 class="text-primary text-center">{{ $roomData->id }}</h5>
                <h5 class="text-warning text-center">Type</h5>
                <h5 class="text-primary text-center">{{ $roomData->type_name }}</h5>
            </div>
                {{-- room data --}}
                <div class="col-lg-7 col-md-8 text-center text-primary p-3">
                    <h5 class=" text-warning">Description</h5>
                    <p class="fs-5" style="word-break: break-all"> {{ $roomData->description }}</p>
                    <h5 class=" text-warning">Created Date</h5>
                    <p class="fs-5"> {{ $roomData->created_at }}</p>
                </div>
            </div>
        </div>
    @endsection
