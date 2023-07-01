<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DeliveredController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|shipper');
    }

    public function index()
    {
        return view('admin.order.delivered');
    }

    public function store(Request $request)
    {
        $ids = $request->get('ids');
        $orders = Order::whereIn('id', $ids)->get(['id', 'status']);
        foreach ($orders as $order) {
            $order->update([
                'status' => 'DELIVERED'
            ]);
        }
        return redirect(route('delivered.index'));
    }
    public function cleanUp(Request $request)
    {
        Order::where('status', 'DELIVERED')->where('updated_at', '<=', Carbon::now()->subDays(90))->delete();
        Alert::toast('Db cleaned', 'success');
        return redirect(route('deliverd.index'));
    }
}
