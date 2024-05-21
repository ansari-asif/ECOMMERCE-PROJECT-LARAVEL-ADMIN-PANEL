<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    //

    function ListColor(Request $req){
        $data=[];
        $colorList=Color::all();
        $data['colorList']=$colorList;
        return view('admin.color.list',$data);
    }
    
    function addColor(Request $req){
        $data=[];
        if($req->isMethod('post')){
            $post_data=$req->all();
            $rules=[
                "name"=>"required:min:3",
                "code"=>"required:min:3",
                "status"=>"required:min:3",
            ];
            $validator=Validator::make($post_data,$rules);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
            $color=new Color();
            $color->name=$req->name;
            $color->code=$req->code;
            $color->status=$req->status==1?1:0;
            $color->created_by=Auth::user()->id;
            $color->save();      
            if($color){
                return redirect()->route('ListColor')->with([
                    'success'=>'Color added successfully'
                ]);
            }else{
                return redirect()->back()->with([
                    'error'=>'Something went wrong.Try Later...'
                ])->withInput();
            }     
        }
        return view('admin.color.add',$data);
    }

    function editColor(Request $req,$id){
        $data=[];
        $color=Color::find($id);
        $data['color']=$color;
        if($req->isMethod('post')){
            $post_data=$req->all();
            $rules=[
                "name"=>"required:min:3",
                "code"=>"required:min:3",
                "status"=>"required:min:3",
            ];
            $validator=Validator::make($post_data,$rules);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
            $color->name=$req->name;
            $color->code=$req->code;
            $color->status=$req->status==1?1:0;
            $color->created_by=Auth::user()->id;
            $color->deleted_at=null;
            $color->save();      
            if($color){
                return redirect()->route('ListColor')->with([
                    'success'=>'Color updated successfully'
                ]);
            }else{
                return redirect()->back()->with([
                    'error'=>'Something went wrong.Try Later...'
                ])->withInput();
            }     
        }
        return view('admin.color.edit',$data);
    }

    function deleteColor(Request $req,$id){
        if($req->isMethod('get')){
            $id=$req->id;
            $color=Color::find($id);
            if($color){
                $color->delete();
                return redirect()->route('ListColor')->with([
                    'success'=>'Color deleted successfully.'
                    ,
                ]);
            }else{
                return redirect()->route('ListColor')->with([
                    'error'=>'Color not found',
                ]);
            }
        }else{
            return redirect()->route('ListColor')->with([
                'error'=>'Color not found',
            ]);
        }
    }
    function statusColor(Request $req){
        if($req->isMethod('get')){
            $id=$req->id;
            $Color=Color::find($id);
            if($Color){
                $Color->status=$Color->status==1?0:1;
                $Color->save();
                return redirect()->route('ListColor')->with([
                    'success'=>'Color status updated successfully.',
                ]);
            }else{
                return redirect()->route('ListColor')->with([
                    'error'=>'Color not found',
                ]);
            }
        }else{
            return redirect()->route('ListColor')->with([
                'error'=>'Color not found',
            ]);
        }
    }

}
