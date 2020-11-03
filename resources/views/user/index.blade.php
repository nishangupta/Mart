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
          <p class="mb-0 ">My account</p>
        </div>

        <div class="card-body">
          <h6 class="heading-small text-muted mb-4">User information</h6>
          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label >Username</label>
                  <input type="text"  class="form-control form-control-alternative" disabled
                    placeholder="Username" value="{{auth()->user()->name}}">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label >Email</label>
                  <input type="text"  class="form-control form-control-alternative" disabled
                    placeholder="Email" value="{{auth()->user()->email}}">
                </div>
              </div>
            </div>
          </div>

          <hr class="my-4">
          <h6 class="heading-small text-muted mb-4" id="password-section">Shipping Information</h6>
          <div class="pl-lg-4">
            <form action="{{route('user.address')}}" method="POST">
              @csrf
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <input type="text" placeholder="Shipping address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ auth()->user()->userInfo->address??'' }}" required>
                      @error('address')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <input type="text" placeholder="Phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ auth()->user()->userInfo->phone??'' }}" required>
                      @error('phone')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <button type="submit" class="btn btn-primary">Save Shipping Information</button>
                </div>
              </div>
            </form>
          </div>

          <hr class="my-4">
          <h6 class="heading-small text-muted mb-4" id="password-section">Change Password</h6>
          <div class="pl-lg-4">
            <form action="{{route('account.changePassword')}}" method="POST">
              @csrf
              @method('put')
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <input type="password" placeholder="Current Password *" class="form-control @error('current_password') is-invalid @enderror" name="current_password" value="{{ old('current_password') }}" required>
                      @error('current_password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <input type="password" placeholder="New Password*" class="form-control @error('new_password') is-invalid @enderror" name="new_password" value="{{ old('new_password') }}" required>
                      @error('new_password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <input type="password" placeholder="Confirm Password *" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" value="{{ old('confirm_password') }}" required>
                      @error('confirm_password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>
              </div>
              <button class="btn btn-primary" type="submit">Change password</button>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection