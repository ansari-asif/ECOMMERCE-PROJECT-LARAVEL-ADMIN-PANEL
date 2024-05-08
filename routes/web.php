<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/login',function (){
    return view('admin/auth.login');
});

Route::get('/admin/register',function (){
    return "admin register";
});

Route::get('/', function () {
    return view('welcome');
});
