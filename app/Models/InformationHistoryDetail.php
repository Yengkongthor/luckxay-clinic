<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformationHistoryDetail extends Model
{
    protected $fillable = [
        'patient_history_id',
        'key',
        'value',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/information-history-details/'.$this->getKey());
    }
}
