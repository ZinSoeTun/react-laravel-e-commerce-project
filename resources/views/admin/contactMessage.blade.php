@extends('admin.layout')
@section('title', 'CONTACT MESSAGE PAGE')
@section('content')
<div class="container" style="height: 150vh">
<p class="text-light fs-5" style="margin-top: 100px">
    DASHBOARD  <span class="fs-3">></span>  CONTACT MESSAGE  <span class="fs-3">></span>
     <span class="text-info fs-5">
         CONTACT MESSAGE LIST
     </span>
  <h1 class="text-center text-primary">Message - {{ $message->total() }}</h1>
  {{-- if there is no  data --}}
  @if (count($message) == 0)
  <h2 class="text-center mt-5">There is no <span class="text-danger">Message!</span></h2>
@else
 {{-- orders table --}}
 <table class="table">
    <thead>
      <tr>
        <th scope="col-2">First Name</th>
        <th scope="col-3">Sur Name</th>
        <th scope="col-2">Email</th>
        <th scope="col-3"></th>
      </tr>
    </thead>
      @foreach ($message as $conMess)
      <tbody>
        <tr>
          <td scope="col-2">{{$conMess->firstName}}</td>
          <td scope="col-2">{{$conMess->surName}}</td>
          <td scope="col-2">{{$conMess->email}}</td>
          <td scope="col-3">
            <a href="{{route('create.contact.message.detail',$conMess->id)}}" title="Detail">
                <button class="btn btn-success me-2">
                    <i class='fas fa-folder-open'></i>
                </button>
            </a>
              <a href="{{route('create.contact.message.delete',$conMess->id)}}" title="Delete">
                  <button class="btn btn-danger">
                      <i class='fas fa-archive'></i>
                  </button>
              </a>
      </td>
        </tr>
      </tbody>
      @endforeach
  </table>
  <div class="mt-5">
    {{$message->links() }}
</div>
  @endif
</div>
@endsection

