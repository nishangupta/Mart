@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Add products to flash sale</h6>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-12 col-md-8 pb-3">

          @if($errors->any())
            <div class="alert alert-danger">
              {{ implode('', $errors->all(':message')) }}
            </div>
          @endif

          <form action="{{route('flashSale.store')}}" method="POST">
            @csrf
            <div class="row">
              <div class="col-sm-12 col-md-8">
                <div class="form-group">
                  <label for="">Product code</label> <small class="text-info">[6 digit code of each product] <a href="{{route('product.index')}}">Find here</a> </small>
                  <input type="text" placeholder="Product code" name="product_code" class="form-control mt-2" required>
                </div>

                <div class="form-group">
                  <label for="">Flash sale price</label>
                  <input type="text" placeholder="Price" name="flash_price" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                  <button type="submit" class="btn btn-primary my-3">Add to flash sale</button>
                </div>
              </div>
            </div>
          </form>
 
        </div>
    
      </div>
    </div>
  </div>

</div>
@endsection
