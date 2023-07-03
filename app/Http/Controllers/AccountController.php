<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class AccountController extends Controller
{
    public function logout(): RedirectResponse
    {
        Auth::logout();

        return Redirect::route('login');
    }

    public function changePassword(Request $request)
    {
        if (!Auth::user()) {
            Alert::toast('Not authenticated!', 'success');

            return Redirect::back();
        }

        //check if the password is valid
        $request->validate([
            'current_password' => 'required|min:8',
            'new_password' => 'required|min:8',
        ]);

        /** @var User $authUser */
        $authUser = Auth::user();

        $currentPassword = $request->current_password;
        $newP = $request->new_password;
        $confirmPassword = $request->confirm_password;

        //If the password is incorrect
        if (!Hash::check($currentPassword, $authUser->password)) {
            Alert::toast('Incorrect Password!', 'info');
            return redirect()->back();
        }

        if (!Str::of($newP)->exactly($confirmPassword)) {
            Alert::toast('Passwords do not match!', 'info');
            return redirect()->back();
        }

        $user = User::find($authUser->id);
        $user->password = Hash::make($newP);
        if ($user->save()) {
            Alert::toast('Password Changed!', 'success');
            if ($user->hasRole('admin')) {
                return Redirect::route('admin.dashboard');
            } else {
                return Redirect::intended('/');
            }
        }

        return Redirect::back();
    }
}
