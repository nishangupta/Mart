<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerQuestionController;
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
use App\Http\Controllers\DirectBuyController;
use App\Http\Controllers\FlashSaleController;
use App\Http\Controllers\MyCancellationController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\ReturnedController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShopController::class, 'index'])->name('shop.index');

Route::get('/shop/{id}-{slug}', [ShopController::class, 'show'])->name('shop.show');
Route::get('/catalog', [ShopController::class, 'catalog'])->name('shop.catalog');
Route::redirect('/shop', '/');

//flash-sale directbuy
Route::post('/direct-buy', [DirectBuyController::class, 'order'])->name('directBuy.order');

//redirect routes
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

//user cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart/api/all', [CartController::class, 'all']);
Route::post('/cart/destroy/selected', [CartController::class, 'destroySelected']);

//user my-orders
Route::get('/my-order', [MyOrderController::class, 'index'])->name('myOrder.index');
Route::delete('/my-order/{id}', [MyOrderController::class, 'destroy'])->name('myOrder.destroy');

//user my-orders
Route::get('/my-cancellation', [MyCancellationController::class, 'index'])->name('myCancellation.index');
Route::post('/my-cancellation', [MyCancellationController::class, 'store'])->name('myCancellation.store');

//user
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::post('/user/address', [UserController::class, 'address'])->name('user.address');

//customer queries
Route::get('/customer-question', [CustomerQuestionController::class, 'index'])->name('customerQuestion.index');
Route::middleware('auth')->post('/customer-question', [CustomerQuestionController::class, 'store'])->name('customerQuestion.store');
Route::middleware('auth')->delete('/customer-question/{id}', [CustomerQuestionController::class, 'destroy'])->name('customerQuestion.destroy');

//accounts
Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
Route::put('/account/changePassword', [AccountController::class, 'changePassword'])->name('account.changePassword');

//admin
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
Route::get('/admin/login', [AdminController::class, 'loginView'])->name('admin.loginView');
//print Invoice
Route::get('/invoice/{order}', [InvoiceController::class, 'index'])->name('invoice.index');
//customer questions
Route::middleware('role:admin')->get('/admin/customer-question', [CustomerQuestionController::class, 'adminView'])->name('customerQuestion.adminView');
Route::middleware('role:admin')->get('/admin/customer-question/{id}/reply', [CustomerQuestionController::class, 'adminReply'])->name('customerQuestion.adminReply');
Route::middleware('role:admin')->post('/admin/customer-question', [CustomerQuestionController::class, 'massDelete'])->name('customerQuestion.massDelete');
Route::middleware('role:admin')->put('/admin/customer-question/{id}/reply', [CustomerQuestionController::class, 'reply'])->name('customerQuestion.reply');

//flashSale
Route::get('/flash-sale', [FlashSaleController::class, 'index'])->name('flashSale.index');
Route::get('/flash-sale/create', [FlashSaleController::class, 'create'])->name('flashSale.create');
Route::post('/flash-sale', [FlashSaleController::class, 'store'])->name('flashSale.store');
Route::get('/flash-sale/{id}/edit', [FlashSaleController::class, 'edit'])->name('flashSale.edit');
Route::put('/flash-sale/{id}', [FlashSaleController::class, 'update'])->name('flashSale.update');
Route::delete('/flash-sale', [FlashSaleController::class, 'destroy'])->name('flashSale.destroy');


//User Management 
Route::get('/user-management', [UserManagementController::class, 'index'])->name('userManagement.index');
Route::post('/user-management', [UserManagementController::class, 'store'])->name('userManagement.store');
Route::get('/user-management/{id}/destroy', [UserManagementController::class, 'destroy'])->name('userManagement.destroy');

//products
Route::resource('/product', ProductController::class);

Route::get('/product/get/image/{id}', [ProductImageController::class, 'index'])->name('productImage.index');
Route::get('/product/{id}/image', [ProductImageController::class, 'show'])->name('productImage.show');
Route::delete('/product/{id}/image', [ProductImageController::class, 'destroy'])->name('productImage.destroy');

//admin order controller
Route::resource('/order', OrderController::class);

//Ready to ship
Route::get('/ready-to-ship', [ReadyToShipController::class, 'index'])->name('readyToShip.index');
Route::post('/ready-to-ship', [ReadyToShipController::class, 'store'])->name('readyToShip.store');

//Shipped 
Route::get('/shipped', [ShippedController::class, 'index'])->name('shipped.index');
Route::post('/shipped', [ShippedController::class, 'store'])->name('shipped.store');

//Delivered 
Route::get('/delivered', [DeliveredController::class, 'index'])->name('delivered.index');
Route::post('/delivered', [DeliveredController::class, 'store'])->name('delivered.store');
Route::delete('/delivered/cleanup', [DeliveredController::class, 'cleanUp'])->name('delivered.cleanUp');

//returned 
Route::get('/returned', [ReturnedController::class, 'index'])->name('returned.index');
Route::post('/returned', [ReturnedController::class, 'store'])->name('returned.store');
Route::delete('/returned/cleanup', [ReturnedController::class, 'cleanUp'])->name('returned.cleanUp');

//cancelled 
Route::get('/ship-cancelled', [ShipCancelledController::class, 'index'])->name('shipCancelled.index');
Route::post('/ship-cancelled', [ShipCancelledController::class, 'store'])->name('shipCancelled.store');
Route::delete('/ship-cancelled/cleanup', [ShipCancelledController::class, 'cleanUp'])->name('shipCancelled.cleanUp');

//category
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('/category/removeSubCategory/{subCategory}', [CategoryController::class, 'removeSubCategory'])->name('category.removeSubCategory');
