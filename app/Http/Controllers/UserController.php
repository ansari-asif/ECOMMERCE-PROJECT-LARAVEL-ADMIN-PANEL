<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    function manage_users(){
        return view('admin.users.users');
    }
    function add_user(Request $req){

    }
    function edit_user(Request $req){

    }
    function active_deactive_users(){

    }


}
