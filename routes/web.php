<?php

use App\Models\Dish;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NotiViewController;
use App\Http\Controllers\NotificationController;

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

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();
Auth::routes([
     'register' => false,

]);

Route::get('/', [OrderController::class, 'index'])->name('order');
Route::resource('/dish',DishController::class)->middleware('auth');
Route::get('/order', [DishController::class, 'orderList'])->name('kitchen.order');
Route::get('/order/{order}/approve', [DishController::class, 'Approve']);
Route::get('/order/{order}/cancel', [DishController::class, 'Cancel']);
Route::get('/order/{order}/ready', [DishController::class, 'Ready']);
Route::get('/order/{order}/serve', [OrderController::class, 'Serve']);
Route::post('/order_form', [OrderController::class, 'submit'])->name('order.form');
Route::post('/search', [OrderController::class, 'search'])->name('order.form');

Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::post('/order', [OrderController::class, 'store'])->name('order.form');// your order submission logic
//Notification
Route::get('/noti', [NotificationController::class, 'index']);
Route::get('/noti/view/{id}', [NotiViewController::class, 'view'])->name('noti.view');

//Add to cart

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/products', [CartController::class, 'showProducts'])->name('products.list');
    Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'showCart'])->name('view');
    Route::post('/cart/place-order', [CartController::class, 'placeOrder'])->name('cart.order');
    // Update quantity
Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');

// Remove item
Route::post('/cart/remove/{id}', [CartController::class, 'removeCartItem'])->name('cart.remove');

});
