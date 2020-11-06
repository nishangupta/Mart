@extends('layouts.app')

@section('page-title','Product queries')

@section('content')
<div class="container-fluid py-3" style="min-height: 80vh">
  <div class="row no-gutters">

    <div class="col-xl-2 col-md-2 col-sm-12 ml-auto">
      @include('inc.app.user-sidebar')
    </div>

    <div class="col-xl-8 col-md-8 col-sm-12 mr-auto">
      <div class="card shadow">
        <div class="card-header bg-light border-bottom">
          <p class="mb-0 ">Product queries</p>
        </div>

        <div class="card-body" style="min-height: 40vh">
             
          <div class="table-responsive">
            <table class="table table-hover table-striped">
              <thead>
                <tr>
                  <th>Product title</th>
                  <th>Question</th>
                  <th>Reply</th>
                  <th>Created_at</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if($questions->count())
                  @foreach($questions as $question)
                    <tr>
                      <td><a href="{{$question->product->path()}}">{{$question->product->title}}</a></td>
                      <td>{{$question->question}}</td>
                      <td>{{$question->reply ?? 'pending' }}</td>
                      <td>{{$question->created_at->diffForHumans()}}</td>
                      <td>
                        <form action="{{route('customerQuestion.destroy',['id'=>$question])}}" method="POST">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-danger btn-sm">Delete</a>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                @else
                <tr>
                  <td>No questions made on the products yet. </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <a href="{{route('shop.catalog')}}" class="btn btn-orange btn-sm">Go to products page</a>
                @endif
              </tbody>
            </table>
          </div>
          <div class="d-flex justify-content-center">
            {{$questions->links()}}
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection