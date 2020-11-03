@extends('layouts.app')

@section('page-title', 'Buy products online with great discount')

@section('content')
  {{-- carousel --}}
  <div id="mainBanner" class="carousel slide main-banner" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#mainBanner" data-slide-to="0" class="active"></li>
      <li data-target="#mainBanner" data-slide-to="1"></li>
      <li data-target="#mainBanner" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="{{asset('images/banner/1.webp')}}" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('images/banner/2.webp')}}" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('images/banner/3.webp')}}" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#mainBanner" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#mainBanner" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  
  {{-- flash sale --}}
  <section class="just-for-you-section container h-100 my-4">
    <h3>Flash sale</h3>
    <div class="bg-white p-2">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-block pt-3">
            <p class="d-block">Ending in <button class="btn btn-danger ml-3 btn-sm">01 hours</button> </p>
          </div>  
  
          <div>
            <a href="search" class="btn btn-danger">Shop more</a> 
          </div>
      </div>
    </div>
    
    <div class="row h-100">
      <div class="col-6 col-sm-4 col-md-2 p-2">
        <div class="card shadow-hover h-100" >
          <img src="https://static-01.daraz.com.np/p/516e4237465d928fb051fe7d0082ce5a.jpg_200x200q80-product.jpg_.webp" class="card-img-top" alt="">
          <div class="card-body ">
            <p class="product-title">100% cotton full sleves Tshirt for men</p>
            <small class="line-through">Rs. 1200</small>
            <p class="product-price">Rs.1599  </p>
          </div>
            <button class="btn btn-orange btn-block">Add to cart</button>
        </div>
      </div>
  
      <div class="col-6 col-sm-4 col-md-2 p-2">
        <div class="card shadow-hover h-100" >
          <img src="https://static-01.daraz.com.np/p/8d45af190627c264f02a8dac5fe70bf3.jpg_200x200q80-product.jpg_.webp" class="card-img-top" alt="">
          <div class="card-body ">
            <p class="text-dark">100% cotton full sleves Tshirt for men</p>
            <small class="line-through text-orange">1200</small>
            <p class="text-orange py-0 my-0 h5">Rs.1599  </p>
          </div>
            <button class="btn btn-orange btn-block">Add to cart</button>
        </div>
      </div>
      
      <div class="col-6 col-sm-4 col-md-2 p-2 ">
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
         
      <div class="col-6 col-sm-4 col-md-2 p-2">
        <div class="card shadow-hover h-100" >
          <img src="https://static-01.daraz.com.np/p/516e4237465d928fb051fe7d0082ce5a.jpg_200x200q80-product.jpg_.webp" class="card-img-top" alt="">
          <div class="card-body ">
            <p class="text-dark">100% cotton full sleves Tshirt for men</p>
            <p class="text-orange py-0 my-0 h5">Rs.1599  </p>
          </div>
            <button class="btn btn-orange btn-block">Add to cart</button>
        </div>
      </div>
  
    </div>
  
  </section>

  {{-- categories-section --}}
  <section class="categories-section container my-4 h-100">
    <h3>Categories</h3>
      <div class="row h-100">
        
        <div class="col-4 col-sm-4 col-md-2 p-2">
          <a href="{{'catalog?filter[subCategory]=Mobile'}}">
            <div class="card shadow-hover">
              <div class="card-body">
                <img src="{{asset('images/demo/electronics.jpg')}}" class="img-fluid" alt="">
                <p class="card-title text-center">Electronics</p>
              </div>
            </div>
          </a>
        </div>
        
        <div class="col-4 col-sm-4 col-md-2 p-2">
          <a href="{{'catalog?filter[subCategory]=Furniture'}}">
            <div class="card shadow-hover">
              <div class="card-body">
                <img src="{{asset('images/demo/home.jpg')}}" class="img-fluid" alt="">
                <p class="card-title text-center">Home Lifestyle</p>
              </div>
            </div>
          </a>
        </div>
        
        <div class="col-4 col-sm-4 col-md-2 p-2">
          <a href="{{'catalog?filter[subCategory]=Diapers'}}">
            <div class="card shadow-hover">
              <div class="card-body">
                <img src="{{asset('images/demo/baby.jpg')}}" class="img-fluid" alt="">
                <p class="card-title text-center">Baby</p>
              </div>
            </div>
          </a>
        </div>
        
        <div class="col-4 col-sm-4 col-md-2 p-2">
          <a href="{{'catalog?filter[subCategory]=Mens'}}">
            <div class="card shadow-hover">
              <div class="card-body">
                <img src="{{asset('images/demo/sport.jpg')}}" class="img-fluid" alt="">
                <p class="card-title text-center">Sport & outdoor</p>
              </div>
            </div>
          </a>
        </div>
        
        <div class="col-4 col-sm-4 col-md-2 p-2">
          <a href="{{'catalog?filter[subCategory]=Kitchen'}}">
            <div class="card shadow-hover">
              <div class="card-body">
                <img src="{{asset('images/demo/kitchen.jpg')}}" class="img-fluid" alt="">
                <p class="card-title text-center">Kitchen</p>
              </div>
            </div>
          </a>
        </div>
        
        <div class="col-4 col-sm-4 col-md-2 p-2">
          <a href="{{'catalog?filter[subCategory]=Pet'}}">
            <div class="card shadow-hover">
              <div class="card-body">
                <img src="{{asset('images/demo/pet.jpg')}}" class="img-fluid" alt="">
                <p class="card-title text-center">Pets</p>
              </div>
            </div>
          </a>
        </div>

      </div>
    </div>
  </section>

  {{-- just for you --}}
  <section class="just-for-you-section container h-100 my-4">
    <h3>Just For You</h3>
    <div class="row h-100">
      @foreach($newProducts as $product)
      <div class="col-6 col-sm-4 col-md-2 p-2">
        <a href="{{$product->path()}}">
        <div class="card shadow-hover h-100" >
          <img src="{{asset($product->productImage->first()->original)}}" class="card-img-top" alt="">
          <div class="card-body ">
            <p class="product-title">{{$product->title}}</p>
            @if($product->onSale)
              <small class="line-through text-dark">Rs. {{$product->price}}</small>
              <p class="product-price">Rs.{{number_format($product->sale_price)}}</p>
            @else
              <p class="product-price">Rs.{{number_format($product->price)}}</p>
            @endif
          </div>
            <button class="btn btn-orange btn-block">Add to cart</button>
        </div>
        </a>
      </div>
      @endforeach
  
    </div>
  
    <div class="d-flex justify-content-center mt-5">
      <div class="text-center">
        <h2>Didn't Find Your Match</h2>
        <a href="{{route('shop.catalog')}}" class="btn btn-orange">Search for It</a>
      </div>
    </div>
  </section>
  


@endsection