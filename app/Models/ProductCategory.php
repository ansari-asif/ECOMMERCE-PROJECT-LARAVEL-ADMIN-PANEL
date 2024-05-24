<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    
    protected $table="product_category";
    
    protected $fillable=[
        'name',
        'slug',
        'status',
        'is_deleted',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];


    function status_category(){
        return $this->status==1?"Active":"Deactivated";
    }

    public function subcategories(){
        return $this->hasMany(ProductSubCategory::class, 'product_category');
    }
}
