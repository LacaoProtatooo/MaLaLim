<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('user', UserController::class);

// DataTable
Route::get('/users', [UserController::class, 'show'])->name('user.getUsers');

//Login
Route::post('/user/login', [LoginController::class, 'login'])->name('user.login');

// Route::post('/admin/user/store', [UserController::class, 'store'])->name('user.store');
// Route::get('/admin/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
// Route::put('/admin/user/{id}/update', [UserController::class, 'update'])->name('user.update');
// Route::delete('/user/{id}/delete', [UserController::class, 'destroy'])->name('user.delete');
