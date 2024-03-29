<?php

use App\AppSetting as AppAppSetting;
use App\Http\Controllers\AuthController;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Discount\DiscountVoucher;
use App\Http\Livewire\Product\ProductCategory;
use \App\Http\Livewire\Product\ProductList;
use App\Http\Livewire\Product\ProductPurchase;
use App\Http\Livewire\Report\FinanceReport;
use App\Http\Livewire\Report\ProductReport;
use App\Http\Livewire\Employee\EmployeeData;
use App\Http\Livewire\Employee\EmployeeAccount;
use App\Http\Livewire\Setting\AccountSetting;
use App\Http\Livewire\Setting\AppSetting;
use App\Http\Livewire\Setting\SetupPage;
use App\Http\Livewire\Transaction\Transaction;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

use \App\Http\Livewire\Counter;
use App\Http\Livewire\Report\ExpenseReport;

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

            Route::group(['prefix' => 'produk'], function(){
                Route::get('/kategori-produk', ProductCategory::class);
                Route::get('/data-produk', ProductList::class);
                Route::get('/pembelian-produk', ProductPurchase::class);
            });

            Route::get('/transaksi', Transaction::class);
            Route::get('/diskon', DiscountVoucher::class);

            Route::group(['prefix' => 'pengaturan'], function(){
                Route::get('/aplikasi', AppSetting::class);
                Route::get('/akun', AccountSetting::class);
            });


            Route::group(['prefix' => 'laporan'], function(){
                Route::get('/pengeluaran', ExpenseReport::class);
                Route::get('/keuangan', FinanceReport::class);
                Route::get('/produk', ProductReport::class);
            });

            Route::group(['prefix' => 'pegawai'], function(){
                Route::get('/data-pegawai', EmployeeData::class);
                Route::get('/akun-pegawai', EmployeeAccount::class);
            });


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



