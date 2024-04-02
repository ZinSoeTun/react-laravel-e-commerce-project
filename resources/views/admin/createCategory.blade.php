@extends('admin.layout')
@section('title', 'CREATE CATEGORY PAGE')
{{-- font aweson cdn link --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet" />
{{-- jquery cdn link --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
@section('content')
      <div class="container" style="height: 150vh">
         <p class="text-light fs-5" style="margin-top: 100px">
            DASHBOARD  <span class="fs-3">></span>  CATEGORIES  <span class="fs-3">></span>
             <span class="text-info fs-5">
                CREATE CATEGORIES
             </span>
        </p>
          {{-- create category success messages --}}
          @if (session('success'))
          <div class="alert w-75 mx-auto" style="margin-top: 30px;background-color:rgba(13, 78, 13, 0.651)">
              <div class="text-light fs-5">
                  <i class='fas fa-grin-beam fs-5 text-warning me-2'></i>
                  <strong>{{ session('success') }}</strong>
                <button  class="button btn-close float-end" ></button>
              </div>
            </div>
            @endif
             {{-- create category error message --}}
            @if (session('error'))
            <div class="alert w-75 mx-auto" style="margin-top: 30px;background-color:rgba(141, 8, 26, 0.87)">
                <div class="text-light fs-5">
                  <i class='fas fa-exclamation-triangle text-white'></i>
                    <strong>{{ session('error') }}</strong>
                  <button  class="button btn-close float-end" ></button>
                </div>
              </div>
              @endif
         {{-- Category create card --}}
         <div class="container-fluid">
            <div class="col-lg-6 offset-lg-3">
                <div class="card"  style="background-color: rgba(255, 255, 255, 0.247)">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center text-primary">Create New Ctegory</h3>
                        </div>
                        {{-- horizontal line --}}
                        <br>
                        {{-- category form --}}
                        <form action="{{route('create.category.function')}}" method="post" enctype="multipart/form-data">
                            @csrf
                              {{-- category image --}}
                              <div class="form-group mb-3">
                                <label for="" class="form-label text-info">Category Image:</label>
                                <input type="file" name="categoryImage"
                                    class="form-control @error('categoryImage')  is-invalid @enderror">
                                @error('categoryImage')
                                    <div class="text-danger">
                                        *{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- category name --}}
                            <div class="form-group mb-3">
                                <label for="" class="form-label text-info">Category Name:</label>
                                <input type="text" name="categoryName"
                                    class="form-control @error('categoryName')  is-invalid @enderror"
                                     value="{{old('categoryName')}}">
                                @error('categoryName')
                                    <div class="text-danger">
                                        *{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- category description --}}
                            <div class="form-group mb-3">
                                <label for="categoryDescription" class="text-info">Category Description:</label>
                                <textarea name="categoryDescription" id="categoryDescription" cols="30" rows="5"
                                class="form-control @error('categoryDescription')  is-invalid @enderror">{{old('categoryDescription')}}</textarea>
                                @error('categoryDescription')
                                    <div class="text-danger">
                                        *{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- button for card --}}
                            <div class="text-center">
                                <input type="submit" value="create" class="btn btn-primary px-3">
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
