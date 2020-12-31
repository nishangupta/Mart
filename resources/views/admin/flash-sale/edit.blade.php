@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Edit flash sale product</h6>
    </div>
    <div class="card-body">

      <div class="row">
        <div class="col-sm-12 col-md-8 pb-5">

          <div class="my-4">
            <div class="row">
              <div class="col-sm-6 col-md-3">
                <img src="{{asset($product->productImage->first()->thumbnail)}}" class="img-fluid" alt="">
              </div>
              <div class="col-sm-12 col-md-9">
                <h4>{{$product->title}}</h4>
                @if($product->onSale)
                <p>Price : <span>Rs.{{number_format($product->price)}}</span></p>
                <p>Sale Price : Rs.{{number_format($product->sale_price)}} </p>
                @else
                <p>Price : Rs.{{number_format($product->price)}} </p>
                @endif
              </div>
            </div>
          </div>


          @if($errors->any())
            <div class="alert alert-danger">
              {{ implode('', $errors->all(':message')) }}
            </div>
          @endif
          <form action="{{route('flashSale.update',['id'=>$product->id])}}" method="POST">
            @csrf
            @method('put')
            <div class="row">
              <div class="col-sm-12 col-md-8">
                <div class="form-group">
                  <label for="">Flash sale price</label>
                  <input type="text" placeholder="Price" name="flash_price" value="{{$flashSale->flash_price}}" class="form-control">
                </div>
                <div class="d-flex justify-content-between">
                  <button type="submit" class="btn btn-primary my-3">Update</button>
                </div>
              </div>
            </div>
          </form>
          <div class="d-flex justify-content-end">
            <form action="{{route('flashSale.destroy')}}" method="POST">
              @csrf
              @method('delete')
              <input type="hidden" name="id" value="{{$flashSale->id}}">
              <button type="submit" class="btn btn-danger btn-sm ">Delete</button>
            </form>
          </div>
        </div>
    
      </div>
     
    </div>
  </div>

</div>
@endsection
