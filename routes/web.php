<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ReadyToShipController;
use App\Http\Controllers\ShippedController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShipCancelledController;
use App\Http\Controllers\DeliveredController;
use App\Http\Controllers\ReturnedController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShopController::class, 'index']);

//app
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

//user
Route::get('/user', [UserController::class, 'index'])->name('user.index');

//accounts
Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
Route::put('/account/changePassword', [AccountController::class, 'changePassword'])->name('account.changePassword');

//admin
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
Route::get('/admin/login', [AdminController::class, 'loginView'])->name('admin.loginView');

//User Management 
Route::get('/user-management', [UserManagementController::class, 'index'])->name('userManagement.index');
Route::post('/user-management', [UserManagementController::class, 'store'])->name('userManagement.store');
Route::get('/user-management/{id}/destroy', [UserManagementController::class, 'destroy'])->name('userManagement.destroy');

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

//Delivered 
Route::get('/delivered', [DeliveredController::class, 'index'])->name('delivered.index');
Route::post('/delivered', [DeliveredController::class, 'store'])->name('delivered.store');

//cancelled 
Route::get('/returned', [ReturnedController::class, 'index'])->name('returned.index');
Route::post('/returned', [ReturnedController::class, 'store'])->name('returned.store');

//cancelled 
Route::get('/ship/cancelled', [ShipCancelledController::class, 'index'])->name('shipCancelled.index');
Route::post('/ship/cancelled', [ShipCancelledController::class, 'store'])->name('shipCancelled.store');

//category
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('/category/removeSubCategory/{subCategory}', [CategoryController::class, 'removeSubCategory'])->name('category.removeSubCategory');


// Route::get('/invoice', function () {
//     return view('order.invoice');
// });
Route::get('/invoice/{order}', [InvoiceController::class, 'index'])->name('invoice.index');
