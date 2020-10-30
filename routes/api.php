<?php

use App\Http\Controllers\Api\ProductApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductImageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//products
Route::get('/product/all', [ProductApiController::class, 'all'])->name('product.all');
Route::get('/product/onsale/invert/{id}', [ProductApiController::class, 'onSaleInvert'])->name('product.onSaleInvert');
Route::get('/product/live/invert/{id}', [ProductApiController::class, 'liveInvert'])->name('product.liveInvert');

//image uploading
Route::post('/product/images/{id}', [ProductImageController::class, 'store'])->name('store');
