@extends('layouts.app')

@section('page-title', 'Search catalog')

@section('content')

<div class="container pt-5">
  <div class="row">
    <div class="col-md-8 order-md-2 col-lg-9">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="text-md-left text-center float-md-left mb-3 mt-3 mt-md-0 mb-md-0">
              @if(request()->get('q'))
              <h4>Showing results for "{{request()->get('q')}}"</h4>
              @endif
            </div>
            {{-- <div class="dropdown text-md-right text-center float-md-right mb-3 mt-3 mt-md-0 mb-md-0">
              <label class="mr-2">Sort by:</label>
              <a class="btn btn-lg btn-light dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Relevance <span class="caret"></span></a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown" x-placement="bottom-start" stsyle="position: absolute; transform: translate3d(71px, 48px, 0px); top: 0px; left: 0px; will-change: transform;">
                <a class="dropdown-item" href="#">Relevance</a>
                <a class="dropdown-item" href="#">Price Descending</a>
                <a class="dropdown-item" href="#">Price Ascending</a>
                <a class="dropdown-item" href="#">Best Selling</a>
              </div>
            </div> --}}
           
          </div>
        </div>
        <div class="row">
    
          <div class="col-6 col-sm-4 col-md-3 p-2">
            <div class="card shadow-hover h-100" >
              <img src="https://static-01.daraz.com.np/p/a2d61155fa16ded0ef7c4083c99c243f.jpg" class="card-img-top" alt="">
              <div class="card-body ">
                <p class="text-dark">100% cotton full sleves Tshirt for men</p>
                <small class="line-through text-orange">1200</small>
                <p class="text-orange py-0 my-0 h5">Rs.1599  </p>
              </div>
                <button class="btn btn-orange btn-block">Add to cart</button>
            </div>
          </div>
          
          <div class="col-6 col-sm-4 col-md-3 p-2 ">
            <div class="card shadow-hover h-100" >
              <img src="https://static-01.daraz.com.np/p/516e4237465d928fb051fe7d0082ce5a.jpg_200x200q80-product.jpg_.webp" class="card-img-top" alt="">
              <div class="card-body ">
                <p class="text-dark">100% cotton full sleves Tshirt for men</p>
                <small class="line-through text-orange">1200</small>
                <p class="text-orange py-0 my-0 h5">Rs.1599  </p>
              </div>
                <button class="btn btn-orange btn-block">Add to cart</button>
            </div>
          </div>
    
          <div class="col-6 col-sm-4 col-md-3 p-2 ">
            <div class="card shadow-hover h-100" >
              <img src="https://static-01.daraz.com.np/p/a2d61155fa16ded0ef7c4083c99c243f.jpg" class="card-img-top" alt="">
              <div class="card-body ">
                <p class="text-dark">100% cotton full sleves Tshirt for men</p>
                <small class="line-through text-orange">1200</small>
                <p class="text-orange py-0 my-0 h5">Rs.1599  </p>
              </div>
                <button class="btn btn-orange btn-block">Add to cart</button>
            </div>
          </div>

          <div class="col-6 col-sm-4 col-md-3 p-2 ">
            <div class="card shadow-hover h-100" >
              <img src="https://static-01.daraz.com.np/p/a2d61155fa16ded0ef7c4083c99c243f.jpg" class="card-img-top" alt="">
              <div class="card-body ">
                <p class="text-dark">100% cotton full sleves Tshirt for men</p>
                <small class="line-through text-orange">1200</small>
                <p class="text-orange py-0 my-0 h5">Rs.1599  </p>
              </div>
                <button class="btn btn-orange btn-block">Add to cart</button>
            </div>
          </div>
          
          <div class="col-6 col-sm-4 col-md-3 p-2 ">
            <div class="card shadow-hover h-100" >
              <img src="https://static-01.daraz.com.np/p/a2d61155fa16ded0ef7c4083c99c243f.jpg" class="card-img-top" alt="">
              <div class="card-body ">
                <p class="text-dark">100% cotton full sleves Tshirt for men</p>
                <small class="line-through text-orange">1200</small>
                <p class="text-orange py-0 my-0 h5">Rs.1599  </p>
              </div>
                <button class="btn btn-orange btn-block">Add to cart</button>
            </div>
          </div>

        </div>
        <div class="row sorting my-5">
          <div class="col-12">
            <div class="btn-group float-md-right ml-3">
              {{$products->links()}}
            </div>
          </div>
        </div>
      </div>
    </div><div class="col-md-4 order-md-1 col-lg-3 sidebar-filter">
      {{-- <h3 class="mt-0 mb-5">Showing <span class="text-primary">12</span> Products</h3>  --}}
      <h6 class="text-uppercase font-weight-bold mb-3">Categories</h6>
      <div class="mt-2 mb-2 pl-2">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="category-1">
          <label class="custom-control-label" for="category-1">Accessories</label>
        </div>
      </div>
      <div class="mt-2 mb-2 pl-2">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="category-2">
          <label class="custom-control-label" for="category-2">Coats &amp; Jackets</label>
        </div>
      </div>
      <div class="mt-2 mb-2 pl-2">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="category-3">
          <label class="custom-control-label" for="category-3">Hoodies &amp; Sweatshirts</label>
        </div>
      </div>
      <div class="mt-2 mb-2 pl-2">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="category-4">
          <label class="custom-control-label" for="category-4">Jeans</label>
        </div>
      </div>
      <div class="mt-2 mb-2 pl-2">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="category-5">
          <label class="custom-control-label" for="category-5">Shirts</label>
        </div>
      </div>
      <div class="mt-2 mb-2 pl-2">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="category-6">
          <label class="custom-control-label" for="category-6">Underwear</label>
        </div>
      </div>
      <div class="divider mt-5 mb-5 border-bottom border-secondary"></div>
      <h6 class="text-uppercase mt-5 mb-3 font-weight-bold">Price</h6>
      <div class="d-flex align-items-center">
        Min: <input type="number" class="form-control w-50 ml-2" value="" >
      </div>
      <div class="d-flex align-items-center">
        Max: <input type="number" class="form-control w-50 ml-2" value="" >
      </div>
      <a href="#" class="btn btn-sm btn-block btn-primary mt-5">Update Results</a>
    </div>

  </div>
</div> 
@endsection