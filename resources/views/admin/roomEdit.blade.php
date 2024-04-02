@extends('admin.layout')
@section('title', 'ROOM EDIT PAGE')
{{-- font aweson cdn link --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet" />
{{-- jquery cdn link --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
@section('content')
<div class="container" style="height: 150vh">
    <p class="text-light fs-5" style="margin-top: 100px">
       DASHBOARD  <span class="fs-3">></span>   ROOMS  <span class="fs-3">></span>
        ROOMS LIST
          <span class="fs-3">></span>
        <span class="text-info fs-5">
           ROOMS  EDIT
        </span>
   </p>
    {{-- create room success messages --}}
    @if (session('success'))
    <div class="alert w-75 mx-auto" style="margin-top: 30px;background-color:rgba(13, 78, 13, 0.651)">
        <div class="text-light fs-5">
            <i class='fas fa-grin-beam fs-5 text-warning me-2'></i>
            <strong>{{ session('success') }}</strong>
          <button  class="button btn-close float-end" ></button>
        </div>
      </div>
      @endif
       {{-- create room error message --}}
      @if (session('error'))
      <div class="alert w-75 mx-auto" style="margin-top: 30px;background-color:rgba(141, 8, 26, 0.87)">
          <div class="text-light fs-5">
            <i class='fas fa-exclamation-triangle text-white'></i>
              <strong>{{ session('error') }}</strong>
            <button  class="button btn-close float-end" ></button>
          </div>
        </div>
        @endif
      {{-- room create card --}}
      <div class="container-fluid">
        <div class="col-lg-6 offset-lg-3">
            <div class="card"  style="background-color: rgba(255, 255, 255, 0.247)">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center text-primary">Update Room</h3>
                    </div>
                    {{-- horizontal line --}}
                    <br>
                    {{-- room form --}}
                    <form action="{{route('create.room.edit', $roomData->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                          {{-- room image --}}
                          <div class="form-group mb-3">
                            <label for="" class="form-label text-info">room Image:</label>
                            <input type="file" name="roomImage"
                                class="form-control @error('roomImage')  is-invalid @enderror">
                            @error('roomImage')
                                <div class="text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- room name --}}
                        <div class="form-group mb-3">
                            <label for="" class="form-label text-info">Room-Type Name:</label>
                            <input type="text" name="roomName"
                                class="form-control @error('roomName')  is-invalid @enderror"
                                 value="{{old('roomName', $roomData->type_name)}}">
                            @error('roomName')
                                <div class="text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- room description --}}
                        <div class="form-group mb-3">
                            <label for="roomDescription" class="text-info">Room Description:</label>
                            <textarea name="roomDescription" id="roomDescription" cols="30" rows="5"
                            class="form-control @error('roomDescription')  is-invalid @enderror">{{old('categoryDescription', $roomData->description)}}</textarea>
                            @error('roomDescription')
                                <div class="text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- button for card --}}
                        <div class="text-center">
                            <input type="submit" value="edit" class="btn btn-warning px-3">
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
