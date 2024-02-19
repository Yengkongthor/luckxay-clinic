<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabDetailService extends Model
{
    protected $table = 'lab_detail_service';

    protected $fillable = [
        'service_id',
        'lab_detail_id',
        'lab_id',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/lab-detail-services/'.$this->getKey());
    }
}
