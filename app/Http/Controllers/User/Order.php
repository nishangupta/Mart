<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Pennant\Feature;
use RealRashid\SweetAlert\Facades\Alert;

class Order
{
    public function __invoke(Request $request): RedirectResponse
    {
        $cart = Cart::findOrFail($request->cart_id)->with('product')->first();

        /** @var User $user */
        $user = Auth::user();

        $order = new \App\Models\Order();
        $order->user_id = $user->getAuthIdentifier();
        $order->product_id = $cart->product->id;
        $order->quantity = $request->quantity;

        $order->shipping_cost = 100;
        $order->order_number = rand(200, 299) . '' . Carbon::now()->timestamp;

        if ($cart->product->onSale) {
            $totalPrice = $cart->product->sale_price;
        } else {
            $totalPrice = $cart->product->price;
        }

        if (Feature::for($user)->active('vip')) {
            $order->price = (int)$totalPrice * 0.9;
        } else {
            $order->price = $totalPrice;
        }

        if ($order->save()) {
            //cart delete
            $cart->delete();
            Alert::toast('Order Placed!', 'success');
        } else {
            Alert::toast('Checkout fail' . 'error');
        }

        return Redirect::route('myOrder.index');
    }
}
