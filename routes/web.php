<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductSubCategoryController;
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

        // product Sub Category
        Route::get('/product-sub-category',[ProductSubCategoryController::class,'ListSubCategory'])->name('ListSubCategory');
        Route::match(['get','post'],'/product-sub-category/add-sub-category',[ProductSubCategoryController::class,'addSubCategory'])->name('addSubCategory');
        Route::match(['get','post'],'/product-sub-category/edit-sub-category/{id}',[ProductSubCategoryController::class,'editSubCategory'])->name('editSubCategory');
        Route::match(['get'],'/product-sub-category/delete-sub-category/{id}',[ProductSubCategoryController::class,'deleteSubCategory'])->name('deleteSubCategory');
        Route::match(['get'],'/product-sub-category/status-sub-category/{id}',[ProductSubCategoryController::class,'statusSubCategory'])->name('statusSubCategory');

        // Brand
        Route::get('/brand',[BrandController::class,'ListBrand'])->name('ListBrand');
        Route::match(['get','post'],'/brand/add-brand',[BrandController::class,'addBrand'])->name('addBrand');
        Route::match(['get','post'],'/brand/edit-brand/{id}',[BrandController::class,'editBrand'])->name('editBrand');
        Route::match(['get'],'/brand/delete-brand/{id}',[BrandController::class,'deleteBrand'])->name('deleteBrand');
        Route::match(['get'],'/brand/status-brand/{id}',[BrandController::class,'statusBrand'])->name('statusBrand');

        // Brand
        Route::get('/color',[ColorController::class,'ListColor'])->name('ListColor');
        Route::match(['get','post'],'/color/add-color',[ColorController::class,'addColor'])->name('addColor');
        Route::match(['get','post'],'/color/edit-color/{id}',[ColorController::class,'editColor'])->name('editColor');
        Route::match(['get'],'/color/delete-color/{id}',[ColorController::class,'deleteColor'])->name('deleteColor');
        Route::match(['get'],'/color/status-color/{id}',[ColorController::class,'statusColor'])->name('statusColor');

        // Product
        Route::get('/products',[ProductsController::class,'productList'])->name('productList');
        Route::match(['get','post'],'/products/add-product',[ProductsController::class,'addProduct'])->name('addProduct');
        Route::match(['get','post'],'/products/add-product/{id}',[ProductsController::class,'editProduct'])->name('editProduct');
        // Route::match(['get'],'/color/delete-color/{id}',[ColorController::class,'deleteColor'])->name('deleteColor');
        // Route::match(['get'],'/color/status-color/{id}',[ColorController::class,'statusColor'])->name('statusColor');
        Route::post('/products/sub-product',[ProductsController::class,'ajax_get_sub_category'])->name('ajax_get_sub_category');
    });
});

