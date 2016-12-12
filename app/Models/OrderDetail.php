<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $timestamps = false;
    
    protected $table = 'order_details';
    
    protected $fillable = ['order_id','product_id','quantity','total','created_by','created_date','modified_by','modified_date','active','deleted'];
    
    protected $primaryKey = "order_details_id";

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id', 'order_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'product_id');
    }
}
