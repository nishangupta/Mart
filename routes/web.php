<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//app
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

//user
Route::get('/user', [UserController::class, 'index'])->name('user.index');

//accounts
Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
Route::get('/change', [AccountController::class, 'logout'])->name('account.logout');

//admin
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/login', [AdminController::class, 'loginView'])->name('admin.loginView');
