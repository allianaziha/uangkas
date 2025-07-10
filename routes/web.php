<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\backendController;
use App\Http\Controllers\Backend\transaksikasController;
use App\Http\Controllers\Backend\Kas_mingguanController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\PembayaranController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin','as' => 'backend.','middleware' => ['auth', Admin::class]], function (){
    Route::get('/', [BackendController::class,'index']);
    //crud
    Route::resource('/kas_mingguan', Kas_mingguanController::class);
    Route::resource('/transaksikas', transaksikasController::class);
    Route::resource('/siswa', UserController::class);
    Route::resource('/pembayaran', PembayaranController::class);
    
});
