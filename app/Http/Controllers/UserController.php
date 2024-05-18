<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    function manage_users(){
        $data=[];
        
        $users=User::where('id','<>',Auth::user()->id)->orderBY('id','desc')->get();
        $data['users']=$users;
        return view('admin.users.users',$data);
    }

    function add_user(Request $req){
        if($req->isMethod('post')){
            $post_data=$req->all();
            $validator=Validator::make($post_data,[
                'name'=>'required|min:3',
                'email'=>'required|email',
                'phone'=>'required|min:10',
                'user_type'=>'required|min:3',
                'password'=>'required|string|min:3|confirmed|',
            ]);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $user=User::where('email',$req->email)
                        ->orWhere('phone',$req->phone)->first();
            if($user){
                return redirect()->back()->with([
                    "error"=>"email or phone already exists",
                ])->withInput();
            }else{
                $post_data=[
                    'name'=>$req->name,
                    'email'=>$req->email,
                    'phone'=>$req->phone,
                    "user_type"=>"normal",
                    "status"=>1,
                    'password'=>Hash::make($req->password),
                ];
                $user=User::create($post_data);
                return redirect()->route('users')->with(['success'=>"User created successfully"]);
            }
        }else{
            return view('admin.users.add_user');
        }

    }
    function edit_user(Request $req,$id){
        $data=[];
        $user=User::find($id);
        $data['user']=$user;
        if($user){
            if($req->isMethod('post')){
                $post_data=$req->all();
                $rules=[
                    'name'=>'required|min:3',
                    'email'=>'required|email',
                    'phone'=>'required|min:10',
                    'user_type'=>'required|min:3',
                ];
                if(!empty($post_data['password'])){
                    $rules['password']='required|string|min:3|confirmed|';
                }
                $validator=Validator::make($post_data,$rules);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                
                $exist_user=User::where(function($query) use ($req){
                                $query->where('email',$req->email)
                                ->orWhere('phone',$req->phone);
                            })
                            ->where('id','<>',$id)
                            ->first();
                // $query = DB::getQueryLog();
                // dd($query);
                if($exist_user){
                    return redirect()->back()->with([
                        'error'=>"Email or Phone already exists",
                    ])->withInput();
                }else{
                    $user->name=$req->name;
                    $user->email=$req->email;
                    $user->phone=$req->phone;
                    $user->user_type=$req->user_type;
                    if(!empty($post_data['password'])){
                        $user->password=Hash::make($req->password);
                    }
                    $user->save();
                    return redirect()->route('users')->with([
                        'success'=>'User updated successfully.',
                    ]);
                }
            }
            return view('admin.users.edit_user',$data);
        }else{
            return redirect()->route('users')->with([
                'error'=>'User not found',
            ]);
        }
    }

    function delete_user(Request $req){
        if($req->isMethod('get')){
            $id=$req->id;
            $user=User::find($id);
            if($user){
                $user->delete();
                return redirect()->route('users')->with([
                    'success'=>'User deleted successfully.'
                    ,
                ]);
            }else{
                return redirect()->route('users')->with([
                    'error'=>'User not found',
                ]);
            }
        }else{
            return redirect()->route('users')->with([
                'error'=>'User not found',
            ]);
        }
    }
    function status_user(Request $req){
        if($req->isMethod('get')){
            $id=$req->id;
            $user=User::find($id);
            if($user){
                $user->status=!$user->status;
                $user->save();
                return redirect()->route('users')->with([
                    'success'=>'User status updated successfully.'
                    ,
                ]);
            }else{
                return redirect()->route('users')->with([
                    'error'=>'User not found',
                ]);
            }
        }else{
            return redirect()->route('users')->with([
                'error'=>'User not found',
            ]);
        }
    }
}

