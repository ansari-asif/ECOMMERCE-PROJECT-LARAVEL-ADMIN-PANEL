<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function(){
    Route::match(['get','post'],'/login',[AuthController::class,'login'])->name('login');
    Route::match(['get','post'],'/register',[AuthController::class,'register'])->name('register');
    Route::match(['get'],'/logout',[AuthController::class,'logout'])->name('logout');

    
    Route::middleware('admin')->group(function(){
        Route::get('/',[DashboardController::class,'dashboard'])->name('dashboard');
        Route::get('/users',[UserController::class,'manage_users'])->name('users');
        Route::match(['get','post'],'/users/add_user',[UserController::class,'add_user'])->name('add_user');
        Route::match(['get','post'],'/users/edit_user/{id}',[UserController::class,'edit_user'])->name('edit_user');
        Route::match(['get'],'/users/delete_user/{id}',[UserController::class,'delete_user'])->name('delete_user');
        Route::match(['get'],'/users/status_user/{id}',[UserController::class,'status_user'])->name('status_user');

        // product Category
        Route::get('/product-category',[ProductCategoryController::class,'ListCategory'])->name('ListCategory');
        Route::match(['get','post'],'/product-category/add-category',[ProductCategoryController::class,'addCategory'])->name('addCategory');
        Route::match(['get','post'],'/product-category/edit-category/{id}',[ProductCategoryController::class,'editCategory'])->name('editCategory');
        Route::match(['get'],'/product-category/delete-category/{id}',[ProductCategoryController::class,'deleteCategory'])->name('deleteCategory');
        Route::match(['get'],'/product-category/status-category/{id}',[ProductCategoryController::class,'statusCategory'])->name('statusCategory');
    });
});

