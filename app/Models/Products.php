<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table="products";

    protected $fillable=[
        'title',
        'slug',
        'sku',
        'category',
        'sub_category',
        'brand',
        'short_desc',
        'description',
        'additional_info',
        'shipping_returns',
        'status',
    ];

    function product_status(){
        return $this->status==1?'Active':'Deactivated';
    }

    function product_category(){
        return $this->belongsTo(ProductCategory::class,'category');
    }

    function product_sub_category(){
        return $this->belongsTo(ProductSubCategory::class,'sub_category');
    }
}
