<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class OrderApiController extends Controller
{
    public function all(): JsonResponse
    {
        $orders = Order::where('status', 'PENDING')->latest()->get();

        return DataTables::of($orders)
            ->setRowId('id')
            ->addColumn('select', function ($row) {
                return '<input type="checkbox" name="ids[]" class="selectbox" value="' . $row->id . '">';
            })
            ->addColumn('created_at', function ($row) {
                return date('d/m/Y h:i A', strtotime($row->created_at));
            })
            ->addColumn('order_number', function ($row) {
                return '<a href="' . route('order.show', [$row->id]) . '" class="">' . $row->order_number . '</a>';
            })
            ->rawColumns(['select', 'order_number'])
            ->make();
    }
}
