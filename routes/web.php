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
    Route::post('/admin/productmenu/update/{key}', [AdminController::class, 'productmenuUpdate']);
    Route::get('/admin/productmenu/{key}/delete', [AdminController::class, 'productmenuDelete']);

    Route::get('admin/history/transferbank', [AdminController::class, 'transferbankHistory']);
    Route::post('admin/transferbank/success', [AdminController::class, 'transferbankSuccess']);
    Route::post('admin/transferbank/failed', [AdminController::class, 'transferbankFailed']);

    Route::resource('product', ProductController::class);
    Route::post('/product/searchproducts', [ProductController::class, 'searchproducts']);
    Route::post('/product/tampil', [ProductController::class, 'tampil']);

    Route::post('product/tag/create', [ProductController::class, 'createTag']);
    Route::get('product/tag/{id}/delete', [ProductController::class, 'deleteTag']);
    Route::post('product/tag/show', [ProductController::class, 'showTag']);
    Route::post('product/tag/update/{id}', [ProductController::class, 'updateTag']);
    Route::post('product/tag/attach', [ProductController::class, 'attachTag']);
    Route::post('product/tag/detach', [ProductController::class, 'detachTag']);

    Route::get('/admin/history/mainprod', [AdminController::class, 'historyMainProd']);
    Route::post('/admin/history/showinvoice', [AdminController::class, 'showDetails']);
    Route::post('/admin/history/success/', [AdminController::class, 'successMainProd']);
    Route::post('/admin/history/refund/{inv}', [AdminController::class, 'refundMainProd']);

    Route::get('/admin/data/pengiriman', [AdminController::class, 'dataPengiriman']);
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
Route::post('/single/ulasan', [WelcomeController::class, 'ulasan']);

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

    /* profile */
    Route::get('home/profile', [HomeController::class, 'profile']);
    Route::post('home/profile/bank', [HomeController::class, 'profileBank']);
    Route::post('home/profile/password', [HomeController::class, 'profilePassword']);

    /* deposit */
    Route::get('/home/deposit', [HomeController::class, 'deposit']);

    /* transferBank */
    Route::get('/home/transferbank', [HomeController::class, 'transferbank']);
    Route::post('/home/transferbank/datarekening', [HomeController::class, 'dataRekening']);
    Route::post('/home/transferbank/store', [HomeController::class, 'transferbankStore']);
    Route::post('/home/transferbank/list', [HomeController::class, 'transferbankList']);

    /* history transfer bank */
    Route::get('/home/history/transferbank', [HomeController::class, 'transferbankHistory']);
    Route::get('/home/history/mainprod', [HomeController::class, 'mainProdHistory']);
    Route::post('/home/history/showdetails', [HomeController::class, 'showDetails']);

    /* claim */
    Route::get('/home/claim/form', [HomeController::class, 'showClaim']);
    Route::post('/home/claim/store', [HomeController::class, 'storeClaim']);

    /* kirim saldo */
    Route::get('/home/send/form', [HomeController::class, 'sendForm']);
    Route::post('/home/send/searchphone', [HomeController::class, 'searchPhone']);
    Route::post('/home/send/saldo', [HomeController::class, 'sendSaldo']);

    /* mutasi saldo utama */
    Route::get('/home/saldoutama', [HomeController::class, 'saldoUtama']);

    /* mutasi saldo bonus */
    Route::get('/home/saldobonus', [HomeController::class, 'saldoBonus']);
});
