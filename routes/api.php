<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

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

Route::post('/admin/user/store', [UserController::class, 'userstore'])->name('user.store');
Route::get('/admin/user/{id}/edit', [UserController::class, 'useredit'])->name('user.edit');
Route::put('/admin/user/{id}/update', [UserController::class, 'userupdate'])->name('user.update');
Route::delete('/user/{id}/delete', [UserController::class, 'userdelete'])->name('user.delete');
