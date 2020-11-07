@extends('layouts.app')

@section('page-title','User Account')

@section('content')
<div class="container-fluid py-3" style="min-height: 80vh">
  <div class="row no-gutters">

    <div class="col-xl-2 col-md-2 col-sm-12 ml-auto">
      @include('inc.app.user-sidebar')
    </div>

    <div class="col-xl-8 col-md-8 col-sm-12 mr-auto">
      <div class="card shadow">
        <div class="card-header bg-light border-bottom">
          <p class="mb-0 ">My Orders</p>
        </div>

        <div class="card-body" style="min-height: 40vh">
             
          <div class="table-responsive">
            <table class="table table-hover table-striped">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Title</th>
                  <th>Order number</th>
                  <th>Quantity</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if($orders->count())
                  @foreach($orders as $order)
                    <tr>
                      <td><img src="{{asset($order->product->productImage->first()->thumbnail)}}" width="50px" alt=""></td>
                    <td><a href="{{$order->product->path()}}">{{$order->product->title}}</a></td>
                      <td>{{$order->order_number}}</td>
                      <td>{{$order->quantity}}</td>
                      <td><span class="badge badge-info">{{$order->status}}</span></td>
                      <td>
                        <form action="{{route('myOrder.destroy',['id'=>$order])}}" method="POST">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-danger btn-sm">Cancel</a>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                @else
                <tr>
                  <td>You haven't placed any order </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <a href="{{route('shop.catalog')}}" class="btn btn-orange btn-sm">Find products for your match</a>
                @endif
              </tbody>
            </table>
          </div>
          <div class="d-flex justify-content-center">
            {{$orders->links()}}
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection