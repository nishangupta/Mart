<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Invoice</title>
  <style>
    body{
      padding:2rem;
    }
    .header{
      padding:2rem;
    }
    .container{
      padding:2.5rem;
    }
  </style>
</head>
<body>
<h4>ORDER ID: {{$order->order_number}}</h4>
<div class="header">
  <h2>{{config('app.name')}}</h2>
  <h3>Product Invoice</h3>
  <hr>
  <table class="table" cellpadding="1" cellspacing="0" style="height:131px; width:100%; border: 0px solid;">
    <tbody>
      <tr>
        <td style="width: 19%;">Purchase Product Code:</td>
        <td style="width: 39%;">{{$product->product_code}}</td>
        <td style="width: 21%; text-align: left;">Payment Method:</td>
        <td style="width: 21%; text-align: left;">{{$order->payment}}</td>
      </tr>
      <tr>
        <td>Purchase Summary Date:</td>
        <td>{{$order->created_at}}</td>
        <td>EMAIL:</td>
        <td>{{$user->email}}</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>BILL TO:</td>
        <td>{{$user->name}} </td>
        
        <td>PHONE:</td>
        <td>{{$user->userInfo->phone ?? 'not set'}}</td>
      </tr>
      <tr>
        <td>ADDRESS:</td>
        <td>{{$user->userInfo->address ?? 'not set'}}</td>
      </tr>
      <tr>
      
      </tr>
    </tbody>
  </table>
</div>
&nbsp;

<div class="container" style="width:100%;">
  <table class="table" cellpadding="1" cellspacing="0" style="margin:0; width:100%">
    <thead>
      <tr>
        <td colspan="8" style="text-align: left; vertical-align: middle; font-weight: bold">Your Ordered
          Items:</td>
      </tr>
      <tr>
        <td>#</td>
        <td>Product Name</td>
        <td>Product Image</td>
        <td>Product code</td>
        <td>Size</td>
        <td>Price</td>
        <td>Quantity</td>
        <td>Item Total</td>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>1</td>
        <td>{{$product->title}}</td>
        <td><img src="{{asset($product->productImage->first()->original)}}" width="150px" alt=""></td>
        <td>{{$product->product_code}}</td>
        <td>Size:{{$product->size}}, Color:{{$product->color}}</td>
        <td>{{$order->price}}</td>
        <td>{{$order->quantity}}</td>
        <td>{{$order->price*$order->quantity}}</td>
      </tr>

    </tbody>
  </table>
  <br>
  &nbsp;
</div>

<table class="table" border="0" cellpadding="1" cellspacing="0"
  style="text-align:right; width:60%; float: right; border: 0px solid;">
  <tbody>
    <tr>
      <td>Subtotal:</td>
      <td>{{$order->price* $order->quantity}}</td>
    </tr>
    <tr>
      <td><span>Shipping Cost:</span></td>
      <td><span>100.00</span></td>
    </tr>
    <tr>
      <td>Voucher:</td>
      <td>0</td>
    </tr>
    <tr>
      <td style="border-top:solid 2px;border-color:#CCCCCC;line-height:1.5; font-weight: bold">Total:</td>
      <td style="border-top:solid 2px;border-color:#CCCCCC;line-height:1.5; font-weight: bold">{{number_format((int)($order->price*$order->quantity) + 100)}}</td>
    </tr>
  </tbody>
</table> 
</body>
</html>
