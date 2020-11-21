<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use App\Models\User;

class AccountController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');;
    }

    public function changePassword(Request $request)
    {
        if (!auth()->user()) {
            Alert::toast('Not authenticated!', 'success');
            return redirect()->back();
        }

        //check if the password is valid
        $request->validate([
            'current_password' => 'required|min:8',
            'new_password' => 'required|min:8'
        ]);

        $authUser = auth()->user();

        $currentP = $request->current_password;
        $newP = $request->new_password;
        $confirmP = $request->confirm_password;

        //If the password is incorrect
        if (!Hash::check($currentP, $authUser->password)) {
            Alert::toast('Incorrect Password!', 'info');
            return redirect()->back();
        }

        if (!Str::of($newP)->exactly($confirmP)) {
            Alert::toast('Passwords do not match!', 'info');
            return redirect()->back();
        }

        $user = User::find($authUser->id);
        $user->password = Hash::make($newP);
        if ($user->save()) {
            Alert::toast('Password Changed!', 'success');
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->intended('/');
            }
        }
        return redirect()->back();
    }
}
