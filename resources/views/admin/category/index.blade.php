@extends('layouts.admin')

@section('content')
<div class="container-fluid ">
  
  <div class="card shadow">
    <div class="card-header py-3 d-flex justify-content-between">
      <h5 class="m-0 font-weight-bold text-primary">Category Management</h5>
      <a href="{{route('category.create')}}" class="btn btn-primary  float-right">Add a category</a>
    </div>
  
    <div class="card-body">
      <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
          <div class="table-responsive">
            @if(count($categories)>0)
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>S.N.</th>
                  <th>Title</th>
                  <th>Slug</th>
                  <th>Parent Category</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                
                @foreach($categories as $category)   
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->slug}}</td>
                        <td>
                            {{$category->parent_info->name ?? ''}}
                        </td>
                        <td>
                            @if($category->status==1)
                                <span class="badge badge-success">{{$category->status}}</span>
                            @else
                                <span class="badge badge-warning">{{$category->status}}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('category.edit',$category->id)}}" class="btn btn-primary btn-sm float-left mr-1" title="edit"><i class="fas fa-edit"></i></a>
                          <form method="POST" action="{{route('category.destroy',[$category->id])}}">
                            @csrf 
                            @method('delete')
                                <button class="btn btn-danger btn-sm dltBtn" data-id={{$category->id}}  title="Delete"><i class="fas fa-trash-alt"></i></button>
                          </form>
                        </td>
                       

                    </tr>  
                @endforeach
              </tbody>
            </table>
            <span style="float:right">{{$categories->links()}}</span>
            
            @include('admin.admin-inc.datatable-delete-modal')
            @else
              <h6 class="text-center">No Categories found!!! Please create Category</h6>
            @endif
          </div>
        </div>
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
    
    $('.dltBtn').click(function(e){
      var form=$(this).closest('form');
        var dataID=$(this).data('id');
        // alert(dataID);
        e.preventDefault();
        swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this data!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
              if (willDelete) {
                  form.submit();
              } else {
                  swal("Your data is safe!");
              }
          });
      })
  })
</script>
@endpush