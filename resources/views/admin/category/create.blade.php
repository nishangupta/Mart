@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="mb-4 d-flex justify-content-between">
    <h1 class="h3 mb-0 text-gray-800">Create Category</h1>
    <a href="{{route('category.index')}}" class="btn btn-sm btn-primary mb-4">Go back</a>
  </div>

  <div class="row">
    <div class="col-sm-12 col-md-8">
      @if($errors->any())
        <div class="alert alert-danger">
          {{ implode('', $errors->all(':message')) }}
        </div>
      @endif
      <form action="{{route('category.store')}}" method="POST">
        @csrf
          <div class="row">
            <div class="col-sm-12 col-md-8">
              <div class="form-group">
                <label for="">Category name </label>
                <small class="text-primary d-block mb-3">Category name should be all uppercase !</small>
                <input type="text" name="category" value="{{old('category')}}" class="form-control" required> 
              </div>
              <div class="form-group">
                <label for="">Sub Category name </label>
                <input name="sub_category" value="{{old('sub_category')}}" class="form-control" required>
              </div>
              <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-sm btn-primary my-3">Add Sub-Category</button>
              </div>
            </div>
          </div>
      </form>
    </div>

  </div>
</div>
@endsection