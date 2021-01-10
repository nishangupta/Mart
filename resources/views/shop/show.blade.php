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
        <span><a href="{{ route('shop.catalog') }}">{{$product->category->name}}</a></span>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>{{ $product->title }}</span>
      @endcomponent
    
      <div class="card-body mt-2">

        <product-show :product="{{$product}}" @auth:user="{{auth()->id()}}" @endauth></product-show>

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
                    <p class="text-center py-2"><a href="{{route('login')}}" class="text-primary">Login</a> or <a href="{{route('register')}}" class="text-primary">Register</a> to ask the seller now</p>
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



@include('inc.app.might-like')

@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
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
    $('#productCurrentImage img').bind('touchmove mousemove',e=>{
      const x = e.clientX - 151 - e.target.offsetLeft;
      const y = e.clientY -216 - e.target.offsetTop;

      img.style.transformOrigin = `${x}px ${y}px`;
      img.style.transform = 'scale(2)';
      
    });

    productCurrentImage.addEventListener('mouseleave',e=>{
      img.style.transformOrigin = `center center`;
      img.style.transform = 'scale(1)';
    });

  });
</script>   
@endpush