@extends('admin.layout')
@section('title', 'USER LIST PAGE')
{{-- font aweson cdn link --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet" />
{{-- jquery cdn link --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
@section('content')
<div class="container" style="height: 150vh">
    <p class="text-light fs-5" style="margin-top: 100px">
        DASHBOARD  <span class="fs-3">></span>  ACCOUNT  <span class="fs-3">></span>
         <span class="text-info fs-5">
             USERS LIST
         </span>
    </p>
      {{-- success messages --}}
      @if (session('success'))
      <div class="alert w-75 mx-auto" style="margin-top: 30px;background-color:rgba(13, 78, 13, 0.651)">
          <div class="text-light fs-5">
              <i class='fas fa-grin-beam fs-5 text-warning me-2'></i>
              <strong>{{ session('success') }}</strong>
              <button class="button btn-close float-end"></button>
          </div>
      </div>
  @endif

  {{-- users list table --}}
    <table class="table">
        <thead>
          <tr>
            <th scope="col-2">NAME</th>
            <th scope="col-2">ROLE</th>
            <th scope="col-2"></th>
          </tr>
        </thead>
         @foreach ($user as $user )
         <tbody>
            <tr>
              <td scope="col-2">{{$user->name}}</td>
              <td scope="col-2">{{$user->role}}</td>
              <td scope="col-2">
                  <a href="{{route('account.admin.userList.detail',$user->id)}}" title="Detail">
                  <button class="btn btn-warning me-2">
                      <i class='fas fa-folder-open'></i>
                  </button>
              </a>
                  <a href="{{route('account.admin.userList.delete',$user->id)}}" title="Delete">
                      <button class="btn btn-danger">
                          <i class='fas fa-archive'></i>
                      </button>
                  </a>
          </td>
            </tr>
          </tbody>
         @endforeach
      </table>
    </div>
    </div>
      {{-- jquery codes --}}
      <script>
        $(document).ready(function() {
            $('.button').click(function() {
                $('.alert').hide();
            });
        });
    </script>
@endsection
