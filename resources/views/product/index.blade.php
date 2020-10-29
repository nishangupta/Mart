@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  
  <div class="row mb-4">
      <h1 class="h3 mb-0 text-gray-800">Product Management</h1>
  </div>
  <a href="{{route('category.create')}}" class="btn btn-primary mb-4">Add a Product</a>

  <div class="row">
    <div class="col-xl-12 col-md-12 mb-4">
      <div class="row h-100">
          {{-- @foreach($categories as $category)
          <div class="col-md-3 col-sm-6">
            <ul class="list-group mb-2">
              <li class="list-group-item bg-primary text-white d-flex justify-content-between">
                <h6>{{$category->category_name}}</h6>
                <a href="{{route('category.edit',['id'=>$category->id])}}" class="text-white"><i class="fas fa-edit"></i></a>
              </li>
              <ul class="list-group small">
                @foreach($category->subCategory as $item)
                <li class="list-group-item list-group-item-action">{{$item->subCategory_name}}</li>
                @endforeach
              </ul>
            </ul>
          </div>
          @endforeach --}}
      </div>
    </div>
  </div>
</div>
@endsection