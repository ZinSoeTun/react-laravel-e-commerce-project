@extends('admin.layout')
@section('title', 'USER DETAIL PAGE')
@section('content')
     <div class="main" style="padding-top: 120px">
        <p class="text-light fs-5">
            DASHBOARD  <span class="fs-3">></span>  ACCOUNT  <span class="fs-3">></span>
            USER LIST <span class="fs-3">></span>
             <span class="text-info fs-5">
                USER DETAIL
             </span>
        </p>
       <div class="card mb-3 mx-auto" style="width: 25rem;background-color:rgba(18, 160, 66, 0.315)">
        {{-- admin detail --}}
            @if ($userDetail->image !== Null)
            {{-- admin image --}}
            <div class="text-center mb-4">
                <img class=" img-fluid img-thumbnail mt-3"
                    src="{{ asset('storage/user/' . $userDetail->image) }}" alt="image"
                    width="150" height="150">
            </div>
        @else
        <div class="text-center mb-4 mt-3">
            <img src="{{ asset('admin/img/noimage.png') }}" alt="noimage" width="150"
                height="150">
        </div>
        @endif
       {{-- admin data --}}
       <div class="card-body text-center text-primary">
        <div class="row mt-3">
            <div class="ms-lg-5 text-warning col-lg-5 fs-5  col-md-6 ">ID</div>
            <div class="col-lg-5 col-md-6 text-light text-md-start fs-5 text-center">{{ $userDetail->id }}</div>
        </div>
        <div class="row mt-3">
            <div class="ms-lg-5 text-warning col-lg-5 fs-5  col-md-6 ">Name</div>
            <div class="col-lg-5 col-md-6 text-light text-md-start fs-5 text-center">{{ $userDetail->name }}</div>
        </div>
        <div class="row mt-3">
            <div class="ms-lg-5 text-warning col-lg-5 fs-5  col-md-6 ">Role</div>
            <div class="col-lg-5 col-md-6 text-light text-md-start fs-5 text-center">{{ $userDetail->role }}</div>
        </div>
        <div class="row mt-3">
            <div class="ms-lg-5 text-warning col-lg-5 fs-5  col-md-6 ">Email</div>
            <div class="col-lg-5 col-md-6 text-light text-md-start fs-5 text-center">{{ $userDetail->email }}</div>
        </div>
        <div class="row mt-3">
            <div class="ms-lg-5 text-warning col-lg-5 fs-5  col-md-6 ">Phone</div>
            <div class="col-lg-5 col-md-6 text-light text-md-start fs-5 text-center">{{ $userDetail->phone }}</div>
        </div>
        <div class="row mt-3">
            <div class="ms-lg-5 text-warning col-lg-5 fs-5  col-md-6 ">Address</div>
            <div class="col-lg-5 col-md-6 text-light text-md-start fs-5 text-center">{{ $userDetail->address }}
            </div>
        </div>
    </div>
      </div>
     </div>
@endsection
