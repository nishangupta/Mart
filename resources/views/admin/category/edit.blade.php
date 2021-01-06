@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="card shadow">

    <div class="card-header py-3 d-flex justify-content-between">
        <h5 class="m-0 font-weight-bold text-primary">Edit Category</h5>
        <a href="{{route('category.index')}}" class="btn btn-primary float-right">Go back</a>
    </div>
  
    <div class="card-body">
      <x-input-error/>
         
      <form action="{{route('category.update',$category->id)}}" method="POST">
        @csrf @method('PATCH')
        <div class="form-group">
          <label for="">Category name </label>
          <small class="text-primary d-block mb-3">Slug will be auto generated!</small>
          <input type="text" name="name" value="{{$category->name}}" placeholder="Category name" class="form-control" required> 
        </div>

        <div class="form-group">
          <label for="is_parent">Is Parent</label><br>
          <input type="checkbox" name='is_parent' id='is_parent' value='{{$category->is_parent}}' {{(($category->is_parent==1)? 'checked' : '')}}> Yes                        
        </div>

        <div class="form-group {{(($category->is_parent==1) ? 'd-none' : '')}}" id='parent_categories'>
          <label for="parent_id">Parent Category</label>
          <select name="parent_id" class="form-control">
              <option value="">--Select any category--</option>
              @foreach($parent_categories as $key=>$cat)
                @if($cat->id !== $category->id)
                  <option value='{{$cat->id}}' {{(($cat->id==$category->parent_id) ? 'selected' : '')}}>{{$cat->name}}</option>
                @endif
              @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status </label>
          <select name="status" class="form-control">
              <option value="1" {{ $category->status=='1' ? 'selected' : ''}} >Active</option>
              <option value="0" {{ $category->status=='0' ? 'selected' : ''}} >Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-primary my-3">Submit</button>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection

@push('js')
<script>
$(document).ready(function(){
  $('#is_parent').change(function(){
    var is_checked=$('#is_parent').prop('checked');
    // alert(is_checked);
    if(is_checked){
      $('#parent_categories').addClass('d-none');
      $('#parent_categories').val('');
    }
    else{
      $('#parent_categories').removeClass('d-none');
    }
  })
  
  $('#deleteCategoryBtn').click(function(e){
    e.preventDefault();
    if(confirm('Are you sure you want to delete the category?')){
      $('#deleteCategoryForm').submit();
    }
  });
});

</script>    
@endpush