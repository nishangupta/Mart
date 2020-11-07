<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class MyCancellationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $orders = auth()->user()->orders()->with('product.productImage')->onlyTrashed()->latest()->paginate(5);
        return view('my-cancellation.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $order = auth()->user()->orders()->withTrashed()->where('id', $request->order_id)->first();
        $order->restore();
        return redirect(route('myOrder.index'));
    }
}
