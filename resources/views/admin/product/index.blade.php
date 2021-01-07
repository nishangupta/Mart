@extends('layouts.admin')

@section('content')
<div class="container-fluid">

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Product Management</h6>
      <a href="{{route('product.create')}}" class="btn btn-sm float-right btn-primary">Add a Product</a>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-bordered small" id="dataTable">
          <thead>
            <tr>
              <th>Id</th>
              <th>Title</th>
              <th>Code</th>
              <th>Price</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
            <tr>
              <td>{{$product->id}}</td>
              <td>{{$product->title}}</td>
              <td>{{$product->product_code}}</td>
              <td>{{$product->price}}</td>
              <td>{{$product->price}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$products->links()}}</span>

        @include('admin.admin-inc.datatable-delete-modal')
      </div>
    </div>
  </div>

</div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<style>
  div.dataTables_wrapper div.dataTables_paginate{
      display: none;
  }
</style>

@endpush

@push('js')
<script>
  $(document).ready(function(){
    $('#dataTable').DataTable();
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Sweet alert deleting modal
    $(".dltBtn").click(function(e) {
        var form = $(this).closest("form");
        var dataID = $(this).data("id");
        // alert(dataID);
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then(willDelete => {
            if (willDelete) {
                form.submit();
            } else {
                swal("Your data is safe!");
            }
        });
    });
  })
</script>
@endpush