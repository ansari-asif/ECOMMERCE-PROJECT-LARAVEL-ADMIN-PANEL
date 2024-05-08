<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::match(['get','post'],'admin/login',[AuthController::class,'login'])->name('login');
// Route::get('admin/register',[AuthController::class,'register'])->name('register_get');
Route::match(['get','post'],'admin/register',[AuthController::class,'register'])->name('register');

Route::get('/admin', function () {
    return view('admin.dashboard');
});
