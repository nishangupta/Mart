@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  
  <div class="row mb-4">
    <div class="col-sm-12 col-md-6">
      <h1 class="h3 mb-0 text-gray-800">Front page carousel/banner management</h1>
      <a href="{{route('carousel.create')}}" class="btn btn-sm btn-primary my-4">Add a carousel</a>
    </div>

  </div>

  <div class="row">
    <div class="col-xl-12 col-md-12 mb-4">
      <div class="row container">
        <div class="table-responsive">
          <table class="table table-shadow table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Caption</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @if($carousels->count())
              @foreach($carousels as $carousel)
              <tr>
                <td>{{$carousel->id}}</td>
                <td>{{$carousel->caption}}</td>
                <td><img src="{{asset($carousel->img)}}" width="200px"></td>
                <td>{{$carousel->created_at->diffForHumans()}}</td>
                <td>
                  <a href="{{route('carousel.edit',['carousel'=>$carousel])}}" class="btn btn-sm btn-block btn-primary">Edit</a>
                  <form action="{{route('carousel.destroy',['carousel'=>$carousel->id])}}" id="deleteForm" method="POST">
                    @csrf @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger btn-block">Delete</button>
                  </form>
                </td>
              </tr>
              @endforeach
              @else
              <td>No carousel found. Create one now</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              @endif
            </tbody>
          </table>
        </div>
        
      </div>
    </div>
  </div>
</div>
@endsection
