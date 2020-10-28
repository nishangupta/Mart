@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex align-items-center justify-content-between">
       <h3 class="font-weight-light">Welcome to Mart! Please Login</h3>
       <div class="small"><span>Don't have a account? <a href="{{route('register')}}">Create</a> here.</span></div>
    </div>
    @if($errors->any())
      <div class="alert alert-danger">
        {{ implode('', $errors->all(':message')) }}
      </div>
    @endif
    <div>
       <form action="{{route('login')}}" method="POST">
        @csrf
          <div class="row">
             <div class="col-md-6">
                <div class="form-group">
                    <label class="small" for="">Email Address*</label>
                    <input type="email" placeholder="E-mail address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="small" for="">Password*</label>
                    <input type="password" name="password" value="{{ old('password') }}" placeholder="Password Minimum 8 characters"
                     class="form-control @error('password') is-invalid @enderror" required >
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
             </div>
             <div class="col-md-6">
                <button type="submit" class="btn btn-primary btn-block mt-5">SIGN UP</button>

                <div class="my-4">
                    <a href="#loginUsingFacebook" class="btn btn-primary btn-facebook">Facebook</a>
                    <a href="#loginUsingGoogle" class="btn btn-primary btn-google">Google</a>
                </div>
             </div>
          </div>
       </form>
    </div>
 </div>
@endsection


@push('css')
<style>

</style>
@endpush