@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {{ implode('', $errors->all(':message')) }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif