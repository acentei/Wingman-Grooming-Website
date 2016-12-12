<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    public $timestamps = false;
    
    protected $table = 'newsletter';
    
    protected $fillable = ['author_id','newsletter_type_id','image','title','slug','body',
                           'created_by','created_date','modified_by','modified_date','active','deleted'];
    
    protected $primaryKey = "newsletter_id";

    public function category()
    {
        return $this->belongsTo('App\Models\NewsletterType','newsletter_type_id','newsletter_type_id');
    }
}
