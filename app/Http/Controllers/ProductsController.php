<?php

namespace App\Http\Controllers;

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
        return view('admin.products.add',$data);
    }

    function editProduct(Request $req, $id){

    }

    function deleteProduct(Request $req, $id){

    }

    function statusProduct(Request $req, $id){
        
    }

}
