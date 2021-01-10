@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="m-0  text-primary">Create Product</h5>
      <a href="{{route('product.index')}}" class="btn btn-primary">Go back</a>
    </div>
  </div>

  <x-input-error/>
        
  <form action="{{route('product.store')}}" method="POST">
    @csrf
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label for="">Product title </label>
          <small class="text-primary d-block mb-3">Slug will be auto generated!</small>
          <input type="text" name="title" value="{{old('title')}}" placeholder="Product title" class="form-control" required> 
        </div>

        {{-- category selector vue component --}}
        <category-selector :categories="{{$categories}}" ></category-selector>

        <div class="form-group">
          <label for="">Product Price </label>
          <input type="text" name="price" value="{{old('price')}}" placeholder="Product price" class="form-control w-50" required> 
        </div>

        <div class="form-group">
          <label for="">Discount</label>
          <small class="text-primary d-block mb-3">Discount will be automatically shown. leave empty for no disount!</small>
          <input type="text" name="discount" value="{{old('discount')}}" placeholder="Discount" class="form-control w-50"> 
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <textarea class="form-control" id="description" name="description"></textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>
    </div>

    <br>
    
    <div class="card">
      <div class="card-body">

        {{-- attribute selector vue compoent --}}
        <attribute-selector :attributes='[{"uid":9922,"type":"asda","attribute":"sdas","stock":"123","live":1}]'></attribute-selector>

      </div>
    </div>

    <br>
  
    <div class="card">
      <div class="card-body">

        <div class="form-group mt-4">
          <label class="small" for="">Brand</label>
          <input type="text" placeholder="-" list="brandsScheme" class="form-control @error('brand') is-invalid @enderror" name="brand" value="{{old('brand')}}">
          <datalist id="brandsScheme">
            <option value="No Brand">
            <option value="Apple">
            <option value="Samsung">
            <option value="Hp">
            <option value="Dell">
            <option value="Lenovo">
          </datalist>
        </div>

        <div class="form-group mt-4">
          <label class="small" for="">Warranty</label>
          <input type="text" placeholder="-" list="warrantyScheme" class="form-control @error('warranty') is-invalid @enderror" name="warranty" value="{{ old('warranty') }}">
          <datalist id="warrantyScheme">
            <option value="No warranty">
            <option value="3 months">
            <option value="6 months">
            <option value="1 year">
            <option value="2 years">
            <option value="3 years">
            <option value="5 years">
          </datalist>
        </div>
        
        <div class="form-group mt-4">
          <label for="status" class="col-form-label">Status </label>
          <select name="status" class="form-control">
              <option value="1" selected >Active</option>
              <option value="0">Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="alert alert-primary">
          Product Images can be added in the product manage page.
        </div>

        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-primary my-3">Submit</button>
        </div>

      </div>
    </div>
    
  </form>

</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote-bs4.min.css')}}">
@endpush

@push('js')
<script src="{{asset('backend/summernote/summernote-bs4.min.js')}}"></script>

<script>
  $(document).ready(function(){
    $('#description').summernote({
        placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
  });  
</script>
@endpush