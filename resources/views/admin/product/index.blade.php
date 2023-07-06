<?php
/** @var \App\Models\Product $product */
?>
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <a href="{{ route('product.create') }}" class="btn btn-primary mb-4">Add a Product</a>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Product Management</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-bordered small" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Id</th>
              <th>Title</th>
              <th>Code</th>
              <th>Price</th>
              <th>SalePrice</th>
              <th>onSale</th>
              <th>Stock</th>
              <th>Live</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @if($products->count() > 0)
              @foreach($products as $product)
              <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->product_code }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->sale_price }}</td>
                <td>{{ $product->onSale ? 'Yes' : 'No' }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->live ? 'Yes' : 'No' }}</td>

              </tr>
              @endforeach
            @else
              <h6 class="text-center">No Products found!!! Please create Product</h6>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
@endsection

@push('js')
<script>
$(document).ready(function(){
  $('#dataTable').dataTable({
    // processing:true,
  });
});
</script>
@endpush
