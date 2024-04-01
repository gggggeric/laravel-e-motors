<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () { 

    // Seller Routes
    Route::post('/product', [ProductController::class, 'store'])->name('seller.store');
    Route::get('/product/create', [ProductController::class, 'createProduct'])->name('seller.createProduct');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('seller.editProduct');
    Route::put('/product/{product}/update', [ProductController::class, 'update'])->name('seller.update');
    Route::delete('/product/{product}/destroy', [ProductController::class, 'destroy'])->name('seller.destroy');
    Route::get('/search', [ProductController::class, 'search'])->name('seller.searchProducts');

    // Admin Routes
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/{users}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{users}/update', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{users}/destroy', [AdminController::class, 'destroy'])->name('admin.destroy');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Order Routes
    // Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
    Route::get('/order/create/{product_id}', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/{orderId}/review', [OrderController::class, 'review'])->name('order.review');
    Route::post('/order/{id}/submit-review', [OrderController::class, 'submitReview'])->name('order.submitReview');
    Route::get('/orders', [OrderController::class, 'showOrders'])->name('order.show');




    // Route::get('/order/{orders}/update', [OrderController::class, 'showAndUpdate'])->name('order.showAndUpdate');
    // Route::put('/order/{orderId}', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    // Route::get('/order/{users}/edit', [OrderController::class, 'edit'])->name('admin.edit');
    // Route::put('/order/{id}/update-status', 'OrderController@updateStatus')->name('order.updateStatus');
    // Route::get('/order', [OrderController::class, 'edit'])->name('order.edit');
    Route::get('/order/{productId}/edit', [OrderController::class, 'edit'])->name('order.edit');
    // Route::put('/order/{orderId}', [OrderController::class, 'update'])->name('order.update');
    Route::post('/orders/update-status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');


    //for crud sa comments


    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', 'ReviewController@update')->name('reviews.update');

    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');





    
    // Custom Email Verification Routes
    Route::get('/verify-email', [EmailVerificationController::class, 'verifyEmail'])->name('custom.verify-email');
    Route::get('/verification-notice', [EmailVerificationController::class, 'verificationNotice'])->name('custom.verification-notice');
     

});

// require __DIR__.'/auth.php';
