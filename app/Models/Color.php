<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'name',
        'code',
        'status',
        'created_by',
    ];

    function status_color(){
        return $this->status?"Active":"Deactive";
    }

}
