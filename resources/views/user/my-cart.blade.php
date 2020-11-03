@extends('layouts.app')

@section('page-title','My Cart')

@section('content')
<div class="container-fluid py-3" style="min-height: 80vh">
  <div class="row no-gutters">

    <div class="col-xl-2 col-md-2 col-sm-12 ml-auto">
      @include('inc.app.user-sidebar')
    </div>

    <div class="col-xl-8 col-md-8 col-sm-12 mr-auto">
      {{-- my cart component --}}
      <my-cart></my-cart>
    </div>
  </div>
</div>
@endsection