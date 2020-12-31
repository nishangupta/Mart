<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShippedController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|shipper');
    }

    public function index()
    {
        return view('admin.order.shipped');
    }

    public function store(Request $request)
    {
        $ids = $request->get('ids');
        $orders = Order::whereIn('id', $ids)->get(['id', 'status']);
        foreach ($orders as $order) {
            $order->update([
                'status' => 'SHIPPED'
            ]);
        }
        return redirect(route('shipped.index'));
    }
}
