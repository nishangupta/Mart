<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //user profile 
    public function index()
    {
        return view('user.index');
    }
}
