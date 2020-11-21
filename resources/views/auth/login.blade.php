@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h5 class="font-weight-light text-center">Sign in to your account </h5>
   
    <div>
       <form action="{{route('login')}}" method="POST">
        @csrf
          <div class="row no-gutters">
             <div class="col-md-4 mx-auto col-sm-12">
                @if($errors->any())
                    <div class="alert alert-danger">
                    {{ implode('', $errors->all(':message')) }}
                    </div>
                @endif
                 <div class="card shadow">
                     <div class="card-body">
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
        
                        <button type="submit" class="btn btn-orange btn-block ">Login</button>
        
                        <div class=" my-2"><span>Don't have a account? <a href="{{route('register')}}">Create</a> here.</span></div>
        
                        <p class="text-center">or</p>
        
                        <div class="my-4">
                            <a href="#loginUsingFacebook" class="btn  btn-block btn-facebook">Facebook</a>
                            <a href="#loginUsingGoogle" class="btn  btn-block btn-google">Google</a>
                        </div>
                     </div>
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