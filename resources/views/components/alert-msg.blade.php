{{-- @if(Session::has('msg'))
  <div class="alert alert-info alert-dismissible fade show">{{ Session::get('message') }}</div>
@endif

@if(Session::has('success-msg'))
  <div class="alert alert-success alert-dismissible fade show">{{ Session::get('success-msg') }}</div>
@endif

@if(Session::has('error-msg'))
  <div class="alert alert-error alert-dismissible fade show">{{ Session::get('error-msg') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif --}}

@foreach (['info', 'success', 'error'] as $msg)
  @if(Session::has($msg))
  <div class="alert alert-{{$msg}} alert-dismissible fade show">
    {{ Session::get($msg) }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
@endforeach