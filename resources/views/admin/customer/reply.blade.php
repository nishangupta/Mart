@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Customer Query Reply</h6>
    </div>
    <div class="card-body">

      <div class="row">
        <div class="col-sm-12 col-md-8 pb-5">

          <div class="my-4">
            <div class="row">
              <div class="col-sm-6 col-md-3">
                <img src="{{asset($question->product->productImage->first()->thumbnail)}}" class="img-fluid" alt="">
              </div>
              <div class="col-sm-12 col-md-9">
                <h4>{{$question->product->title}}</h4>
                @if($question->product->onSale)
                <p>Price : <span>Rs.{{number_format($question->product->price)}}</span></p>
                <p>Sale Price : Rs.{{number_format($question->product->sale_price)}} </p>
                @else
                <p>Price : Rs.{{number_format($question->product->price)}} </p>
                @endif
              </div>
            </div>
          </div>


          @if($errors->any())
            <div class="alert alert-danger">
              {{ implode('', $errors->all(':message')) }}
            </div>
          @endif
          <form action="{{route('customerQuestion.reply',['id'=>$question->id])}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-sm-12 col-md-8">
                <div class="form-group">
                  <label for="">Question</label>
                  <p class="text-gray-800 h5 alert alert-primary">{{$question->question}}</p>
                  <p class="text-gray-700">Asked by {{$question->user->name}} on {{$question->created_at->diffForHumans()}}</p>
                </div>
                <div class="form-group">
                  <label for="">Reply</label>
                  <textarea name="reply" rows="5" class="form-control"></textarea>
                </div>
                <div class="d-flex justify-content-between">
                  <button type="submit" class="btn btn-primary my-3">Reply</button>
                </div>
              </div>
            </div>
          </form>
          <div class="d-flex justify-content-end">
            <form action="{{route('customerQuestion.massDelete')}}" method="POST">
              @csrf
              <input type="hidden" name="ids[]" value="1">
              <button type="submit" class="btn btn-danger btn-sm ">Delete Question</button>
            </form>
          </div>
        </div>
    
      </div>
     
    </div>
  </div>

</div>
@endsection
