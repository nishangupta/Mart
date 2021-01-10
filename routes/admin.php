<?php

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShippedController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ReturnedController;
use App\Http\Controllers\Admin\DeliveredController;
use App\Http\Controllers\Admin\FlashSaleController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\ReadyToShipController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ShipCancelledController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\CustomerQuestionController;

//admin login page
Route::get('/admin/login', [AdminLoginController::class, 'login'])->name('adminLogin.login')->middleware('guest');

// Route::prefix('admin')->get('/pro',function(){
//   $categories = [
//     [
//       'title'=>'Phone',
//       'product_code'=>'asdasdas',
//     ],

//   ];
//   // Product::truncate();
//   foreach($categories as $category){
//     DB::transaction(function()use($category){
//       $product = Product::create([
//         'title'=>$category['title'],
//         'user_id'=>1,
//         'description'=>'asdasdasd',
//         'slug'=>Str::slug($category['title']),
//         'price'=>123123,
//         'product_code'=>$category['product_code'],
//       ]);

//       $product->attributes()->create([
//         'product_id'=>1,
//         'type'=>'size',
//         'attribute'=>'M',
//         'stock'=>40,  
//       ]);
//     });
    
//   }
//   return redirect()->route('product.index');
// });


//Admin routes starts from here
Route::group(['prefix'=>'/admin','middleware' => ['auth', 'role:admin']], function () {

  Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
  
  Route::resource('/product', ProductController::class);
  Route::get('/product/{id}/image', [ProductImageController::class, 'show'])->name('productImage.show'); 
  Route::get('/product/get/image/{id}', [ProductImageController::class, 'index'])->name('productImage.index');
  Route::post('/product/image/{id}', [ProductImageController::class, 'store'])->name('productImage.store');
  Route::delete('/product/{id}/image', [ProductImageController::class, 'destroy'])->name('productImage.destroy');

  Route::get('/customer-question', [CustomerQuestionController::class, 'adminView'])->name('customerQuestion.adminView');
  Route::get('/customer-question/{id}/reply', [CustomerQuestionController::class, 'adminReply'])->name('customerQuestion.adminReply');
  Route::post('/customer-question', [CustomerQuestionController::class, 'massDelete'])->name('customerQuestion.massDelete');
  Route::put('/customer-question/{id}/reply', [CustomerQuestionController::class, 'reply'])->name('customerQuestion.reply');

  Route::get('/flash-sale', [FlashSaleController::class, 'index'])->name('flashSale.index');
  Route::get('/flash-sale/create', [FlashSaleController::class, 'create'])->name('flashSale.create');
  Route::post('/flash-sale', [FlashSaleController::class, 'store'])->name('flashSale.store');
  Route::get('/flash-sale/{id}/edit', [FlashSaleController::class, 'edit'])->name('flashSale.edit');
  Route::put('/flash-sale/{id}', [FlashSaleController::class, 'update'])->name('flashSale.update');
  Route::delete('/flash-sale', [FlashSaleController::class, 'destroy'])->name('flashSale.destroy');

  Route::get('/user-management', [UserManagementController::class, 'index'])->name('userManagement.index');
  Route::post('/user-management', [UserManagementController::class, 'store'])->name('userManagement.store');
  Route::get('/user-management/{id}/destroy', [UserManagementController::class, 'destroy'])->name('userManagement.destroy');
  Route::get('/user-management/get-all-users', [UserManagementController::class, 'getAllUsers'])->name('userManagement.getAllUsers');

  Route::resource('/carousel', CarouselController::class);

  Route::resource('/category', CategoryController::class);

  Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');

  Route::resource('/order', OrderController::class);

  Route::get('/invoice/{order}', [InvoiceController::class, 'index'])->name('invoice.index');

  Route::get('/ready-to-ship', [ReadyToShipController::class, 'index'])->name('readyToShip.index');
  Route::post('/ready-to-ship', [ReadyToShipController::class, 'store'])->name('readyToShip.store');

  Route::get('/shipped', [ShippedController::class, 'index'])->name('shipped.index');
  Route::post('/shipped', [ShippedController::class, 'store'])->name('shipped.store');

  Route::get('/delivered', [DeliveredController::class, 'index'])->name('delivered.index');
  Route::post('/delivered', [DeliveredController::class, 'store'])->name('delivered.store');
  Route::delete('/delivered/cleanup', [DeliveredController::class, 'cleanUp'])->name('delivered.cleanUp');

  Route::get('/returned', [ReturnedController::class, 'index'])->name('returned.index');
  Route::post('/returned', [ReturnedController::class, 'store'])->name('returned.store');
  Route::delete('/returned/cleanup', [ReturnedController::class, 'cleanUp'])->name('returned.cleanUp');

  Route::get('/ship-cancelled', [ShipCancelledController::class, 'index'])->name('shipCancelled.index');
  Route::post('/ship-cancelled', [ShipCancelledController::class, 'store'])->name('shipCancelled.store');
  Route::delete('/ship-cancelled/cleanup', [ShipCancelledController::class, 'cleanUp'])->name('shipCancelled.cleanUp');
});
