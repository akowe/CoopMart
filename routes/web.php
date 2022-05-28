<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItem;
use App\Models\Product;

//Admin controllers

use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\CooperativeController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\VoucherController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('index');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/')->with('success','Verification successful');
})->middleware(['auth', 'signed'])->name('verification.verify');

//Users authentication on login pages for all admins
Route::get('superadmin', [App\Http\Controllers\SuperAdminController::class, 'index'])->name('superadmin');
Route::get('cooperative', [App\Http\Controllers\CooperativeController::class, 'index'])->name('cooperative');
Route::get('merchant', [App\Http\Controllers\MerchantController::class, 'index'])->name('merchant');
Route::get('dashboard', [App\Http\Controllers\MembersController::class, 'index'])->name('dashboard');

//product
Route::get('/', [ProductController::class, 'index']);  
Route::get('cart', [ProductController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [ProductController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove.from.cart');
Route::get('/category/', [CategoriesController::class,'category'])->name('category');
Route::match(['get', 'post'],'checkout', [ProductController::class, 'checkout']); 
Route::get('confirm_order',[OrderController::class, 'confirm_order'])->name('confirm_order');
Route::post('order', [OrderController::class, 'order'])->name('order'); 
//cancel an order.
Route::post('/cancel_order', [App\Http\Controllers\MembersController::class, 'cancel_order'])->name('cancel_order');
// from  product previw page 
Route::get('add-cart/{id}', [ProductController::class, 'addToCartPreview'])->name('add.cart');
Route::get('preview/{prod_name}', [App\Http\Controllers\ProductController::class, 'preview'])->name('preview');

// view cooperative members
Route::get('members', [App\Http\Controllers\CooperativeController::class, 'members'])->name('members');
// add credit for members
Route::post('/credit_limit', [App\Http\Controllers\VoucherController::class, 'credit_limit'])->name('credit_limit');
Route::post('limit', [App\Http\Controllers\VoucherController::class, 'limit'])->name('limit');
//cooperative admin see's invoice of his/her members only
Route::get('invoice/{order_id}', [App\Http\Controllers\CooperativeController::class, 'invoice'])->name('invoice');

//members see's their own invoice 
Route::get('member_invoice/{order_id}', [App\Http\Controllers\MembersController::class, 'member_invoice'])->name('member_invoice');


//Super admin  see's all invoice 
Route::get('sales_invoice/{order_id}', [App\Http\Controllers\SuperAdminController::class, 'sales_invoice'])->name('sales_invoice');

// Super mark an order as paid
Route::post('/mark_paid', [App\Http\Controllers\SuperAdminController::class, 'mark_paid'])->name('mark_paid');

Route::get('products_list', [App\Http\Controllers\SuperAdminController::class, 'products_list'])->name('products_list');

Route::get('users_list', [App\Http\Controllers\SuperAdminController::class, 'users_list'])->name('users_list');

Route::get('transactions', [App\Http\Controllers\SuperAdminController::class, 'transactions'])->name('transactions');


// Super mark an order as paid
Route::post('/approved', [App\Http\Controllers\SuperAdminController::class, 'approved'])->name('approved');

// paystack integration
Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'redirectToGateway'])->name('pay');
// paystack callback url
Route::get('/payment/callback', [App\Http\Controllers\PaymentController::class, 'handleGatewayCallback']);

//merchant upload product
Route::get('product', [App\Http\Controllers\MerchantController::class, 'product'])->name('product');
Route::post('upload-image', [App\Http\Controllers\MerchantController::class, 'store']);
Route::get('all_products', [App\Http\Controllers\MerchantController::class, 'all_products'])->name('all_products');
//soft delete.
Route::post('/remove_product', [App\Http\Controllers\MerchantController::class, 'remove_product'])->name('remove_product');

// Route::get('/foo', function () {
//     Artisan::call('storage:link');
// });


