<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    public $timestamps = false;
    
    protected $table = 'promo_codes';
    
    protected $fillable = ['code','description','discount_type','discount_value','start_date','expiration_date',
                           'is_one_time_use','is_subscriber_only','created_by','created_date','modified_by','modified_date',
                           'active','deleted'];
    
    protected $primaryKey = "promo_id";
}
