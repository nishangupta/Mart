@extends('layouts.auth-admin')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-sm-12 col-lg-6 mx-auto">
      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Welcome Admin!</h1>
              <p>Use Email: admin@admin.com & Password: password <br> to login as Admin</p>
            </div>
            @if($errors->any())
              <div class="alert alert-danger">
                {{ implode('', $errors->all(':message')) }}
              </div>
            @endif
            <form class="user" action="{{route('login')}}" method="POST">
              @csrf
              <div class="form-group">
                <input type="email" class="form-control form-control-user" @error('email') is-invalid @enderror value="{{old('email')}}"  name="email" placeholder="Enter Email Address..." required  autocomplete="email" autofocus>
                @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
                @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <div class="custom-control custom-checkbox small">
                  <input type="checkbox" class="custom-control-input"  {{old('remember')?'checked':''}} name="remember" id="customCheck">
                  <label class="custom-control-label" for="customCheck">Remember Me</label>
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-user btn-block">
                Login
              </button>
              
            </form>
            <hr>
            <div class="text-center">
              <a class="small" href="{{route('password.request')}}">Forgot Password?</a>
            </div>
            <div class="text-center">
              <a class="small" href="{{route('home.index')}}">Go back to homepage</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection