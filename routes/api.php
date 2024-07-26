<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\JewelryController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\OrderController;

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
Route::apiResource('courier', CourierController::class);
Route::apiResource('promo', PromoController::class);
Route::apiResource('jewelry', JewelryController::class);
Route::apiResource('payment', PaymentController::class);
Route::apiResource('stock', StockController::class);

// DataTable
Route::get('/users', [UserController::class, 'show'])->name('admin.getUsers');
Route::get('/couriers', [CourierController::class, 'dtpopulate'])->name('admin.getCouriers');
Route::get('/promos', [PromoController::class, 'dtpopulate'])->name('admin.getPromos');
Route::get('/payments', [PaymentController::class, 'dtpopulate'])->name('admin.getPayments');
Route::get('/jewelries', [JewelryController::class, 'dtpopulate'])->name('admin.getJewelries');
Route::get('/stocks', [StockController::class, 'dtpopulate'])->name('admin.getStocks');
Route::get('/orders', [OrderController::class, 'dtpopulate'])->name('admin.geOrders');

// Excel Import
Route::post('/import-courier', [ExcelController::class, 'importCourier'])->name('courier.import');
Route::post('/import-promo', [ExcelController::class, 'importPromo'])->name('promo.import');
Route::post('/import-jewelry', [ExcelController::class, 'importJewelry'])->name('jewelry.import');
Route::post('/import-jewelryvariant', [ExcelController::class, 'importJewelryVariant'])->name('jewelryvariant.import');

// Login | Logout
Route::post('/user/login', [LoginController::class, 'login'])->middleware('web')->name('user.login');
Route::post('/user/logout', [LoginController::class, 'logout'])->middleware(['web', 'auth:sanctum'])->name('user.logout');

// User Profile
Route::get('/userprofile', [UserController::class, 'getUserProfile'])->middleware('auth:sanctum');
Route::post('/updateProfile', [UserController::class, 'updateProfile'])->middleware('auth:sanctum');
Route::post('/user/deactivate', [UserController::class, 'deactivate'])->middleware('auth:sanctum');

// Admin Users
Route::post('/user/activate/{id}', [UserController::class, 'activate'])->name('adminuser.activate');
Route::post('/user/permadelete/{id}', [UserController::class, 'permadelete'])->name('adminuser.permadelete');

// Admin Assign Promo to Jewelries
Route::get('/admin/getJewelries/{id}', [PromoController::class, 'getJewelry'])->name('admin.getpromoJewelries');
Route::post('/admin/jewelrypromosave/{id}', [PromoController::class, 'jewelrypromosave'])->name('admin.jewelrypromosave');





// AttachFave Jewelry
Route::post('/user/fave', [ItemController::class, 'AddFave'])->middleware('auth:sanctum');
// attach2Cart
Route::post('/item/cartz', [ItemController::class, 'AddCart'])->middleware('auth:sanctum');
// populate thingz
Route::get('/fetchingFave', [ItemController::class, 'fetchFave'])->middleware('auth:sanctum');
Route::get('/fetchCart', [CartController::class, 'CartPop'])->middleware('auth:sanctum');
Route::get('/fetchCheck', [CheckoutController::class, 'CheckPop'])->middleware('auth:sanctum');
Route::get('/item', [ItemController::class, 'home'])->name('home.fetch');
Route::get('/fetchOrder', [CheckoutController::class, 'OrderPop'])->middleware('auth:sanctum');
Route::get('/fetchModCheck', [CheckoutController::class, 'ModCheckPop'])->middleware('auth:sanctum');
Route::get('/AUTOCOM', [ItemController::class, 'popopop']);
Route::get('/carousel', [PromoController::class, 'carouu']);

// Status Order Manipulator
Route::post('/Manipulate', [OrderController::class, 'manipulator']);


// delete fave
Route::delete('/user/{userId}/jewelry', [ItemController::class, 'detachJewelry'])->middleware('auth:sanctum');

// Transac Final Momints:
Route::post('/Fin', [CheckoutController::class, 'Endo'])->middleware('auth:sanctum');

// CART + - x ACTIONS BRUHHHHHH
Route::post('/add/jewel2Cart', [CartController::class, 'Increase'])->middleware('auth:sanctum');
Route::post('/decrease/jewel2Cart', [CartController::class, 'Decrease'])->middleware('auth:sanctum');
Route::post('/delete/jewel2Cart', [CartController::class, 'Remove'])->middleware('auth:sanctum');

// Cancell Order
Route::put('/cancel', [CheckoutController::class, 'Kansel'])->middleware('auth:sanctum');


Route::get('/item/description', [ItemController::class, 'stonks'])->name('item.des');
Route::get('/item/description/{id}', [ItemController::class, 'description'])->name('item.description');


// dont know how to use resource lol
Route::get('/InfoOrder', [OrderController::class, 'contentModal']);


// ===================================================================== //
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

