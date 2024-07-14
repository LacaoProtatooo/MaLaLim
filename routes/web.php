<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

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
    return view('home.home');
})->name('home');

Route::get('/about', function () {
    return view('home.about');
})->name('about');

Route::get('/login', function () {
    return view('home.login');
})->name('login');

Route::get('/checkout', function () {
    return view('customer.checkout');
})->name('checkout');

// USERS
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');


