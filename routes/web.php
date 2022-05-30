<?php

use App\AppSetting as AppAppSetting;
use App\Http\Controllers\AuthController;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Discount\DiscountVoucher;
use App\Http\Livewire\Product\ProductCategory;
use \App\Http\Livewire\Product\ProductList;
use App\Http\Livewire\Setting\AppSetting;
use App\Http\Livewire\Setting\SetupPage;
use App\Http\Livewire\Transaction\Transaction;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

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



if(Schema::hasTable('app_settings')){
    Route::get('/setup', SetupPage::class);
    $settings = AppAppSetting::first();
    if(!$settings){
        Route::get('/', function(){
            return redirect('/setup');
        });

        Route::get('/{any}', function($any){
            return redirect('/setup');
        })->where('any', '.*');
    }else{

        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/login', [AuthController::class, '__login'])->name('post-login');


        Route::middleware(['auth'])->group(function() {

            Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

            Route::get('/', Dashboard::class);
            Route::get('/produk/kategori-produk', ProductCategory::class);
            Route::get('/produk/data-produk', ProductList::class);
            Route::get('/transaksi', Transaction::class);
            Route::get('/diskon', DiscountVoucher::class);
            Route::get('/pengaturan/pengaturan-aplikasi', AppSetting::class);
        });

    }
}else{
    Route::get('/', function(){
        if(Artisan::call('migrate')){
            return "Check database connection !";
        }else{
            Artisan::call('db:seed');
            return redirect()->to('/');
        };
    });
    Route::get('/{any}', function($any){
        if(Artisan::call('migrate')){
            return "Check database connection !";
        }else{
            Artisan::call('db:seed');
            return redirect()->to('/');
        };
    })->where('any', '.*');
}


