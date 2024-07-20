<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
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

Route::resource('user', UserController::class);

// DataTable
Route::get('/users', [UserController::class, 'show'])->name('admin.getUsers');

// Login | Logout
Route::post('/user/login', [LoginController::class, 'login'])->middleware('web')->name('user.login');
Route::post('/user/logout', [LoginController::class, 'logout'])->middleware(['web', 'auth:sanctum'])->name('user.logout');

// User Profile
Route::get('/userprofile', [UserController::class, 'getUserProfile'])->middleware('auth:sanctum');
Route::post('/updateProfile', [UserController::class, 'updateProfile'])->middleware('auth:sanctum');
Route::post('/user/deactivate', [UserController::class, 'deactivate'])->middleware('auth:sanctum');
// AttachFave Jewelry
Route::post('/user/fave', [ItemController::class, 'AddFave'])->middleware('auth:sanctum');
// populate fave
Route::get('/fetchingFave', [ItemController::class, 'fetchFave'])->middleware('auth:sanctum');
Route::delete('/user/{userId}/jewelry', [ItemController::class, 'detachJewelry'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/item', [ItemController::class, 'home'])->name('home.fetch');
Route::get('/item/description', [ItemController::class, 'stonks'])->name('item.des');
Route::get('/item/description/{id}', [ItemController::class, 'description'])->name('item.description');

