<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function(){
    Route::match(['get','post'],'/login',[AuthController::class,'login'])->name('login');
    Route::match(['get','post'],'/register',[AuthController::class,'register'])->name('register');
    
    Route::middleware('auth')->group(function(){
        Route::get('/',[DashboardController::class,'dashboard'])->name('dashboard');
    });
});

