<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ReadyToShipController;
use App\Http\Controllers\ShippedController;
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

//products
Route::resource('/product', ProductController::class);

Route::get('/product/get/image/{id}', [ProductImageController::class, 'index'])->name('productImage.index');
Route::get('/product/{id}/image', [ProductImageController::class, 'show'])->name('productImage.show');
Route::delete('/product/{id}/image', [ProductImageController::class, 'destroy'])->name('productImage.destroy');

//orders
Route::resource('/order', OrderController::class);
// Route::get('/order/test', [OrderController::class, 'test']);

//Ready to ship
Route::get('/ready-to-ship', [ReadyToShipController::class, 'index'])->name('readyToShip.index');
Route::post('/ready-to-ship', [ReadyToShipController::class, 'store'])->name('readyToShip.store');

//Shipped 
Route::get('/shipped', [ShippedController::class, 'index'])->name('shipped.index');
Route::post('/shipped', [ShippedController::class, 'store'])->name('shipped.store');

//category
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('/category/removeSubCategory/{subCategory}', [CategoryController::class, 'removeSubCategory'])->name('category.removeSubCategory');
