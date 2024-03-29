<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientStatistic extends Model
{
    protected $fillable = [
    
    ];
    
    
    protected $dates = [
    
    ];
    public $timestamps = false;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/patient-statistics/'.$this->getKey());
    }
}
