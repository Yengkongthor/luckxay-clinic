<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationReception extends Model
{
    protected $fillable = [
        'caller',
        'class',
        'patient',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/notification-receptions/'.$this->getKey());
    }
}
