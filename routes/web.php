<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
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

Route::get('/about', function () {
    return view('home.about');
})->name('about');

Route::get('/orderhistory', function () {
   return view('home.orderhistory');
})->name('orderhistory');

// Route::get('/login', function () {
//     return view('home.login');
// })->name('login');

Route::get('/checkout', function () {
    return view('customer.checkout');
})->name('checkout');

// ============== REAL NIGGA ============ //

// Admin
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');


