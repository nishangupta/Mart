<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserManagementController extends Controller
{
    public function index()
    {
        return view('admin.user-management.index');
    }
    public function store(Request $request)
    {
        //validating the req
        $this->requestValidate($request);
        $user = new User();

        $this->saveUser($user, $request);

        Alert::toast('User Created!', 'success');
        return redirect(route('userManagement.index'));
    }

    public function destroy(User $id)
    {
        $id->delete();
        return redirect(route('userManagement.index'));
    }

    public function getAllUsers()
    {
        return view('admin.user-management.all')->with([
            'users' => User::with('userInfo')->paginate(25),
        ]);
    }

    private function saveUser($user, $request)
    {
        DB::transaction(function () use ($user, $request) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->userInfo()->create([
                'phone' => $request->phone,
                'address' => $request->address
            ]);
        }, 5);
        $user->assignRole($request->role);
    }
    private function requestValidate($request)
    {
        return $request->validate([
            'name' => 'required|min:3',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)
            ],
            'password' => 'required|min:8',
            'phone' => 'required|min:5',
            'address' => 'required',
            'role' => 'required'
        ]);
    }
}
