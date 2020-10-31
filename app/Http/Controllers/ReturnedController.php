<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ReturnedController extends Controller
{
    public function index()
    {
        return view('order.returned');
    }

    public function store(Request $request)
    {
        $ids = $request->get('id');
        $orders = Order::where('id', $ids)->get(['id', 'status']);
        foreach ($orders as $order) {
            $order->update([
                'status' => 'RETURNED'
            ]);
        }
        return redirect(route('return.index'));
    }
}
