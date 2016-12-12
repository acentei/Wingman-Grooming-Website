<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    public $timestamps = false;
    
    protected $table = 'product_type';
    
    protected $fillable = ['display_name','created_by','created_date','modified_by','modified_date','active','deleted'];
    
    protected $primaryKey = "product_type_id";
}
