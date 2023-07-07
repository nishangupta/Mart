<?php

use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Api\DeliveredApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\ReadyToShipApiController;
use App\Http\Controllers\Api\ReturnedApiController;
use App\Http\Controllers\Api\ShipCancelledApiController;
use App\Http\Controllers\Api\ShippedApiController;
use App\Http\Controllers\Api\UserManagementApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//products
Route::get('/product/all', [ProductApiController::class, 'all'])->name('product.all');
Route::get('/product/onsale/invert/{id}', [ProductApiController::class, 'onSaleInvert'])->name('product.onSaleInvert');
Route::get('/product/live/invert/{id}', [ProductApiController::class, 'liveInvert'])->name('product.liveInvert');

//orders api
Route::get('/order/all', [OrderApiController::class, 'all'])->name('order.all');

//ready to ship api
Route::get('/ready-to-ship/all', [ReadyToShipApiController::class, 'all'])->name('readyToShip.all');

//shipped api
Route::get('/shipped/all', [ShippedApiController::class, 'all'])->name('shipped.all');

//delivered api
Route::get('/delivered/all', [DeliveredApiController::class, 'all'])->name('delivered.all');

//return api
Route::get('/returned/all', [ReturnedApiController::class, 'all'])->name('returned.all');

//cancelled api
Route::get('/ship/cancelled/all', [ShipCancelledApiController::class, 'all'])->name('shipCancelled.all');

//usermangement api
Route::get('/user-management/all', [UserManagementApiController::class, 'all'])->name('userManagement.all');

//image uploading
Route::post('/product/images/{id}', [ProductImageController::class, 'store'])->name('store');
