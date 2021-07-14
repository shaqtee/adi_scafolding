<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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
});

/*
|--------------------------------------------------------------------------
| Public Routing All
|--------------------------------------------------------------------------
|
| Part yang bersifat optional untuk menjalin interaksi dengan member
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
| Ini adalah Part Showcase atau index.
|
*/
Route::get('/', function () {
    return view('welcome');
});
