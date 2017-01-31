<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    
    protected $table = 'product';
    
    protected $fillable = ['product_code','product_type_id','brand_id','photo','photo_2','photo_3','photo_4','name',
                           'slug','description','price','stocks','tags','created_by','created_date','modified_by','modified_date',
                           'active','deleted'];
    
    protected $primaryKey = "product_id";
    
    public function producttype()
    {
        return $this->belongsTo('App\Models\ProductType','product_type_id','product_type_id');
    }
    
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand','brand_id','brand_id');
    }
    
    public function property()
    {
        return $this->hasMany('App\Models\ProductProperty','product_id','product_id');
    }
}
