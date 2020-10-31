<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
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
}
