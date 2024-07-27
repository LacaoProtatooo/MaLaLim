<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
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
use App\Http\Controllers\ChartController;
use App\Http\Controllers\MaterialController;


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

// Login | Logout
Route::resource('user', UserController::class);
Route::post('/user/login', [LoginController::class, 'login'])->name('user.login');
Route::post('/user/logout', [LoginController::class, 'logout'])->name('user.logout');

Route::middleware('auth:sanctum')->group(function () {

    // ================================ USER: ADMIN ================================ //

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

    Route::get('/materials', [MaterialController::class, 'dtpopulate'])->name('admin.getMat');
    Route::post('/materials/create', [MaterialController::class, 'store']);
    Route::put('/materials/update/{id}', [MaterialController::class, 'update']);
    Route::delete('/materials/{id}', [MaterialController::class, 'delete']);

    Route::get('/getmaterials/{id}', [JewelryController::class, 'modpop']);
    Route::post('/savematerialstoJewelry/{id}', [JewelryController::class, 'save']);

    // Excel Import
    Route::post('/import-courier', [ExcelController::class, 'importCourier'])->name('courier.import');
    Route::post('/import-promo', [ExcelController::class, 'importPromo'])->name('promo.import');
    Route::post('/import-jewelry', [ExcelController::class, 'importJewelry'])->name('jewelry.import');
    Route::post('/import-jewelryvariant', [ExcelController::class, 'importJewelryVariant'])->name('jewelryvariant.import');

    // Sidebar
    Route::get('/sidebar', [Admincontroller::class, 'sidebar'])->name('side.bar');

    // Charts
    Route::get('/chart-line', [ChartController::class, 'linechart'])->name('chart.line');
    Route::get('/chart-bar', [ChartController::class, 'barchart'])->name('chart.bar');
    Route::get('/chart-pie', [ChartController::class, 'piechart'])->name('chart.pie');

    // Admin Users
    Route::post('/user/activate/{id}', [UserController::class, 'activate'])->name('adminuser.activate');
    Route::post('/user/permadelete/{id}', [UserController::class, 'permadelete'])->name('adminuser.permadelete');

    // Admin Assign Promo to Jewelries
    Route::get('/admin/getJewelries/{id}', [PromoController::class, 'getJewelry'])->name('admin.getpromoJewelries');
    Route::post('/admin/jewelrypromosave/{id}', [PromoController::class, 'jewelrypromosave'])->name('admin.jewelrypromosave');

    // =============================== USER: CUSTOMER =============================== //

    // User Profile
    Route::get('/userprofile', [UserController::class, 'getUserProfile']);
    Route::post('/updateProfile', [UserController::class, 'updateProfile']);
    Route::post('/user/deactivate', [UserController::class, 'deactivate']);
// Attach Favorite Jewelry
    Route::post('/user/fave', [ItemController::class, 'AddFave']);

    // Attach to Cart
    Route::post('/item/cartz', [ItemController::class, 'AddCart']);

    // Populate Thingz
    Route::get('/fetchingFave', [ItemController::class, 'fetchFave']);
    Route::get('/fetchCart', [CartController::class, 'CartPop']);
    Route::get('/fetchCheck', [CheckoutController::class, 'CheckPop']);
    Route::get('/fetchOrder', [CheckoutController::class, 'OrderPop']);
    Route::get('/fetchModCheck', [CheckoutController::class, 'ModCheckPop']);



    // Status Order Manipulator
    Route::post('/Manipulate', [OrderController::class, 'manipulator']);
    // Delete Favorite
    Route::delete('/user/{userId}/jewelry', [ItemController::class, 'detachJewelry']);
    // Transaction Final Momints:
    Route::post('/Fin', [CheckoutController::class, 'Endo']);
    // CART + - x ACTIONS BRUHHHHHH
    Route::post('/add/jewel2Cart', [CartController::class, 'Increase']);
    Route::post('/decrease/jewel2Cart', [CartController::class, 'Decrease']);
    Route::post('/delete/jewel2Cart', [CartController::class, 'Remove']);

        // Cancel Order
    Route::put('/cancel', [CheckoutController::class, 'Kansel']);
    Route::get('/carousel', [PromoController::class, 'carouu']);

    // dont know how to use resource lol
    Route::get('/InfoOrder', [OrderController::class, 'contentModal']);


});

// ANO ANO MGA NEED DITO NG AUTH:SANCTUM







Route::get('/item', [ItemController::class, 'home'])->name('home.fetch');
Route::get('/AUTOCOM', [ItemController::class, 'popopop']);

Route::get('/item/description', [ItemController::class, 'stonks'])->name('item.des');
Route::get('/item/description/{id}', [ItemController::class, 'description'])->name('item.description');





// ===================================================================== //
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

