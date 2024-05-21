<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="brand";

    protected $fillable=[
        'name',
        'slug',
        'status',
        'is_deleted',
        'deleted_at',
        'created_bys',
    ];

    function status_brand(){
        return $this->status?"Active":"Deactive";
    }


}
