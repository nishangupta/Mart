<?php

namespace App\Http\Controllers;

use App\Models\Order;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|shipper')->except(['loginView']);
    }
    public function index(Order $order)
    {
        //change order printed status
        $order->update([
            'printed' => true
        ]);

        $user = $order->user()->with('userInfo')->first();
        $product = $order->product()->with('productImage')->first();

        $invoice = $this->makeInvoice($user, $product, $order);
        return $invoice;
    }

    private function makeInvoice($user, $product, $order)
    {
        return view('inc.invoice', compact('user', 'product', 'order'))->render();
    }
}
