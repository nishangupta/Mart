<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ShipCancelledController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }
    public function index()
    {
        return view('order.ship-cancelled');
    }

    public function store(Request $request)
    {
        $ids = $request->get('ids');
        $orders = Order::where('id', $ids)->get(['id', 'status']);
        foreach ($orders as $order) {
            $order->update([
                'status' => 'CANCELLED'
            ]);
        }
        return redirect(route('shipCancelled.index'));
    }
}
