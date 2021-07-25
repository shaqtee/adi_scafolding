<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\WelcomeController;

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

Auth::routes();
/*
|--------------------------------------------------------------------------
| Member Routing All
|--------------------------------------------------------------------------
|
| Member dan innovasi perkembangannya semisal menambahkan fitur Member
| berjenjang dan beserta fungsinya semisalnya supaya lebih terstruktur
| usahakan perencanaannya disini.
|
*/

Route::middleware(['auth', 'role:user'])->group(function () {
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
Route::middleware(['auth', 'role:administrator'])->group(function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin');
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
Route::get('/home', [HomeController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| Display Front Publicly
|--------------------------------------------------------------------------
|
| Ini adalah Part Showcase Products atau index products.
|
*/
Route::get('/', [WelcomeController::class, 'index']);
Route::get('/kategori/{key:kategori}', [WelcomeController::class, 'productByCategory']);
Route::get('/tag/{key:tag}', [WelcomeController::class, 'productByTag']);
Route::get('/cart', [WelcomeController::class, 'cart']);
Route::get('/single', [WelcomeController::class, 'single']);
