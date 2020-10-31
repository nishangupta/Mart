<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('order.index');
    }
    public function test()
    {
        $order = new Order();

        $order->order_number = rand(200, 299) . '' . Carbon::now()->timestamp;
        $order->quantity = 1;
        $order->product_id = 1;
        $order->price = 2000;
        $order->save();

        dd($order->date);
    }
    public function destroy(Request $request)
    {
        $ids = $request->get('ids');
        $orders = Order::whereIn('id', $ids)->get(['id', 'status']);
        foreach ($orders as $order) {
            $order->delete();
        }
        Alert::toast('Order removed from the database!', 'success');
        return redirect(route('shipCancelled.index'));
    }
}
