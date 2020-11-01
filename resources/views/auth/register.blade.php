@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex align-items-center justify-content-between">
       <h3>Create your Mart Account</h3>
       <div class="small"><span>Already member? <a href="{{route('login')}}">Login</a> here.</span></div>
    </div>
    <div>
       <form action="{{route('register')}}" method="POST">
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
                <div class="form-group">
                    <label class="small" for="">Confirm Password*</label>
                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password"
                     class="form-control @error('password_confirmation') is-invalid @enderror" required >
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
             </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label class="small">Full name*</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Your full name"
                            class="form-control @error('name') is-invalid @enderror" required >
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="receiveOffers">
                    <label class="form-check-label" for="receiveOffers">I want to receive exclusive offers and promotions from Mart.</label>
                </div>

                <button type="submit" class="btn btn-orange btn-block">SIGN UP</button>
                <div class="mb-3">
                  <small>By clicking “SIGN UP”, I agree to Mart's  
                      <a href="#" target="_blank">Terms of Use</a> and <a href="#" target="_blank" >Privacy Policy</a>
                  </small>
                </div>
                <div class="mod-third-party-login-bd">
                    <a href="#loginUsingFacebook" class="btn btn-block btn-facebook">Facebook</a>
                    <a href="#loginUsingGoogle" class="btn btn-block btn-google">Google</a>
                </div>
             </div>
          </div>
       </form>
    </div>
 </div>

@endsection