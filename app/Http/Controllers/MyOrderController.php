<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View as ViewFactory;

class MyOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $orders = Auth::user()
            ->orders()
            ->with('product.productImage')
            ->latest()
            ->paginate(5);

        return ViewFactory::make('my-order.index', compact('orders'));
    }

    public function destroy(Order $id): RedirectResponse
    {
        $id->delete();

        return Redirect::route('myOrder.index');
    }
}
