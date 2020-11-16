@extends('layouts.app')
@section('content')
<div class="mt-5">
  <div class="bg-light server-error-page">
    <div class="container-fluid">

      <!-- 404 Error Text -->
      <div class="text-center">
        <div class="error mx-auto" data-text="404">500</div>
        <p class="lead text-gray-800 mb-5">Server error or overload</p>
        <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
        <a href="{{route('login')}}">&larr; Login</a>
      </div>
    
    </div>
  </div>
</div>

@endsection

@push('css')
<style>
.server-error-page{
  min-height:50vh;
}
</style>
@endpush