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


// USERS
Route::get('/admin/user', [UserController::class, 'userpopulate'])->name('user.populate');
Route::post('/admin/user/store', [UserController::class, 'userstore'])->name('user.store');
Route::get('/admin/user/{id}/edit', [UserController::class, 'useredit'])->name('user.edit');
Route::put('/admin/user/{id}/update', [UserController::class, 'userupdate'])->name('user.update');
Route::delete('/user/{id}/delete', [UserController::class, 'userdelete'])->name('user.delete');
