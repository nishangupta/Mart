@extends('layouts.admin')

@section('content')
<div class="container-fluid">

  <section class="my-4">
    <div class="card">
      <div class="card-body">
        <div class="mb-4">
          <h3>Getting All Registered Users</h3>

          <a href="{{route('userManagement.index')}}" class="btn btn-primary btn-sm my-2"><i class="fas fa-chevron-left"></i> Go back</a>
        </div>
        <div class="table-responsive">
          <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created at</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email }}</td>
                <td>{{$user->userInfo->phone?? 'not set'}}</td>
                <td>{{$user->userInfo->address ?? 'not set'}}</td>
                <td>{{$user->created_at}}</td>
                <td><a href="mailto:{{$user->email}}" class="btn btn-sm btn-block btn-success">Mail</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="d-flex justify-content-center">
          {{$users->links()}}
        </div>
      </div>
    </div>
  </section>

</div>

@endsection
