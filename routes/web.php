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

// User CRUD (Try Muna)
/*  {user} are supposed to be {id}
    put are used usually on update since it has reference on URL (based on REST api)? but post can also do the same
*/
Route::get('/admin/user', [UserController::class, 'create'])->name('user.create');
Route::post('/admin/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/admin/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/admin/user/{id}/update', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}/delete', [UserController::class, 'delete'])->name('user.delete');
