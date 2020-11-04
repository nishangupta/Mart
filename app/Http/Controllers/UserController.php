<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Traits\RouteRoleTrait;

class UserController extends Controller
{
    use RouteRoleTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }
    //user profile 
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        return view('user.index');
    }

    //post route
    public function address(Request $request)
    {
        $request->validate([
            'address' => 'required|min:3',
            'phone' => 'required|min:6'
        ]);

        $userInfo = UserInfo::updateOrCreate([
            'user_id' => auth()->user()->id,
            'address' => $request->address,
            'phone' => $request->phone
        ]);
        Alert::toast('Shipping info updated!', 'success');
        return view('user.index');
    }
}
