@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="card">
    
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="m-0  text-primary">Create Product</h5>
      <a href="{{route('category.index')}}" class="btn btn-primary">Go back</a>
    </div>

    <x-input-error/>
         
    <form action="{{route('product.store')}}" method="POST">
      @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="">Product title </label>
          <small class="text-primary d-block mb-3">Slug will be auto generated!</small>
          <input type="text" name="title" value="{{old('title')}}" placeholder="Product title" class="form-control" required> 
        </div>

        {{-- category selector vue component --}}
        <category-selector :categories="{{$categories}}" ></category-selector>

        <div class="form-group">
          <label for="summary" class="col-form-label">Summary</label>
          <textarea class="form-control" id="summary" name="summary"></textarea>
          @error('summary')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status </label>
          <select name="status" class="form-control">
              <option value="1" selected >Active</option>
              <option value="0">Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-primary my-3">Submit</button>
        </div>
      </div>
    </form>

  </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote-bs4.min.css')}}">
@endpush

@push('js')
<script src="{{asset('backend/summernote/summernote-bs4.min.js')}}"></script>

<script>
  $(document).ready(function(){
    $('#summary').summernote({
        placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
  });  
</script>
@endpush