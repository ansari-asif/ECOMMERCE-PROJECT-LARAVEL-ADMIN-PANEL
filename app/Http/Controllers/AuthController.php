<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    function register(Request $req){
        
        if($req->isMethod('post')){
            $validationData=$req->validate([
                'name'=>'required|string|min:3',
                'name'=>'required|string|min:3',
                'name'=>'required|string|min:3',
                'name'=>'required|string|min:3',
            ],$req->all());
        }else{
            return view('admin.auth.register');
        }
    }

    function login(){
        return view('admin.auth.login');    
    }
}
