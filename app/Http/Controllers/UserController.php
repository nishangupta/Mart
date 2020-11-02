<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    //user profile 
    public function index()
    {
        return view('user.index');
    }

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
