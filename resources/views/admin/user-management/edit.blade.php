@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  @if($errors->any())
  <div class="alert alert-danger">
    {{ implode('', $errors->all(':message')) }}
  </div>
  @endif
  <form action="{{route('user-management.store')}}" method="POST">
    @csrf
    <div class="card shadow">
      <div class="card-body">
        <p class="text-primary mb-2">Add User</p>
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <div class="form-group">
              <label for="">Email</label>
              <input type="text" name="email" placeholder="Email of the user" value="" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="">Username</label>
              <input type="text" name="name" placeholder="Username" value="" class="form-control" required>
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="form-group">
              <label for="">Password</label>
              <input type="password" name="password" placeholder="Password" value="" class="form-control" required>
            </div>

            <div class="form-group">
              <label for="">Phone</label>
              <input type="text" name="phone" placeholder="Phone" value="" class="form-control" required>
            </div>

          </div>
          <div class="col-sm-12 col-md-6">
            <div class="form-group">
              <label for="">Address</label>
              <input type="text" name="address" placeholder="Address" class="form-control">
            </div>

            <div class="form-group">
              <label for="">Role</label>
              <select name="role" class="form-control">
                <option value="admin">Admin - Multiple admin supported</option>
                <option value="shipper">Shipper/Delivery Boy</option>
              </select>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-sm btn-success">Update</button>
      </div>
    </div>
  </form>
</div>

@endsection
