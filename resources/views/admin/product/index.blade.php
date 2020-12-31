@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <a href="{{route('product.create')}}" class="btn btn-primary mb-4">Add a Product</a>

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
          <tbody></tbody>
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
  processing:true,
  serverSide:true,
  ajax:"{{route('product.all')}}",
    columns:[
      {data:'id'},
      {data:'title'},
      {data:'product_code'},
      {data:'price',orderable:false,searchable:false},
      {data:'sale_price',orderable:false,searchable:false},
      {data:'onSale',searchable:false},
      {data:'stock',orderable:false,searchable:false},
      {data:'live',searchable:false},
      {data:'actions',orderable:false,searchable:false},
    ]
  });

})

</script>
@endpush