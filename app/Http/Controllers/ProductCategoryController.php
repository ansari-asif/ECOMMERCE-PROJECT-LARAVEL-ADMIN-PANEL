<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{
    
    function ListCategory(Request $req){
        $data=[];
        $categoryList=ProductCategory::all();
        $data['categoryList']=$categoryList;
        return view('admin.ProductCategory.listCategory',$data);
    }

    function addCategory(Request $req){
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
             // Generate unique slug if it already exists
            $slug =Str::slug($req->slug);
            $originalSlug = $slug;
            $counter = 1;
            while (ProductCategory::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $category=new ProductCategory();
            $category->name=$req->name;
            $category->slug=$slug;
            $category->status=$req->status==1?1:0;
            $category->meta_title=$req->meta_title;
            $category->meta_description=$req->meta_description;
            $category->meta_keywords=$req->meta_keywords;
            $category->created_by=Auth::user()->id;
            $category->deleted_at=null;
            $category->save();      
            if($category){
                return redirect()->route('ListCategory')->with([
                    'success'=>'Category added successfully'
                ]);
            }else{
                return redirect()->back()->with([
                    'error'=>'Something went wrong.Try Later...'
                ])->withInput();
            }     
        }
        return view('admin.ProductCategory.addCategory');
    }

    function editCategory(Request $req,$id){
        $category=ProductCategory::find($id);

        if($category){
            $data['category']=$category;
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
                 // Generate unique slug if it already exists
                $slug =Str::slug($req->slug);
                $originalSlug = $slug;
                $counter = 1;
                while (ProductCategory::where('slug', $slug)->where('id','<>',$id)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
                
                $category->name=$req->name;
                $category->slug=$slug;
                $category->status=$req->status==1?1:0;
                $category->meta_title=$req->meta_title;
                $category->meta_description=$req->meta_description;
                $category->meta_keywords=$req->meta_keywords;
                $category->save();      
                if($category){
                    return redirect()->route('ListCategory')->with([
                        'success'=>'Category updated successfully'
                    ]);
                }else{
                    return redirect()->back()->with([
                        'error'=>'Something went wrong.Try Later...'
                    ])->withInput();
                }     
            }
            return view('admin.ProductCategory.editCategory',$data);
        }else{
            return redirect()->route('ListCategory')->with([
                'error'=>'Category Not found.'
            ]);
        }
    }

    function deleteCategory(Request $req,$id){
        if($req->isMethod('get')){
            $id=$req->id;
            $ProductCategory=ProductCategory::find($id);
            if($ProductCategory){
                $ProductCategory->delete();
                return redirect()->route('ListCategory')->with([
                    'success'=>'Product Category deleted successfully.'
                    ,
                ]);
            }else{
                return redirect()->route('ListCategory')->with([
                    'error'=>'Product Category not found',
                ]);
            }
        }else{
            return redirect()->route('ListCategory')->with([
                'error'=>'Product Category not found',
            ]);
        }
    }
    function statusCategory(Request $req){
        if($req->isMethod('get')){
            $id=$req->id;
            $ProductCategory=ProductCategory::find($id);
            if($ProductCategory){
                $ProductCategory->status=$ProductCategory->status==1?0:1;
                $ProductCategory->save();
                return redirect()->route('ListCategory')->with([
                    'success'=>'Product Category status updated successfully.',
                ]);
            }else{
                return redirect()->route('ListCategory')->with([
                    'error'=>'Product Category not found',
                ]);
            }
        }else{
            return redirect()->route('ListCategory')->with([
                'error'=>'Product Category not found',
            ]);
        }
    }
}
