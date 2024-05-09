<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function register(Request $req){
        if($req->isMethod('post')){
            $validator=Validator::make($req->all(),[
                'name'=>'required|string|min:3',
                'email'=>'required|email|',
                'phone'=>'required|string|min:10',
                'password'=>'required|string|min:3|confirmed',
            ]);
            if($validator->fails()){
                $errors=$validator->errors();
                return back()->withErrors($validator)->withInput();
            }   
            $user=User::where('email',$req->email)
                        ->orWhere('phone',$req->phone)
                        ->first();
            if(!$user){
                $post_data=[
                    'name'=>$req->name,
                    'email'=>$req->email,
                    'phone'=>$req->phone,
                    "user_type"=>"normal",
                    "status"=>1,
                    'password'=>Hash::make($req->password),
                ];
                $user=User::create($post_data);
                Auth::login($user);
                return redirect('/admin');
            }else{
                return redirect()->back()->with([
                    "error"=>"Email or phone already exist."
                ])->withInput();
            }  
        }else{
            return view('admin.auth.register');
        }
    }

    function login(Request $req){
        if($req->isMethod('POST')){
            $validator=Validator::make($req->all(),[
                "email"=>"required|email",
                "password"=>"required",
            ]);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $user=Auth::attempt(['email'=>$req->email,'password'=>$req->password],$req->remember);
            if($user){
                return redirect('/admin');
            }else{
                return redirect()->back()->with(['error'=>"Invalid Email or Password"])->withInput();
            }
        }else{
            return view('admin.auth.login');    
        }
    }

    
}
