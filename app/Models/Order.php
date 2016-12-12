<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    
    protected $table = 'orders';
    
    protected $fillable = ['order_code','order_status','customer_full_name','customer_email','customer_address','customer_postal',
                           'customer_phone','created_by','created_date','modified_by','modified_date','active','deleted'];
    
    protected $primaryKey = "order_id";

    public function details()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id', 'order_id');
    }

    public function infos()
    {
        return $this->hasMany('App\Models\OrderInfo', 'order_id', 'order_id');
    }
}
