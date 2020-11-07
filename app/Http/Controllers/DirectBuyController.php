<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FlashSale;
use App\Models\Order;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class DirectBuyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function order(Request $request)
    {
        $flashProduct = FlashSale::where('id', $request->id)->with('product')->first();
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->product_id = $flashProduct->product->id;

        //shipping cost defult 100rs
        $order->shipping_cost = 100;
        $order->order_number = rand(200, 299) . '' . Carbon::now()->timestamp;

        $order->price = $flashProduct->flash_price;
        if ($order->save()) {
            Alert::toast('Order Placed!', 'success');
        } else {
            Alert::toast('Checkout fail' . 'error');
        }

        return redirect(route('myOrder.index'));
    }
}
