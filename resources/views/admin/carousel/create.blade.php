@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <h1 class="h3 mb-0 text-gray-800">Creating a banner</h1>
      <a href="{{route('admin.dashboard')}}" class="btn btn-primary btn-sm float-right">Go back</a>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-12 col-md-12 mb-4">
      <div class="card">
        <div class="card-body">
          @if($errors->any())
              <div class="alert alert-danger">
              {{ implode('', $errors->all(':message')) }}
              </div>
          @endif
          <form action="{{route('carousel.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="">Caption for this carousel image</label>
              <input type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" placeholder="Caption" >
              @error('caption')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="exampleFormControlFile1">Example file input</label>
              <input type="file" class="form-control-file" name="file" id="exampleFormControlFile1">
              @error('file')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection