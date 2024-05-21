<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    //


    function ListBrand(Request $req){
        $data=[];
        $brandList=Brand::all();
        $data['brandList']=$brandList;
        return view('admin.brand.list',$data);
    }

    function addBrand(Request $req){
        $data=[];
        if($req->isMethod('post')){
            $post_data=$req->all();
            $rules=[
                "name"=>"required:min:3",
                "slug"=>"required:min:3",
                "status"=>"required:min:3",
                "meta_title"=>"required:min:3",
            ];
            $validator=Validator::make($post_data,$rules);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
            $slug =Str::slug($req->slug);
            
            $originalSlug = $slug;
            $counter = 1;
            while (Brand::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $brand=new Brand();
            $brand->name=$req->name;
            $brand->slug=$slug;
            $brand->status=$req->status==1?1:0;
            $brand->meta_title=$req->meta_title;
            $brand->meta_description=$req->meta_description;
            $brand->meta_keywords=$req->meta_keywords;
            $brand->created_by=Auth::user()->id;
            $brand->deleted_at=null;
            $brand->save();      
            if($brand){
                return redirect()->route('ListBrand')->with([
                    'success'=>'Brand added successfully'
                ]);
            }else{
                return redirect()->back()->with([
                    'error'=>'Something went wrong.Try Later...'
                ])->withInput();
            }     
        }
        return view('admin.brand.add',$data);
    }

    function editBrand(Request $req,$id){
        $data=[];
        $brand=Brand::find($id);
        $data['brand']=$brand;
        if($req->isMethod('post')){
            $post_data=$req->all();
            $rules=[
                "name"=>"required:min:3",
                "slug"=>"required:min:3",
                "status"=>"required:min:3",
                "meta_title"=>"required:min:3",
            ];
            $validator=Validator::make($post_data,$rules);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
            $slug =Str::slug($req->slug);
            
            $originalSlug = $slug;
            $counter = 1;
            while (Brand::where('slug', $slug)->where('id','<>',$id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            $brand->name=$req->name;
            $brand->slug=$slug;
            $brand->status=$req->status==1?1:0;
            $brand->meta_title=$req->meta_title;
            $brand->meta_description=$req->meta_description;
            $brand->meta_keywords=$req->meta_keywords;
            $brand->created_by=Auth::user()->id;
            $brand->deleted_at=null;
            $brand->save();      
            if($brand){
                return redirect()->route('ListBrand')->with([
                    'success'=>'Brand updated successfully'
                ]);
            }else{
                return redirect()->back()->with([
                    'error'=>'Something went wrong.Try Later...'
                ])->withInput();
            }     
        }
        return view('admin.brand.edit',$data);
    }

    function deleteBrand(Request $req,$id){
        if($req->isMethod('get')){
            $id=$req->id;
            $brand=Brand::find($id);
            if($brand){
                $brand->delete();
                return redirect()->route('ListBrand')->with([
                    'success'=>'Brand deleted successfully.'
                    ,
                ]);
            }else{
                return redirect()->route('ListBrand')->with([
                    'error'=>'Brand not found',
                ]);
            }
        }else{
            return redirect()->route('ListBrand')->with([
                'error'=>'Brand not found',
            ]);
        }
    }
    function statusBrand(Request $req){
        if($req->isMethod('get')){
            $id=$req->id;
            $brand=Brand::find($id);
            if($brand){
                $brand->status=$brand->status==1?0:1;
                $brand->save();
                return redirect()->route('ListBrand')->with([
                    'success'=>'Brand status updated successfully.',
                ]);
            }else{
                return redirect()->route('ListBrand')->with([
                    'error'=>'Brand not found',
                ]);
            }
        }else{
            return redirect()->route('ListBrand')->with([
                'error'=>'Brand not found',
            ]);
        }
    }
}
