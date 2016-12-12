<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
    public $timestamps = false;
    
    protected $table = 'order_infos';
    
    protected $fillable = ['order_id','Name','Value','created_by','created_date','modified_by','modified_date','active','deleted'];
    
    protected $primaryKey = "info_id";

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id', 'order_id');
    }
}
