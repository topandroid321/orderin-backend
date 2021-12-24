<?php

use App\Events\Orderin;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGalleryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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

Route::get('/', function(){
    return redirect()->route('dashboard');
});

Route::get('/send', function(){
    Orderin::dispatch('Test Pesan Notif');
});

//dashboard

Route::group(['middleware' => 'auth'], function(){
        Route::group(['middleware' => 'role:admin'], function(){
                Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
                Route::resource('/users', UserController::class);
                Route::resource('/products', ProductController::class);
                Route::resource('/productCategory', ProductCategoryController::class);
                Route::resource('/products.gallery', ProductGalleryController::class)->shallow()->only([
                    'index', 'create', 'store', 'destroy'
                ]);
                Route::get('transaction/{id}/print/', 'TransactionController@print')->name('transaction.print');;
                Route::resource('transaction', TransactionController::class);
            });

        Route::group(['middleware' => 'role:Pegawai'], function () {
            Route::get('/dashboardPegawai',[DashboardController::class, 'dashboardPegawai']);
            Route::get('/UserProduct', [ProductController::class,'indexPegawai']);

        });
        Route::group(['middleware' => 'role:Koki'], function () {
            Route::get('/dashboardKoki',[DashboardController::class, 'dashboardKoki']);
        });
      
 });