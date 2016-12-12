<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    public $timestamps = false;
    
    protected $table = 'home_carousel';
    
    protected $fillable = ['img','title','description','button_label','link','created_by','created_date',
                           'modified_by','modified_date','active','deleted'];
    
    protected $primaryKey = "carousel_id";
}
