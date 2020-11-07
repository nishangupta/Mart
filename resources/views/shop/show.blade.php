@extends('layouts.app')
@section('page-title', 'Buy '.$product->title)

@section('content')

  <div class="container">
    <div class="card shadow my-2">
      @component('components.breadcrumbs')
        <a href="/">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span><a href="{{ route('shop.catalog') }}">Shop</a></span>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>{{$product->subCategory}}</span>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>{{ $product->title }}</span>
      @endcomponent
    
      <div class="card-body mt-2">
        <div class="product-section">
          <div class="row">
            <div class="col-sm-12 col-md-4 ml-auto">
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
                        <div class="col-sm-2 col-md-3 col-2 mb-2">
                          <div class="product-section-thumbnail">
                            <img src="{{ asset($image->original) }}" class="w-100" alt="product">
                          </div>
                        </div>
                      @endforeach
                  @endif
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-7 pl-md-5 mt-5 mt-md-0 mr-auto">
              <div class="product-section-information">
                <h3 class="product-section-title text-gray-900">{{ $product->title }}</h3>
                <div>Brand: {{$product->brand ==''?'no brand':$product->brand }}</div>
      
                <div class="my-2">
                  <h4>Price:</h4>
                  @if($product->onSale)
                  <p class="text-orange h4">Rs.{{number_format($product->sale_price)}}</p>
                  <p>
                    <span class="line-through h5"> Rs.{{$product->price}}</span> 
                    <span class="btn btn-primary disabled ml-3"> {{ floor((($product->price - $product->sale_price)/$product->price)*100) }}% off</span> 
                  </p>
                  @else
                  <p class="text-orange h4">Rs.{{number_format($product->price)}}</p>
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
                    <input type="text" value="1" id="cartCount" name="quantity" placeholder="1" class="pl-3 border" disabled style="width: 50px">
                    <button onclick="cartIncrement()" class="btn btn-outline-primary px-3">+</button>
                  </div>
                </div>
        
                <p>&nbsp;</p>
        
                @if ($product->stock > 0)
                <form action="{{route('cart.store')}}" id="addToCartForm" method="POST">
                  @csrf
                  <input type="hidden" name="product_id" value="{{$product->id}}">
                  <input type="hidden" id="stockVal" value="{{$product->stock}}">
                  <input type="hidden" id="quantity" name="quantity" value="">
                  <button id="addToCartBtn"  type="submit" class="btn btn-orange">Add to Cart</button>
                </form>
                @else
                  <button id="addToCartBtn" class="btn btn-secondary">Out of stock</button>
                @endif

                <p>&nbsp;</p>

              </div>
            </div>
          </div>
        </div> <!-- end product-section -->
      </div>
    </div>

    <div class="card shadow">
      <div class="card-body">
        <div class="description-section">
          <div class="row">
            <div class="col-12 ">
              <h4 class="text-gray-900">Product details of {{$product->title}}</h4>
              <div class="container py-2 px-5 text-gray-800">
                {!! $product->description !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="card shadow my-2 mb-5">
      <div class="card-body">
        <div class="description-section">
          <div class="row">
            <div class="col-12 ">
              <h6 class="text-gray-900">Questions about the product</h6>
              <div class="py-2 px-1 text-gray-800">
                <div class="row">
                  <div class="col-12 bg-light shadow">
                    <div class="row mb-3">
                      <div class="col">
                        @auth
                        <form action="{{route('customerQuestion.store')}}" method="POST">
                          @csrf
                          <div class="form-group d-flex">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="text" placeholder="Enter your question(s) here" class="form-control" name="question">
                            <button type="submit" class="btn btn-orange">Ask</button>
                          </div>
                        </form>
                        @endauth
                        @guest
                        <p><a href="{{route('login')}}">Login</a> or <a href="{{route('register')}}">Register</a> to ask the seller now</p>
                        @endguest
                      </div>
                    </div>
                    @if($questions->count())
                      @foreach($questions as $question)
                      <div class="row shadow-hover mb-3 py-2 pl-2">
                        <div class="col-12 mb-1">
                          <div><i class="fas fa-question-circle text-warning"></i> <span class="text-gray-700"></span> [{{$question->user->name}}] >> {{$question->question}} - {{$question->created_at->diffForHumans()}}</div>
                        </div>
                        <div class="col-12">
                          @if($question->reply)
                          <div>
                            <i class="fas fa-comment-alt text-secondary"></i> 
                          <span class="text-gray-800">{{$question->reply}}</span>
                          </div>
                          @else
                          <div>Waiting for the seller to reply.</div>
                          @endif
                        </div>
                      </div>
                      @endforeach
                    @else
                    <div class="text-center">
                      <div ><i class="fas fa-envelope fa-2x text-gray-500"></i></div>
                      <p clas="d-block">There are not questions yet.</p>
                    </div>
                    @endif
                    <div class="d-flex justify-content-end">
                      {{$questions->links()}}
                    </div>
             
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
  $(document).ready(function(){
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

    
    //add to cart
    $('#addToCartBtn').click(function(e){
      e.preventDefault();
      let cartCount = document.querySelector('#cartCount');
      let quantity = document.querySelector('#quantity');
      quantity.value = cartCount.value;
      $('#addToCartForm').submit();
    })

  });

  //cart
  function cartIncrement(){
    //check if the cart count is less than stock quantity
    if(Number($('#cartCount').val()) < Number($('#stockVal').val()) ){
      if(Number($('#cartCount').val() < 5)){
        $('#cartCount').val(parseInt($('#cartCount').val()) + 1)
      }
    }else{
      alert('Max quantity reached for this product');
    }
  }
  function cartDecrement(){
    if( $('#cartCount').val() > 1){
      $('#cartCount').val(parseInt($('#cartCount').val()) - 1)
    }
    return
    }



</script>   
@endpush