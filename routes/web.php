<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CategoryController;
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

//categories
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('/categories/removeSubCategory/{subCategory}', [CategoryController::class, 'removeSubCategory'])->name('category.removeSubCategory');
