<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfo;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class UserManagementApiController extends Controller
{
    public function all()
    {
        $users = User::role(['admin', 'shipper'])
            ->with('userInfo')
            ->latest()
            ->get();

        return DataTables::of($users)
            ->setRowId('id')
            ->addColumn('role', function ($row) {
                return $row->getRoleNames()->first();
            })
            ->addColumn('phone', function ($row) {
                $data = $row->userInfo->phone ?? 'no phone';
                return $data;
            })
            ->addColumn('address', function ($row) {
                $data = $row->userInfo->address ?? 'no address';
                ;
                return $data;
            })
            ->addColumn('created_at', function ($row) {
                return date('d/m/Y h:i A', strtotime($row->created_at));
            })
            ->addColumn('updated_at', function ($row) {
                return date('d/m/Y h:i A', strtotime($row->updated_at));
            })
            ->addColumn('actions', function ($row) {
                $item = '<a href="/user-management/' . $row->id . '/destroy" class="btn btn-sm btn-danger">Del</a>
        ';
                return $item;
            })
            ->rawColumns(['actions', 'phone', 'address'])
            ->make(true);
    }
}
