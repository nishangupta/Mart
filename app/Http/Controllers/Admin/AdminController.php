<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\CustomerQuestion;

class AdminController extends Controller
{
    public function dashboard()
    {
        $productsCount = Product::count();
        $ordersCount = Order::where('status', 'PENDING')->count();
        $readyToShipCount  = Order::where('status', 'READY TO SHIP')->count();
        $customerQueryCount  = CustomerQuestion::whereNUll('reply')->count();
        return view('admin.dashboard', compact([
            'productsCount', 'ordersCount', 'readyToShipCount', 'customerQueryCount'
        ]));
    }

    public function profile()
    {
        return view('admin.profile');
    }
}
