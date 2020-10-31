<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Order $order)
    {
        //change order printed status
        $order->update([
            'printed' => true
        ]);

        // $user = $order->user()->first();
        $user = User::find(1);
        $product = $order->product()->first();

        $invoice = $this->makeInvoice($user, $product, $order);
        return $invoice;
    }

    private function makeInvoice($user, $product, $order)
    {
        return view('inc.invoice', compact('user', 'product', 'order'))->render();
    }
}
