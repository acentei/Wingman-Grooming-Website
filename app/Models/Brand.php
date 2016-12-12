<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false;
    
    protected $table = 'brand';
    
    protected $fillable = ['display_name','photo','slug','created_by','created_date',
                           'modified_by','modified_date','active','deleted'];
    
    protected $primaryKey = "brand_id";
}
