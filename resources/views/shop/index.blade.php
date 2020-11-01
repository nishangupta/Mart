@extends('layouts.app')

@section('content')
  @include('inc.app.main-banner')
  @include('inc.app.flash-sale');
  @include('inc.app.categories-section')
  @include('inc.app.just-for-you')
 
@endsection