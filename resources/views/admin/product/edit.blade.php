@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="m-0  text-primary">Update Product</h5>
      <a href="{{route('product.index')}}" class="btn btn-primary">Go back</a>
    </div>
  </div>

  <x-input-error/>
        
  <form action="{{route('product.update',$product)}}" method="POST">
    @csrf @method('PATCH')
    <div class="card ">
      <div class="card-body">
        <div class="form-group">
          <label for="">Product title </label>
          <small class="text-primary d-block mb-3">Slug will be auto generated!</small>
          <input type="text" name="title" value="{{$product->title}}" placeholder="Product title" class="form-control" required> 
        </div>

        {{-- category selector vue component --}}
        <category-selector :categories="{{$categories}}" :selected_id="{{$product->subCategory_id}}"></category-selector>

        <div class="form-group">
          <label for="">Product Price </label>
          <input type="text" name="price" value="{{$product->price}}" placeholder="Product price" class="form-control w-50" required> 
        </div>

        <div class="form-group">
          <label for="">Discount</label>
          <small class="text-primary d-block mb-3">Discount will be automatically shown. leave empty for no disount!</small>
          <input type="text" name="discount" value="{{$product->discount}}" placeholder="Discount" class="form-control w-50" > 
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <textarea class="form-control" id="description" name="description">{{$product->description}}</textarea>
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
        <attribute-selector :attributes='{{$product->attributes}}'></attribute-selector>

      </div>
    </div>

    <br>
  
    <div class="card">
      <div class="card-body">

        <div class="form-group mt-4">
          <label class="small" for="">Brand</label>
          <input type="text" placeholder="-" list="brandsScheme" class="form-control @error('brand') is-invalid @enderror" name="brand" value="{{$product->brand??''}}">
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
          <input type="text" placeholder="-" list="warrantyScheme" class="form-control @error('warranty') is-invalid @enderror" name="warranty" value="{{ $product->warranty??'' }}">
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
          <select name="status" class="form-control" value="{{$product->status}}">
              <option value="1">Active</option>
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
          <button type="submit" class="btn btn-primary my-3">Update</button>
        </div>

      </div>
    </div>
    
  </form>

  <div class="card-footer">
    <form action="{{route('product.destroy',$product)}}" method="POST" class="float-right">
      @csrf @method('DELETE')
      <button type="button" class="dltBtn btn btn-danger my-3">Delete product</button>
    </form>

  </div>

</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote-bs4.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
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
  });  
</script>
@endpush