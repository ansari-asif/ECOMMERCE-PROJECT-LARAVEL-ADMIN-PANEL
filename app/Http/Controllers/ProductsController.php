<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\ProductCategory;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    function productList(Request $req){
        $data=[];
        $productList=Products::all();
        $data['productList']=$productList;
        return view('admin.products.list',$data);
    }

    function addProduct(Request $req){
        $data=[];
        $categories=ProductCategory::all();
        $brands=Brand::all();
        $data['categories']=$categories;
        $data['brands']=$brands;
        return view('admin.products.add',$data);
    }

    function editProduct(Request $req, $id){

    }

    function deleteProduct(Request $req, $id){

    }

    function statusProduct(Request $req, $id){
        
    }

    function ajax_get_sub_category(Request $req){
        $options="<option>---Select Sub Category---</option>";
        if($req->isMethod('post') && $req->id){
            $id=$req->id;
            $category=ProductCategory::find($id);
            foreach ($category->subcategories as $key => $sub_cat) {
                $options.="<option value=".$sub_cat->id.">".$sub_cat->name."</option>";
            }
        }
        return response()->json($options);
    }

}
