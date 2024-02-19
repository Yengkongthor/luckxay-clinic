<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabXrayEcho extends Model
{
    protected $table = 'labXrayEcho';

    protected $fillable = [
    
    ];
    
    
    protected $dates = [
    
    ];
    public $timestamps = false;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/lab-xray-echos/'.$this->getKey());
    }
}
