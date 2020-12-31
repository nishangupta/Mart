@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <form action="{{route('product.update',['product'=>$product])}}" method="POST" id="submitProductForm">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col-sm-12 col-md-10 mx-auto mb-4">
        @if($errors->any())
          <div class="alert alert-danger">
            {{ implode('', $errors->all(':message')) }}
          </div>
        @endif

        <div class="card shadow mb-3">
          <div class="card-header">Basic Information</div>
          <div class="card-body">
            <div class="form-group">
              <label class="small" for="">Product title</label>
              <input type="title" placeholder="Product title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title')?? $product->title }}" required autofocus>
              @error('title')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <div class="alert alert-primary">Existing SubCategory Name: {{$product->subCategory}}</div>
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <label class="small" for="">Choose a category</label>
                  <select class="form-control" id="categorySelector" >
                    <option value="" selected disabled>Choose a category</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-sm-12 col-md-6">
                  <label class="small" for="">Sub Category</label>
                  <select name="subCategory" id="subCategorySelector" class="form-control">
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card shadow mb-3">
          <div class="card-header">Detailed Description</div>
          <div class="card-body">
            <div class="form-group">
              <input type="hidden" id="description" name="description" value="{{old('description')?? $product->description}}">
              <div id="quillEditor" style="height:200px"></div>
            </div>
          </div>
        </div>

        <div class="card shadow mb-3">
          <div class="card-header">Price and stock <span class="small float-right">Leave empty if not needed</span></div>
          <div class="card-body">

            <div class="table-responsive">
              <table class="table table-bordered table-hover small">
                <thead>
                  <tr>
                    <th>Availablity</th>
                    <th>Price</th>
                    <th>Special Price</th>
                    <th>onSale</th>
                    <th>Quantity</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="live" id="productAvailability" {{$product->live?'checked':''}}>
                        <label class="custom-control-label" for="productAvailability">Live</label>
                      </div>
                    </td>
                    <td><input type="number" class="form-control" name="price" value="{{ $product->price??old('price') }}"></td>
                    <td><input type="number" class="form-control" name="sale_price" value="{{ $product->sale_price??old('sale_price') }}"></td>
                    <td>
                      <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="onSale" id="saleAvailability" {{$product->onSale?'checked':''}} >
                        <label class="custom-control-label" for="saleAvailability">onSale</label>
                      </div>
                    </td>
                    <td>
                      <input type="number" class="form-control" name="stock" value="{{ $product->stock??old('stock') }}">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="form-group">
              <label class="small" for="">Color</label>
              <input type="text" placeholder="-" list="colorScheme" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ $product->color??old('color') }}">
              <datalist id="colorScheme">
                <option value="Multicolor">
                <option value="Red">
                <option value="Blue">
                <option value="Black">
                <option value="Beige">
                <option value="Grey">
                <option value="Pink">
              </datalist>

              @error('color')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-group">
              <label class="small" for="">Size</label>
              <input type="text" placeholder="-" list="sizeScheme" class="form-control @error('size') is-invalid @enderror" name="size" value="{{ $product->size??old('size') }}">
              <datalist id="sizeScheme">
                <option value="One size">
                <option value="S">
                <option value="M">
                <option value="L">
                <option value="Xl">
                <option value="2Xl">
                <option value="3xl">
                <option value="4Xl">
              </datalist>

              @error('size')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

          </div>
        </div>
        
        <div class="card shadow mb-3">
          <div class="card-header">Service and Delivery <span class="small float-right">Leave empty if not needed</span></div>
          <div class="card-body">
            <div class="form-group">
              <label class="small" for="">Warranty</label>
              <input type="text" placeholder="-" list="warrantyScheme" class="form-control @error('warranty') is-invalid @enderror" name="warranty" value="{{ $product->warranty??old('warranty') }}">
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
          </div>
        </div>

        <div class="alert alert-primary">
          Product Images can be added in the product manage page.
        </div>

      </div>
    </div>
  </form>
  <div class="submitBtn bg-white p-2 border-top">
    <div class="d-flex justify-content-center"> 
      <button id="submitProductBtn" class="btn btn-primary mx-3">Submit</button>
      <form action="{{route('product.destroy',['product'=>$product])}}" method="POST">
        @csrf
        @method('delete')
        <button id="submitProductBtn" class="btn btn-danger">Delete</button>
      </form>
    </div>
  </div>
</div>
@endsection

@push('css')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
.submitBtn{
  position: fixed;
  bottom:0;
  left: 0;
  right: 0;
  width: 100%;
}
</style>    
@endpush

@push('js')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
  $(document).ready(function(){
    //generate quill
    var quill = new Quill('#quillEditor', {
    modules: {
      toolbar: [
          [{ 'font': [] }, { 'size': [] }],
          ['bold', 'italic'],
          [{ list: 'ordered' }, { list: 'bullet' }],
          ['link', 'blockquote', 'code-block', 'image'],
        ]
      },
    placeholder: 'Product details ...',
    theme: 'snow'
    });
    
    const description = document.querySelector('#description');
    
    //check if it has value then pass it to quill
    if(description.value){
      quill.root.innerHTML = description.value;
    }

    //submit form
    $('#submitProductBtn').click(function(e){
      e.preventDefault();
      description.value = quill.root.innerHTML
       $('#submitProductForm').submit();
    });
  })

  //categories selector
  const subCategories ={!! json_encode($subCategories) !!};
  const categorySelector = document.querySelector('#categorySelector');
  const subCategorySelector = document.querySelector('#subCategorySelector');

  categorySelector.addEventListener('change',function(e){
    let newSubCategories = subCategories.filter(item => item.category_id == e.target.value)

    let str = '';
    newSubCategories.forEach(category=>{
      str += `<option value="${category.subCategory_name}">${category.subCategory_name}</option>`;
    })
    subCategorySelector.innerHTML = str;
  });


</script>
@endpush