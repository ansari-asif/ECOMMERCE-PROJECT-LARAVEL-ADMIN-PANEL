<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductSubCategoryController extends Controller
{
    

    
    function ListSubCategory(Request $req){
        $data=[];
        $categoryList=ProductSubCategory::all();
        $data['categoryList']=$categoryList;
        return view('admin.ProductSubCategory.listSubCategory',$data);
    }

    function addSubCategory(Request $req){
        $data=[];
        $categoryList=ProductCategory::all();
        $data['categoryList']=$categoryList;
        if($req->isMethod('post')){
            $post_data=$req->all();
            $rules=[
                "name"=>"required:min:3",
                "slug"=>"required:min:3",
                "status"=>"required:min:3",
                "product_category"=>"required:min:3",
                "meta_title"=>"required:min:3",
            ];
            $validator=Validator::make($post_data,$rules);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
            $slug =Str::slug($req->slug);
            
            $originalSlug = $slug;
            $counter = 1;
            while (ProductSubCategory::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $subcategory=new ProductSubCategory();
            $subcategory->name=$req->name;
            $subcategory->slug=$slug;
            $subcategory->status=$req->status==1?1:0;
            $subcategory->product_category=$req->product_category;
            $subcategory->meta_title=$req->meta_title;
            $subcategory->meta_description=$req->meta_description;
            $subcategory->meta_keywords=$req->meta_keywords;
            $subcategory->created_by=Auth::user()->id;
            $subcategory->deleted_at=null;
            $subcategory->save();      
            if($subcategory){
                return redirect()->route('ListSubCategory')->with([
                    'success'=>'Sub Category added successfully'
                ]);
            }else{
                return redirect()->back()->with([
                    'error'=>'Something went wrong.Try Later...'
                ])->withInput();
            }     
        }
        return view('admin.ProductSubCategory.addSubCategory',$data);
    }

    function editSubCategory(Request $req,$id){
        $sub_category=ProductSubCategory::find($id);
        // dd($sub_category);
        $categoryList=ProductCategory::all();
        $data['categoryList']=$categoryList;
        if($sub_category){
            $data['sub_category']=$sub_category;
            if($req->isMethod('post')){
                $post_data=$req->all();
                
                $rules=[
                    "name"=>"required:min:3",
                    "slug"=>"required:min:3",
                    "status"=>"required:min:3",
                    "product_category"=>"required:min:3",
                    "meta_title"=>"required:min:3",
                ];
                $validator=Validator::make($post_data,$rules);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                 // Generate unique slug if it already exists
                $slug =Str::slug($req->slug);
                $originalSlug = $slug;
                $counter = 1;
                while (ProductSubCategory::where('slug', $slug)->where('id','<>',$id)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
                
                $sub_category->name=$req->name;
                $sub_category->slug=$slug;
                $sub_category->status=$req->status==1?1:0;
                $sub_category->product_category=$req->product_category;
                $sub_category->meta_title=$req->meta_title;
                $sub_category->meta_description=$req->meta_description;
                $sub_category->meta_keywords=$req->meta_keywords;
                $sub_category->save();      
                if($sub_category){
                    return redirect()->route('ListSubCategory')->with([
                        'success'=>'Sub Category updated successfully'
                    ]);
                }else{
                    return redirect()->back()->with([
                        'error'=>'Something went wrong.Try Later...'
                    ])->withInput();
                }     
            }
            return view('admin.ProductSubCategory.editSubCategory',$data);
        }else{
            return redirect()->route('ListSubCategory')->with([
                'error'=>'Sub Category Not found.'
            ]);
        }
    }

    function deleteSubCategory(Request $req,$id){
        if($req->isMethod('get')){
            $id=$req->id;
            $ProductSubCategory=ProductSubCategory::find($id);
            if($ProductSubCategory){
                $ProductSubCategory->delete();
                return redirect()->route('ListSubCategory')->with([
                    'success'=>'Product Sub Category deleted successfully.',
                ]);
            }else{
                return redirect()->route('ListSubCategory')->with([
                    'error'=>'Product Sub Category not found',
                ]);
            }
        }else{
            return redirect()->route('ListSubCategory')->with([
                'error'=>'Product Sub Category not found',
            ]);
        }
    }

    function statusSubCategory(Request $req){
        if($req->isMethod('get')){
            $id=$req->id;
            $ProductSubCategory=ProductSubCategory::find($id);
            if($ProductSubCategory){
                $ProductSubCategory->status=$ProductSubCategory->status==1?0:1;
                $ProductSubCategory->save();
                return redirect()->route('ListSubCategory')->with([
                    'success'=>'Product Sub Category status updated successfully.',
                ]);
            }else{
                return redirect()->route('ListSubCategory')->with([
                    'error'=>'Product Sub Category not found',
                ]);
            }
        }else{
            return redirect()->route('ListSubCategory')->with([
                'error'=>'Product Sub Category not found',
            ]);
        }
    }
   
    

}
