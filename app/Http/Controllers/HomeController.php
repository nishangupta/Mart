<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $userRole = auth()->user()->getRoleNames()->first();
        switch ($userRole) {
            case 'admin':
                return redirect(route('admin.dashboard'));
                break;

            case 'shipper':
                return redirect(route('order.index')); //gets only order management permissions in admin dashboard
                break;

            default:
                return redirect(route('user.index'));
                break;
        }
    }
}
