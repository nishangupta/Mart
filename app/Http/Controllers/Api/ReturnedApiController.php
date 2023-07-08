<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Yajra\DataTables\DataTables;

class ReturnedApiController extends Controller
{
    public function all()
    {
        $orders = Order::where('status', 'RETURNED')->latest()->get();

        return DataTables::of($orders)
        ->addColumn('select', function ($row) {
            return '<input type="checkbox" name="ids[]" class="selectbox" value="' . $row->id . '">
        ';
        })
        ->addColumn('created_at', function ($row) {
            return date('d/m/Y h:i A', strtotime($row->created_at));
        })
        ->addColumn('order_number', function ($row) {
            return '<a href="' . route('order.show', [$row->id]) . '" class="">' . $row->order_number . '</a>';
        })
        ->addColumn('printed', function ($row) {
            $val = $row->printed ? 'Printed' : 'Not printed';
            $class = $row->printed ? 'text-primary' : 'text-danger';
            return '<a href="javascript:void(0)" title="print invoice" class="' . $class . '">' . $val . '</a>';
        })

        ->rawColumns(['select', 'order_number', 'printed'])
        ->make(true);
    }
}
