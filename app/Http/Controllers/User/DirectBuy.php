<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\DirectBuyRequest;
use App\Models\FlashSale;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * @see \Tests\Feature\Http\Controllers\OrderControllerTest
 */
class DirectBuy extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(DirectBuyRequest $request, FlashSale $flashSale): RedirectResponse
    {
        /** @var FlashSale $flashProduct */
        $flashProduct = $flashSale->newQuery()
            ->where('id', $request->id)
            ->with('product')
            ->first();

        $order = new Order();
        $order->user_id = Auth::user()->getAuthIdentifier();
        $order->product_id = $flashProduct->product_id;
        $order->shipping_cost = 100;
        $order->order_number = rand(200, 299) . '' . Carbon::now()->timestamp;
        $order->price = $flashProduct->flash_price;

        if ($order->save()) {
            Alert::toast('Order Placed!', 'success');
        } else {
            Alert::toast('Checkout fail' . 'error');
        }

        return Redirect::route('myOrder.index');
    }
}
