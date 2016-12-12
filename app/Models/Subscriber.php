<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    public $timestamps = false;
    
    protected $table = 'subscribers';
    
    protected $fillable = ['email','isSubscribing','subscription_date'];
    
    protected $primaryKey = "subscriber_id";
}
