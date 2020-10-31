@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-xl-12 order-xl-1">
      <div class="card shadow">
        <div class="card-header bg-light border-bottom">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0 ">My account</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
        <form action="{{route('account.changePassword')}}" method="post">
            @csrf
            @method('put')
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
            <!-- Address -->
            <h6 class="heading-small text-muted mb-4" id="password-section">Change Password</h6>
            <div class="pl-lg-4">
              <form action="" method="POST">
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <input type="password" placeholder="Current Password *" class="form-control @error('current_password') is-invalid @enderror" name="current_password" value="{{ old('current_password') }}" required>
                      @error('current_password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <input type="password" placeholder="New Password*" class="form-control @error('new_password') is-invalid @enderror" name="new_password" value="{{ old('new_password') }}" required>
                      @error('new_password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>
                <div class="col-lg-4">
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