<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFactory;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        return ViewFactory::make('admin.dashboard', [
            'productsCount' => Product::count(),
            'ordersCount' => Order::where('status', 'PENDING')->count(),
            'readyToShipCount' => Order::where('status', 'READY TO SHIP')->count(),
        ]);
    }
}
