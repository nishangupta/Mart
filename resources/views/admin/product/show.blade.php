@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <h1 class="h5 mb-0 text-gray-800">Product Image Management</h1>
  <p>Drop images to this dropzone. Multiple images supported.</p>
  <a href="{{route('product.index')}}" class="btn btn-primary">Go back</a>

  <div class="card shadow my-4">
    <div class="card-header">
      <p class="h5"><span class="text-primary">{{$product->title}} (${{$product->price}})</span></p>
    </div>
    <div class="card-body">
      <image-upload product-id="{{$product->id}}"></image-upload>
    </div>
  </div>
 
  {{-- <div class="card shadow">
    <div class="card-header">
      <p class="h5"><span class="text-primary"> Product Images</span><span class="text-primary">{{$product->title}} (${{$product->price}})</span></p>
    </div>
    <div class="card-body">
      
        <product-images product-id={{$product->id}}></product-images>
        
    </div>
  </div> --}}

 

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