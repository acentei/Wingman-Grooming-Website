<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingDetails extends Model
{
    public $timestamps = false;
    
    protected $table = 'shipping';
    
    protected $fillable = ['manila_cost','outmanila_cost','ship_nocost','express_shipping'];
    
    protected $primaryKey = "shipdet_id";
}
