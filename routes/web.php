<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\JewelryController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\CourierController;
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

Route::get('/item', [ItemController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('home.about');
})->name('about');

Route::get('/orderhistory', function () {
   return view('home.orderhistory');
})->name('orderhistory');

Route::get('/favorites', function () {
    return view('home.favorites');
 })->name('favorites');

Route::get('/checkout', function () {
    return view('home.checkout');
})->name('checkout');


// Admin
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
Route::get('/admin/couriers', function () { return view('admin.courier'); })->name('admin.courier');
Route::get('/admin/jewelries', function () { return view('admin.jewelry'); })->name('admin.jewelry');
Route::get('/admin/promos', function () { return view('admin.promo'); })->name('admin.promo');
Route::get('/admin/payments', function () { return view('admin.payment'); })->name('admin.payment');
Route::get('/admin/stocks', function () { return view('admin.stock'); })->name('admin.stock');

// Customer
Route::get('/customer/profile', [UserController::class, 'profile'])->name('customer.profile');

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');


