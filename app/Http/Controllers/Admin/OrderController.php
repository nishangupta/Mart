<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View as ViewFactory;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function index(): View
    {
        return ViewFactory::make('admin.order.index');
    }

    public function show($id): RedirectResponse
    {
        return Redirect::route('invoice.index', ['order' => $id]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $ids = $request->get('ids');

        $orders = Order::whereIn('id', $ids)->get(['id', 'status']);

        foreach ($orders as $order) {
            $order->delete();
        }

        Alert::toast('Order removed from the database!', 'success');

        return Redirect::route('shipCancelled.index');
    }
}
