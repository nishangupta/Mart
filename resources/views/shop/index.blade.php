@extends('layouts.app')

@section('content')
  @include('inc.app.categories-section')
  @include('inc.app.just-for-you')

  <div class="d-flex justify-content-center mt-5">
    <div class="text-center">
      <h2>Didn't Find Your Match</h2>
      <a href="search" class="btn btn-orange">Search for It</a>
    </div>
  </div>
@endsection