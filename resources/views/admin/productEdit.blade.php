@extends('admin.layout')
@section('title', 'PRODUCTS EDIT PAGE')
{{-- font aweson cdn link --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet" />
{{-- jquery cdn link --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
@section('content')
    <div class="container" style="height: 150vh">
        <p class="text-light fs-5" style="margin-top: 100px">
            DASHBOARD <span class="fs-3">></span> PRODUCTS <span class="fs-3">></span>
            PRODUCTS  LIST
            <span class="fs-3">></span>
            <span class="text-info fs-5">
                PRODUCTS EDIT
            </span>
        </p>
        {{-- create PRODUCT success messages --}}
        @if (session('success'))
            <div class="alert w-75 mx-auto" style="margin-top: 30px;background-color:rgba(13, 78, 13, 0.651)">
                <div class="text-light fs-5">
                    <i class='fas fa-grin-beam fs-5 text-warning me-2'></i>
                    <strong>{{ session('success') }}</strong>
                    <button class="button btn-close float-end"></button>
                </div>
            </div>
        @endif
        {{-- create PRODUCT error message --}}
        @if (session('error'))
            <div class="alert w-75 mx-auto" style="margin-top: 30px;background-color:rgba(141, 8, 26, 0.87)">
                <div class="text-light fs-5">
                    <i class='fas fa-exclamation-triangle text-white'></i>
                    <strong>{{ session('error') }}</strong>
                    <button class="button btn-close float-end"></button>
                </div>
            </div>
        @endif
       {{-- PRODUCT create card --}}
     <div class="container-fluid">
        <div class="col-lg-6 offset-lg-3">
            <div class="card"  style="background-color: rgba(255, 255, 255, 0.247)">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center text-primary">Create New Product</h3>
                    </div>
                    {{-- horizontal line --}}
                    <br>
                    {{-- product form --}}
                    <form action="{{route('create.product.edit', $productData->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                          {{-- product image --}}
                          <div class="form-group mb-3">
                            <label for="" class="form-label text-info">Product Image:</label>
                            <input type="file" name="productImage"
                                class="form-control @error('productImage')  is-invalid @enderror">
                            @error('productImage')
                                <div class="text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- product name --}}
                        <div class="form-group mb-3">
                            <label for="" class="form-label text-info">Product Name:</label>
                            <input type="text" name="productName"
                                class="form-control @error('productName')  is-invalid @enderror"
                                 value="{{old('productName', $productData->name)}}">
                            @error('productName')
                                <div class="text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- product by categry --}}
                        <label for="" class="form-label text-info">Category:</label>
                        <select class="form-select form-select-lg mb-3" aria-label="Large select example"
                           name="category">
                              @foreach ($category as $category)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                          </select>
                             {{-- product by designer --}}
                        <label for="" class="form-label text-info">Designer:</label>
                        <select class="form-select form-select-lg mb-3" aria-label="Large select example"
                           name="designer">
                           @foreach ($designer as $designer)
                              <option value="{{$designer->id}}">{{$designer->name}}</option>
                              @endforeach
                          </select>
                            {{-- product price --}}
                        <div class="form-group mb-3">
                            <label for="" class="form-label text-info">Product Price:</label>
                            <input type="text" name="productPrice"
                                class="form-control @error('productPrice')  is-invalid @enderror"
                                 value="{{old('productPrice', $productData->price)}}">
                            @error('productPrice')
                                <div class="text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- category description --}}
                        <div class="form-group mb-3">
                            <label for="productDescription" class="text-info">product Description:</label>
                            <textarea name="productDescription" id="productDescription" cols="30" rows="5"
                            class="form-control @error('productDescription')  is-invalid @enderror">{{old('categoryDescription', $productData->description)}}</textarea>
                            @error('productDescription')
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
