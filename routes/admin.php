<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerQuestion\MessDelete;
use App\Http\Controllers\Admin\CustomerQuestion\Reply;
use App\Http\Controllers\Admin\CustomerQuestion\ReplyView;
use App\Http\Controllers\Admin\DeliveredController;
use App\Http\Controllers\Admin\FlashSaleController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ReadyToShipController;
use App\Http\Controllers\Admin\ReturnedController;
use App\Http\Controllers\Admin\ShipCancelledController;
use App\Http\Controllers\Admin\ShippedController;
use App\Http\Controllers\Admin\UserManagementController;
use Illuminate\Support\Facades\Route;

// admin login page
Route::get('/admin/login', [AdminLoginController::class, 'login'])
    ->name('adminLogin.login')->middleware('guest');

// Admin routes starts from here
Route::group(['middleware' => ['web', 'role:admin']], function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::resource('/product', ProductController::class);
    Route::get('/product/get/image/{id}', [ProductImageController::class, 'index'])
        ->name('productImage.index');
    Route::get('/product/{id}/image', [ProductImageController::class, 'show'])
        ->name('productImage.show');
    Route::delete('/product/{id}/image', [ProductImageController::class, 'destroy'])
        ->name('productImage.destroy');

    // Customer Question functions
    Route::view('/admin/customer-question', 'admin.customer.customer-question')
        ->name('customerQuestion.adminView');
    Route::get('/admin/customer-question/{id}/reply', ReplyView::class)
        ->name('customerQuestion.adminReply');
    Route::post('/admin/customer-question', MessDelete::class)
        ->name('customerQuestion.massDelete');
    Route::put('/admin/customer-question/{question}/reply', Reply::class)
        ->name('customerQuestion.reply');

    Route::get('/flash-sale', [FlashSaleController::class, 'index'])
        ->name('flashSale.index');
    Route::get('/flash-sale/create', [FlashSaleController::class, 'create'])
        ->name('flashSale.create');
    Route::post('/flash-sale', [FlashSaleController::class, 'store'])
        ->name('flashSale.store');
    Route::get('/flash-sale/{id}/edit', [FlashSaleController::class, 'edit'])
        ->name('flashSale.edit');
    Route::put('/flash-sale/{id}', [FlashSaleController::class, 'update'])
        ->name('flashSale.update');
    Route::delete('/flash-sale', [FlashSaleController::class, 'destroy'])
        ->name('flashSale.destroy');

    Route::get('/user-management', [UserManagementController::class, 'index'])
        ->name('userManagement.index');
    Route::post('/user-management', [UserManagementController::class, 'store'])
        ->name('userManagement.store');
    Route::get('/user-management/{id}/destroy', [UserManagementController::class, 'destroy'])
        ->name('userManagement.destroy');
    Route::get('/user-management/get-all-users', [UserManagementController::class, 'getAllUsers'])
        ->name('userManagement.getAllUsers');

    Route::resource('/carousel', CarouselController::class);

    Route::get('/category', [CategoryController::class, 'index'])
        ->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])
        ->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])
        ->name('category.store');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])
        ->name('category.edit');
    Route::put('/category/{id}', [CategoryController::class, 'update'])
        ->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])
        ->name('category.destroy');
    Route::get('/category/removeSubCategory/{subCategory}', [CategoryController::class, 'removeSubCategory'])
        ->name('category.removeSubCategory');
});


Route::group(['middleware' => ['web', 'role:admin|shipper']], function () {
    Route::view('/admin/profile', 'admin.profile')
        ->name('admin.profile');

    Route::resource('/order', OrderController::class);

    Route::get('/invoice/{order}', [InvoiceController::class, 'index'])
        ->name('invoice.index');

    Route::get('/ready-to-ship', [ReadyToShipController::class, 'index'])
        ->name('readyToShip.index');
    Route::post('/ready-to-ship', [ReadyToShipController::class, 'store'])
        ->name('readyToShip.store');

    Route::get('/shipped', [ShippedController::class, 'index'])
        ->name('shipped.index');
    Route::post('/shipped', [ShippedController::class, 'store'])
        ->name('shipped.store');

    Route::get('/delivered', [DeliveredController::class, 'index'])
        ->name('delivered.index');
    Route::post('/delivered', [DeliveredController::class, 'store'])
        ->name('delivered.store');
    Route::delete('/delivered/cleanup', [DeliveredController::class, 'cleanUp'])
        ->name('delivered.cleanUp');

    Route::get('/returned', [ReturnedController::class, 'index'])
        ->name('returned.index');
    Route::post('/returned', [ReturnedController::class, 'store'])
        ->name('returned.store');
    Route::delete('/returned/cleanup', [ReturnedController::class, 'cleanUp'])
        ->name('returned.cleanUp');

    Route::get('/ship-cancelled', [ShipCancelledController::class, 'index'])
        ->name('shipCancelled.index');
    Route::post('/ship-cancelled', [ShipCancelledController::class, 'store'])
        ->name('shipCancelled.store');
    Route::delete('/ship-cancelled/cleanup', [ShipCancelledController::class, 'cleanUp'])
        ->name('shipCancelled.cleanUp');
});
