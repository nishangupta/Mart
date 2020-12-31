@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  @include('inc.admin.order-management-pages')
  
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Shipped Products</h6>
    </div>
    <div class="card-body">

      <div class="mb-3">
          <div class="form-group">
            <label for="">Select all</label>
            <input type="checkbox" class="selectall">
          </div>
          <button id="showSelected" class="btn btn-sm btn-primary">Delivered</button>
          <button id="printInvoiceBtn" printinvoicevalue="4" title="print invoice" class=" btn btn-sm btn-success">Print invoice</button>
          <form class="d-none" action="{{route('shipCancelled.store')}}" id="cancelOrderForm" method="POST">
            @csrf <input id="cancelOrderInput" type="hidden" name="id" value="">
          </form>
          <button type="button" id="cancelSelected" class="btn btn-sm btn-danger float-right">Cancel Order</button>
      </div>
      <form action="{{route('delivered.store')}}"  method="POST" id="selectorForm">
        @csrf
        <div class="table-responsive">
          <table class="table table-hover table-bordered small" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Select</th>
                <th>Order number</th>
                <th>Order Date</th>
                <th>Payment</th>
                <th>Price</th>
                <th>#</th>
                <th>Status</th>
                <th>Printed</th>
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
  ajax:"{{route('shipped.all')}}",
    columns:[
      {data:'select',orderable:false,searchable:false},
      {data:'order_number'},
      {data:'created_at'},
      {data:'payment',orderable:false},
      {data:'price'},
      {data:'quantity'},
      {data:'status'},
      {data:'printed',searchable:false},
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

  //submit selected
  $('#showSelected').click(function(){
    if($('.selectbox:checked').length < 1){
      alert('Please select atleast one of the row!');
      return;
    }else{
      $('#selectorForm').submit();
    }
  })

  //window print jquery extension
  $.fn.extend({
    print: function(data) {
        var frameName = 'printIframe';
        var doc = window.frames[frameName];
        if (!doc) {
            $('<iframe>').hide().attr('name', frameName).appendTo(document.body);
            doc = window.frames[frameName];
        }
        doc.document.body.innerHTML = data;
        doc.window.print();
        return this;
    }
  });

  //print invoice
  $('#printInvoiceBtn').click(function(){
    if($('.selectbox:checked').length !== 1){
      alert('Please select exactly one row to print invoice!');
      return;
    }else{
      let orderId = $('.selectbox:checked')[0].value;
      $('#printInvoiceBtn').prop('disabled',true);
      axios.get(`invoice/${orderId}`)
      .then(res=>res.data)
      .then(data=>{
        //print method defined above
        $('#invoice').print(data);
        $('#printInvoiceBtn').prop('disabled',false);
      })
      .catch(e=>{
        console.log(e)
        $('#printInvoiceBtn').prop('disabled',false);
      })
    }
  });   

  //cancel orders
  $('#cancelSelected').click(function(){
    if($('.selectbox:checked').length !== 1){
      alert('Please select exactly one row to print invoice!');
      return;
    }else{
      let orderId = $('.selectbox:checked')[0].value;
      $('#cancelSelected').prop('disabled',true);

      $('#cancelOrderInput').val(orderId);
      $('#cancelOrderForm').submit();
    }
  });   

 


    


});

</script>
@endpush