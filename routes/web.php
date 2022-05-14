<?php

use App\Http\Livewire\Discount\DiscountVoucher;
use App\Http\Livewire\Product\ProductCategory;
use \App\Http\Livewire\Product\ProductList;
use App\Http\Livewire\Setting\AppSetting;
use App\Http\Livewire\Transaction\Transaction;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('layouts.dashboard');
});

Route::get('/produk/kategori-produk', ProductCategory::class);
Route::get('/produk/data-produk', ProductList::class);
Route::get('/transaksi', Transaction::class);
Route::get('/diskon', DiscountVoucher::class);

Route::get('/pengaturan/pengaturan-aplikasi', AppSetting::class);
