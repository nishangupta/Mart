<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReadyToShipController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|shipper');
    }

    public function index()
    {
        return view('admin.order.ready-to-ship');
    }

    public function store(Request $request)
    {
        $ids = $request->get('ids');
        $orders = Order::whereIn('id', $ids)->get(['id', 'status']);
        foreach ($orders as $order) {
            $order->update([
                'status' => 'READY TO SHIP'
            ]);
        }
        return redirect(route('readyToShip.index'));
    }
}
