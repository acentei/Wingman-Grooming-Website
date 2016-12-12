<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterType extends Model
{
    public $timestamps = false;
    
    protected $table = 'newsletter_type';
    
    protected $fillable = ['display_name','created_by','created_date','modified_by','modified_date','active','deleted'];
    
    protected $primaryKey = "newsletter_type_id";
}
