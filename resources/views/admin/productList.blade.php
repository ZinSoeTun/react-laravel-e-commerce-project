@extends('admin.layout')
@section('title', 'PRODUCT LIST PAGE')
{{-- font aweson cdn link --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet" />
{{-- jquery cdn link --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
@section('content')
<div class="container" style="height: 150vh">
    <p class="text-light fs-5" style="margin-top: 100px">
       DASHBOARD  <span class="fs-3">></span>  PRODUCTS  <span class="fs-3">></span>
        <span class="text-info fs-5">
            PRODUCTS LIST
        </span>
   </p>
    {{-- create success messages --}}
    @if (session('success'))
    <div class="alert w-75 mx-auto" style="margin-top: 30px;background-color:rgba(13, 78, 13, 0.651)">
        <div class="text-light fs-5">
            <i class='fas fa-grin-beam fs-5 text-warning me-2'></i>
            <strong>{{ session('success') }}</strong>
          <button  class="button btn-close float-end" ></button>
        </div>
      </div>
      @endif
      <h1 class="text-center text-primary">Product Data - {{ $productData->total() }}</h1>
      {{-- if there is no  data --}}
@if (count($productData) == 0)
<h2 class="text-center mt-5">There is no <span class="text-danger">Room Data!</span></h2>
@else
    {{-- products table --}}
    <table class="table">
        <thead>
          <tr>
            <th scope="col-2">NAME</th>
            <th scope="col-3"></th>
          </tr>
        </thead>
        @foreach ($productData as $product)
        <tbody>
            <tr>
              <td scope="col-2">{{$product->name}}</td>
              <td scope="col-3">
                <a href="{{route('edit.product',$product->id)}}" title="edit">
                    <button class="btn btn-warning me-2">
                        <i class='fas fa-edit'></i>
                    </button>
                </a>
                  <a href="{{route('product.detail',$product->id)}}" title="Detail">
                  <button class="btn btn-success me-2">
                      <i class='fas fa-folder-open'></i>
                  </button>
              </a>
                  <a href="{{route('product.delete',$product->id)}}" title="Delete">
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
        {{$productData->links() }}
    </div>
      @endif
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
