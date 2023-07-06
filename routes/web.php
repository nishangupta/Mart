<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\MyCancellationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\User\Catalog;
use App\Http\Controllers\User\DirectBuy;
use App\Http\Controllers\User\Shop;
use App\Http\Controllers\User\ShowProduct;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::group(['middleware' => ['web']], function () {
    Route::get('/', Shop::class)
        ->name('shop.index');
    Route::get('/shop/{id}-{slug}', ShowProduct::class)
        ->name('shop.show');
    Route::get('/catalog', Catalog::class)
        ->name('shop.catalog');
    Route::permanentRedirect('/shop', '/');
});

// Redirecting users, admin to dashboard and users to their accounts
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

//Account management
Route::group(['middleware' => ['web', 'auth']], function () {
    //logout for all role users
    Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');

    //changing the password
    Route::put('/account/changePassword', [AccountController::class, 'changePassword'])->name('account.changePassword');
});


// User routes
// needs auth middleware
Route::group(['middleware' => ['web', 'role:user|admin']], function () {
    // user cart
    Route::view('/cart', 'user.my-cart')->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart/api/all', [CartController::class, 'all']);
    Route::post('/cart/destroy/selected', [CartController::class, 'destroySelected']);

    Route::get('/my-order', [MyOrderController::class, 'index'])->name('myOrder.index');
    Route::delete('/my-order/{id}', [MyOrderController::class, 'destroy'])->name('myOrder.destroy');

    Route::get('/my-cancellation', [MyCancellationController::class, 'index'])->name('myCancellation.index');
    Route::post('/my-cancellation', [MyCancellationController::class, 'store'])->name('myCancellation.store');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user/address', [UserController::class, 'address'])->name('user.address');
});
