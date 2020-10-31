<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class DeliveredController extends Controller
{
    public function index()
    {
        return view('order.delivered');
    }

    public function store(Request $request)
    {
        $ids = $request->get('ids');
        $orders = Order::whereIn('id', $ids)->get(['id', 'status']);
        foreach ($orders as $order) {
            $order->update([
                'status' => 'DELIVERED'
            ]);
        }
        return redirect(route('delivered.index'));
    }
}
