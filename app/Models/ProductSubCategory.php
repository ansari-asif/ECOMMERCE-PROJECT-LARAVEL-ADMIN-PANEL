<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;

    protected $table="product_sub_category";
    
    protected $fillable=[
        'name',
        'slug',
        'status',
        'product_category',
        'is_deleted',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    function status_sub_category(){
        return $this->status==1?"Active":"Deactivated";
    }

    function category(){
        return $this->belongsTo(ProductCategory::class,'product_category');
    }
    
}
