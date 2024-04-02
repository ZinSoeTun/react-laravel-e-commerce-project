@extends('admin.layout')
@section('title', 'ORDER LIST PAGE')
@section('content')
<div class="container" style="height: 150vh">
<p class="text-light fs-5" style="margin-top: 100px">
    DASHBOARD  <span class="fs-3">></span>  ORDERS  <span class="fs-3">></span>
     <span class="text-info fs-5">
         ORDERS LIST
     </span>
  <h1 class="text-center text-primary">Order Data - {{ $orderData->total() }}</h1>
  {{-- if there is no  data --}}
  @if (count($orderData) == 0)
  <h2 class="text-center mt-5 text-primary">There is no <span class="text-danger">Order Data!</span></h2>
@else
 {{-- orders table --}}
 <table class="table">
    <thead>
      <tr>
        <th scope="col-2">User ID</th>
        <th scope="col-3">Total price</th>
        <th scope="col-3"></th>
      </tr>
    </thead>
      @foreach ($orderData as $order)
      <tbody>
        <tr>
          <td scope="col-2">{{$order->user_id}}</td>
          <td scope="col-2">${{$order->productPrice_shipping}}</td>
          <td scope="col-3">
              <a href="{{route('order.list.orderlist.detail',$order->user_id)}}" title="Detail">
              <button class="btn btn-success me-2">
                  <i class='fas fa-folder-open'></i>
              </button>
          </a>
          <a href="{{ route('order.list.orderlist.delete', ['id' => $order->id, 'userId' => $order->user_id]) }}" title="Delete">
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
    {{$orderData->links() }}
</div>
  @endif
</div>
@endsection

