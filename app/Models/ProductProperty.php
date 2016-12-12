<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductProperty extends Model
{
    public $timestamps = false;
    
    protected $table = 'product_property';
    
    protected $fillable = ['product_id','name','value','created_by','created_date','modified_by','modified_date','active','deleted'];
    
    protected $primaryKey = "property_id";
}
