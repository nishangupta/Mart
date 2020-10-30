@extends('layouts.admin')

@section('content')
<div class="container-fluid" >
  <div class="d-flex align-items-center justify-content-between">
    <div class="div">
      <h1 class="h5 mb-0 text-gray-800">Product Image Management</h1>
      <p>Drop images to this dropzone. Multiple images supported.</p>
    </div>
    <div>
      <a href="{{route('product.index')}}" class="btn btn-outline-primary">Go Back</a>
    </div>
  </div>

  
  <div class="container-fluid mt-5 px-0">
    <div class="row">
      <div class="col-sm-12 col-md-6">
        <div class="card shadow">
          <div class="card-header">
            <p class="h5"><span class="text-primary">{{$product->title}} (${{$product->price}})</span></p>
          </div>
          <div class="card-body">

            <image-upload product-id="{{$product->id}}"></image-upload>

          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="card shadow">
          <div class="card-header">
            <p class="h5"><span class="text-primary"> Product Images</span></p>
          </div>
          <div class="card-body">
            
              <product-images product-id={{$product->id}}></product-images>
              
          </div>
        </div>
      </div>
    </div>
 
  </div>

</div>
@endsection

@push('js')
<script>
  $(document).ready(function(){
    $('#deleteImageBtns').click(function(e){
      e.preventDefault();
      
      if(confirm('Are you sure to delete this image?')){
        $('#deleteImageForm').submit();
      }
    });
  })
</script>
@endpush