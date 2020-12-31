<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ShipCancelledController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|shipper');
    }

    public function index()
    {
        return view('admin.order.ship-cancelled');
    }

    public function store(Request $request)
    {
        $id = $request->get('id');
        $orders = Order::where('id', $id)->get(['id', 'status']);
        foreach ($orders as $order) {
            $order->update([
                'status' => 'CANCELLED'
            ]);
        }
        return redirect(route('shipCancelled.index'));
    }
    public function cleanUp(Request $request)
    {
        Order::where('status', 'CANCELLED')->where('updated_at', '<=', Carbon::now()->subDays(90))->delete();
        Alert::toast('Db cleaned', 'success');
        return redirect(route('shipCancelled.index'));
    }
}
