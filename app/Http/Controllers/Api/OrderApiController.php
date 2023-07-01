<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Yajra\DataTables\DataTables;

class OrderApiController extends Controller
{
    public function all()
    {
        $orders = Order::where('status', 'PENDING')->latest()->get();
        return DataTables::of($orders)
        ->setRowId('id')
        ->addColumn('select', function ($row) {
            $item = '<input type="checkbox" name="ids[]" class="selectbox" value="' . $row->id . '">
        ';
            return $item;
        })
        ->addColumn('created_at', function ($row) {
            return date('d/m/Y h:i A', strtotime($row->created_at));
        })
        ->addColumn('order_number', function ($row) {
            $item = '<a href="order/' . $row->id . '" class="">' . $row->order_number . '</a>';
            return $item;
        })
        ->rawColumns(['select', 'order_number'])
        ->make(true);
    }
}
