<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): RedirectResponse
    {
        //Redirecting the users on the basis of their roles
        $userRole = Auth::user()->getRoleNames()->first();

        return match ($userRole) {
            'admin' => Redirect::route('admin.dashboard'),
            'shipper' => Redirect::route('order.index'),
            default => Redirect::route('user.index'),
        };
    }
}
