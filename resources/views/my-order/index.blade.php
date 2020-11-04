@extends('layouts.app')

@section('page-title','User Account')

@section('content')
<div class="container-fluid py-3" style="min-height: 80vh">
  <div class="row no-gutters">

    <div class="col-xl-2 col-md-2 col-sm-12 ml-auto">
      @include('inc.app.user-sidebar')
    </div>

    <div class="col-xl-8 col-md-8 col-sm-12 mr-auto">
      <div class="card shadow">
        <div class="card-header bg-light border-bottom">
          <p class="mb-0 ">My Orders</p>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection