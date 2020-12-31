@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  @include('inc.admin.order-management-pages')

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Order Management</h6>
    </div>
    <div class="card-body">
      <div class="mb-3">
          <div class="form-group">
            <label for="">Select all</label>
            <input type="checkbox" class="selectall">
          </div>
          <button id="showSelected" class="btn btn-sm btn-primary">Ready to ship</button>
      </div>
      <form action="{{route('readyToShip.store')}}"  method="POST" id="selectorForm">
        @csrf
        <div class="table-responsive">
          <table class="table table-hover table-bordered small" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Select</th>
                <th>Order No</th>
                <th>Order Date</th>
                <th>Payment</th>
                <th>Price</th>
                <th>#</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('js')
<script>
$(document).ready(function(){
  $('#dataTable').dataTable({
  processing:true,
  serverSide:true,
  ajax:"{{route('order.all')}}",
    columns:[
      {data:'select',orderable:false,searchable:false},
      {data:'order_number'},
      {data:'created_at'},
      {data:'payment',orderable:false},
      {data:'price'},
      {data:'quantity'},
      {data:'status',searchable:false},
    ]
  });

	$('.selectall').click(function(){
		$('.selectbox').prop('checked', $(this).prop('checked'));
	})

	$('.selectbox').change(function(){
		var total = $('.selectbox').length;
		var number = $('.selectbox:checked').length;
		if(total == number){
			$('.selectall').prop('checked', true);
		} else{
			$('.selectall').prop('checked', false);
		}
	})

  $('#showSelected').click(function(){
    if($('.selectbox:checked').length < 1){
      alert('Please select atleast one of the row!');
      return;
    }else{
      $('#selectorForm').submit();
    }
  })

})

</script>
@endpush