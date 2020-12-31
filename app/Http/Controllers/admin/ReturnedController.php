<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ReturnedController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|shipper');
    }

    public function index()
    {
        return view('admin.order.returned');
    }

    public function store(Request $request)
    {
        $ids = $request->get('ids');
        $orders = Order::where('id', $ids)->get(['id', 'status']);
        foreach ($orders as $order) {
            $order->update([
                'status' => 'RETURNED'
            ]);
        }
        return redirect(route('returned.index'));
    }
    public function cleanUp(Request $request)
    {
        Order::where('status', 'RETURNED')->where('updated_at', '<=', Carbon::now()->subDays(90))->delete();
        Alert::toast('Db cleaned', 'success');
        return redirect(route('returned.index'));
    }
}
