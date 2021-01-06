{{-- Delete Modal --}}
{{-- <div class="modal fade" id="delModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="#delModal{{$user->id}}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="#delModal{{$user->id}}Label">Delete user</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{ route('categorys.destroy',$user->id) }}">
            @csrf 
            @method('delete')
            <button type="submit" class="btn btn-danger" style="margin:auto; text-align:center">Parmanent delete user</button>
          </form>
        </div>
      </div>
    </div>
</div> --}}