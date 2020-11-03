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
          @if($products->count())
            @foreach($products as $product)
            <div class="col-6 col-sm-4 col-md-3 p-2">
              <a href="{{$product->path()}}">
              <div class="card shadow-hover h-100" >
                <img src="{{$product->productImage->first()->original}}" class="card-img-top" alt="">
                <div class="card-body ">
                  <p class="text-dark">{{$product->title}}</p>
                  @if($product->onSale)
                    <small class="line-through text-dark">{{$product->price}}</small>
                    <p class="text-orange py-0 my-0 h5">Rs.{{number_format($product->sale_price)}}</p>
                  @else
                    <p class="text-orange py-0 my-0 h5">Rs.{{number_format($product->price)}}</p>
                  @endif
                </div>
                  <button class="btn btn-orange btn-block">Add to cart</button>
              </div>
              </a>
            </div>
            @endforeach
          @else
          <div class="row">
            <div class="col-sm-8 col-md-6 col-6 mx-auto">
              <div class="text-center">
                <h4>Search No Result.</h4>
                <p>We're sorry. We cannot find any matches for your search term.</p>
                <img src="{{asset('images/demo/empty.svg')}}" class="w-100" alt="">
              </div>
            </div>
          </div>
          @endif
          
        </div>
        <div class="row sorting my-5">
          <div class="col-12">
            <div class="btn-group float-md-right ml-3">
              {{$products->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 order-md-1 col-lg-3 sidebar-filter">
      {{-- <h3 class="mt-0 mb-5">Showing <span class="text-primary">12</span> Products</h3>  --}}
      <h6 class="text-uppercase font-weight-bold mb-3">Categories</h6>
      <form action="{{route('shop.catalog')}}">
      @csrf
      <div class="my-2 pl-2">
        @foreach($productCategories as $category)
        <div class="custom-control custom-checkbox my-1">
          <input type="checkbox" class="custom-control-input" id="{{$category->subCategory_name}}" name="filter[subCategory]" value="{{$category->subCategory_name}}">
          <label class="custom-control-label" for="{{$category->subCategory_name}}">{{$category->subCategory_name}}</label>
        </div>
        @endforeach
      </div>
      
      <div class="divider mt-5 mb-5 border-bottom border-secondary"></div>
      <h6 class="text-uppercase mt-5 mb-3 font-weight-bold">Price</h6>
      <div class="d-flex align-items-center">
        Min: <input type="number" class="form-control w-100 ml-2" value="" name="filter[min_price]" >
      </div>
      <div class="d-flex align-items-center">
        Max: <input type="number" class="form-control w-100 ml-2" value="" name="filter[max_price]" >
      </div>
      <button type="submit" class="btn btn-sm btn-block btn-primary mt-5">Update Results</button>
      </form>
    </div>

  </div>
</div> 
@endsection