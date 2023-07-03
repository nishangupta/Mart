<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MyOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = auth()->user()->orders()->with('product.productImage')->latest()->paginate(5);
        return view('my-order.index', compact('orders'));
    }

    public function destroy(Order $id): RedirectResponse
    {
        //soft delete of the order
        $id->delete();

        return Redirect::route('myOrder.index');
    }
}
