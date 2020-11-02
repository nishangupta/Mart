@extends('layouts.app')
@section('page-title', 'Show '.$product->title)

@section('content')
{{-- 
  @component('components.breadcrumbs')
    <a href="/">Home</a>
    <i class="fa fa-chevron-right breadcrumb-separator"></i>
    <span><a href="{{ route('shop.index') }}">Shop</a></span>
    <i class="fa fa-chevron-right breadcrumb-separator"></i>
    <span>{{ $product ?? ''->name }}</span>
  @endcomponent --}}

  <div class="container">
    <div class="card shadow my-5">
      <div class="card-body">
        <div class="product-section">
          <div class="row">
            <div class="col-sm-12 col-md-5">
              <div class="product-section-image" id="productCurrentImage">
                <img src="{{ asset($product->image->original) }}" alt="product" class="active img-fluid" id="currentImage">
              </div>
              <div class="product-section-images">
                <div class="row mt-3">
                  <div class="col-sm-2 col-md-3 col-2">
                    <div class="product-section-thumbnail selected">
                        <img src="{{ asset($product->image->original) }}" class="img-fluid" alt="product">
                    </div>
                  </div>
      
                  @if ($product->productImage)
                      @foreach ($product->productImage as $image)
                        <div class="col-sm-2 col-md-3 col-2">
                          <div class="product-section-thumbnail">
                            <img src="{{ asset($image->original) }}" class="img-fluid" alt="product">
                          </div>
                        </div>
                      @endforeach
                    </div>
                      
                  @endif
              </div>
            </div>
            <div class="col-sm-12 col-md-7 pl-md-5 mt-5 mt-md-0">
              <div class="product-section-information">
                <h3 class="product-section-title text-gray-700">{{ $product->title }}</h3>
                <div>Brand: {{$product->brand}}</div>
      
                <div class="my-2">
                  <h4>Price:</h4>
                  <p class="text-orange h4">Rs.{{number_format($product->price)}}</p>
                  @if($product->onSale)
                    <p><span class="line-through h5"> Rs.{{$product->sale_price}}</span> <span class="btn btn-primary disabled ml-3"> {{ (($product->price - $product->sale_price)/$product->price)*100 }}% off</span> </p>
                  @endif
                </div>
                
                <div class="my-3">
                  <h4>Product Code:</h4>
                  <p>{{$product->product_code}}</p>
                </div>
            
                <div class="my-3">
                  <h4>Quantity:</h4>
                  <div class="d-flex">
                    <button onclick="cartDecrement()" class="btn btn-outline-primary px-3">-</button>
                    <input type="text" value="1" id="cartCount" placeholder="1" class="pl-3 border" disabled style="width: 50px">
                    <button onclick="cartIncrement()" class="btn btn-outline-primary px-3">+</button>
                  </div>
                </div>
        
                <p>&nbsp;</p>
        
                @if ($product->stock > 0)
                    <form action=" route('cart.store', $product ?? '') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-orange">Add to Cart</button>
                        <button type="submit" class="btn btn-primary">Buy now</button>
                    </form>
                @endif
            </div>
            </div>
          </div>
        
        </div> <!-- end product-section -->
      </div>
    </div>
  </div>


@include('inc.app.might-like')

@endsection

@push('css')
<style>
  .product-section .selected {
        border: 1px solid #979797;
    }
  .product-section-thumbnail {
      display: flex;
      align-items: center;
      border: 1px solid lightgray;
      min-height: 66px;
      cursor: pointer;
    }
  .product-section-thumbnail :hover {
        border: 1px solid #979797;
    }
  .product-section-image {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    overflow:hidden;
    border:1px solid #ddd;
  }
  .product-section-image img {
      transform-origin: center center;
      opacity: 0;
      transition: opacity 0.1s ease-in-out;
      max-height: 100%;
      width: 100%;
      cursor: pointer;
  }
  img.active {
      opacity: 1;
  }
}

</style> 
@endpush

@push('js')
<script>
  (function(){
    const currentImage = document.querySelector('#currentImage');
    const images = document.querySelectorAll('.product-section-thumbnail');

    images.forEach((element) => element.addEventListener('click', thumbnailClick));

    function thumbnailClick(e) {
        currentImage.classList.remove('active');

        currentImage.addEventListener('transitionend', () => {
            currentImage.src = this.querySelector('img').src;
            currentImage.classList.add('active');
        })

        images.forEach((element) => element.classList.remove('selected'));
        this.classList.add('selected');
    }
  })();

  //image zoom
  const productCurrentImage = document.querySelector('#productCurrentImage');
  const img = document.querySelector('#productCurrentImage img');
  img.addEventListener('mousemove',e=>{
    const x = e.clientX - 151 - e.target.offsetLeft;
    const y = e.clientY -216 - e.target.offsetTop;

    img.style.transformOrigin = `${x}px ${y}px`;
    img.style.transform = 'scale(2)';
    
  });

  productCurrentImage.addEventListener('mouseleave',e=>{
    img.style.transformOrigin = `center center`;
    img.style.transform = 'scale(1)';
  });

  //cart
  function cartIncrement(){
    $('#cartCount').val(parseInt($('#cartCount').val()) + 1)
  }
  function cartDecrement(){
    if( $('#cartCount').val() > 1){
      $('#cartCount').val(parseInt($('#cartCount').val()) - 1)
    }
    return
  }


</script>   
@endpush