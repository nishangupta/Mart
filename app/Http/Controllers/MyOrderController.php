<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class MyOrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('product.productImage')->latest()->paginate(5);
        return view('my-order.index', compact('orders'));
    }
    public function destroy(Order $id)
    {
        $id->delete();
        return redirect()->route('myOrder.index');
    }
}
