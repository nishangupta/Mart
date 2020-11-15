@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="mb-4 d-flex justify-content-between">
    <h1 class="h3 mb-0 text-gray-800">Edit Category</h1>
    <a href="{{route('category.index')}}" class="btn btn-primary mb-4">Go back</a>
  </div>

  <div class="row">

    <div class="col-sm-12 col-md-8">
      @if($errors->any())
        <div class="alert alert-danger">
          {{ implode('', $errors->all(':message')) }}
        </div>
      @endif
      <form action="{{route('category.update',['id'=>$category])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-sm-12 col-md-8">
            <div class="form-group">
              <label for="">Category name</label>
              <small class="text-primary d-block mb-3">Category name should be camelCase !</small>
              <input type="text" name="category" value="{{$category->category_name}}" class="form-control" required autofocus>  
            </div>
            <div class="form-group">
              <label for="">Add Sub Category name</label>
              <input type="text"  value="{{old('sub_category')}}" name="sub_category" class="form-control">
            </div>
            <div class="d-flex justify-content-between">
              <button type="submit" class="btn btn-primary my-3">Update</button>
            </div>
          </div>
        </div>
      </form>
     
      <form action="{{route('category.destroy',['id'=>$category])}}" id="deleteCategoryForm" method="POST" class="mt-5">
        @csrf
        @method('delete')
        <button id="deleteCategoryBtn" class="btn btn-danger">Delete Category</button>
      </form>
    </div>

    <div class="col-sm-12 col-md-4">
      <ul class="list-group mb-2">
        <li class="list-group-item bg-primary text-white">
          <h5>{{$category->category_name}}</h5>
        </li>
        <ul class="list-group small">
          @foreach($category->subCategory as $item)
          <li class="list-group-item list-group-item-action">{{$item->subCategory_name}} <a href="{{route('category.removeSubCategory',['subCategory'=>$item])}}"><i class="fas fa-trash-alt float-right text-danger"></i></a></li>
          @endforeach
        </ul>
      </ul>

    </div>

  </div>
</div>
@endsection

@push('js')
<script>
$(document).ready(function(){
  $('#deleteCategoryBtn').click(function(e){
    e.preventDefault();
    if(confirm('Are you sure you want to delete the category?')){
      $('#deleteCategoryForm').submit();
    }
  });
});

</script>    
@endpush