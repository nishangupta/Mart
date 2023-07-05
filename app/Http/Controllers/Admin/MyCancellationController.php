<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyCancellationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Auth::user()->orders()->with('product.productImage')->onlyTrashed()->latest()->paginate(5);
        return view('my-cancellation.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $order = Auth::user()->orders()->withTrashed()->where('id', $request->order_id)->first();
        $order->restore();
        return redirect(route('myOrder.index'));
    }
}
