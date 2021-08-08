<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Member\MemberController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

/*
|--------------------------------------------------------------------------
| Member (Agen) Routing All
|--------------------------------------------------------------------------
|
| Member dan innovasi perkembangannya semisal menambahkan fitur Member
| berjenjang dan beserta fungsinya semisalnya supaya lebih terstruktur
| usahakan perencanaannya disini.
|
*/

Route::middleware(['auth', 'role:user', 'verified'])->group(function () {
    Route::get('member', [MemberController::class, 'index'])->name('member');
});

/*
|--------------------------------------------------------------------------
| Admin Routing All
|--------------------------------------------------------------------------
|
| Sistem Admin dan innovasi perkembangannya semisal menambahkan fitur Admin
| berjenjang dan beserta fungsinya semisalnya supaya lebih terstruktur
| usahakan perencanaannya disini.
|
*/
Route::middleware(['auth', 'role:administrator', 'verified'])->group(function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/checkuseronline', [AdminController::class, 'checkUserOnline']);
    Route::get('/admin/productmenu', [AdminController::class, 'productmenu']);
    Route::post('/admin/productmenu/store', [AdminController::class, 'productmenuStore']);
    Route::resource('product', ProductController::class);
    Route::post('/product/searchproducts', [ProductController::class, 'searchproducts']);
    Route::post('/product/tampil', [ProductController::class, 'tampil']);
});

/*
|--------------------------------------------------------------------------
| Public Routing All
|--------------------------------------------------------------------------
|
| Part yang bersifat optional (validasi user) untuk menjalin interaksi dengan member
| yang beru melakukan registrasi agar mau memfokuskan diri dengan
| program ini sebagai member(agen) atau admin.
|
*/

Route::middleware(['auth', 'role:personal', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])
        ->name('home');

    Route::get('home/profile', [HomeController::class, 'profile']);


    Route::get('/home/transferbank', [HomeController::class, 'transferbank']);
    Route::get('/home/deposit', [HomeController::class, 'deposit']);

    Route::get('/home/history/mainprod', [HomeController::class, 'mainProdHistory']);
    Route::post('/home/history/showdetails', [HomeController::class, 'showDetails']);

    Route::get('/home/claim/form', [HomeController::class, 'showClaim']);
    Route::post('/home/claim/store', [HomeController::class, 'storeClaim']);
});



/*
|--------------------------------------------------------------------------
| Display Front Publicly
|--------------------------------------------------------------------------
|
| Ini adalah Part Showcase Products atau index products.
|
*/


Route::get('/', [WelcomeController::class, 'index']);
Route::get('/showcase/{showkey}', [WelcomeController::class, 'showProductBy']);

Route::get('/single/{key:id}', [WelcomeController::class, 'single']);

/* Simulasi */
Route::get('/cart', [WelcomeController::class, 'cart']);
Route::post('/cartaction', [WelcomeController::class, 'cartAction']);
Route::post('/cartdisaction', [WelcomeController::class, 'cartDisAction']);
Route::post('/cartupdateaction', [WelcomeController::class, 'cartUpdateAction']);


Route::post('/store', [WelcomeController::class, 'store'])->name('store');

Route::post('/selectongkir', [WelcomeController::class, 'selectongkir']);
Route::get('/api/province/{id}/cities', [WelcomeController::class, 'getCities']);
Route::get('/api/{id}/province/citiesid', [WelcomeController::class, 'getCitiesId']);
Route::post('/api/cities', [WelcomeController::class, 'searchCities']);

/* Produk Favorit */
Route::get('/wishlist', [WelcomeController::class, 'wishlist']);
Route::post('/wishlistaction', [WelcomeController::class, 'wishlistAction']);
Route::post('/wishlistdisaction', [WelcomeController::class, 'wishlistDisAction']);
Route::post('/wishlist/addtocart', [WelcomeController::class, 'wishlistAddToCart']);


Route::middleware(['auth', 'verified'])->group(function () {
    /* Fitur Penjualan Umum tanpa Bonus */
    Route::get('/checkout', [WelcomeController::class, 'checkout']);
    Route::post('/checkout/getaddress', [WelcomeController::class, 'checkoutGetAddress']);
    Route::post('/checkout/store', [WelcomeController::class, 'checkoutStore'])->name('checkoutStore');
    Route::post('/payment', [PaymentController::class, 'store']);

    /* Expedisi */
    Route::get('/pengiriman', [PengirimanController::class, 'pengiriman']);
    Route::post('/pengiriman/store', [PengirimanController::class, 'pengirimanStore']);
});
