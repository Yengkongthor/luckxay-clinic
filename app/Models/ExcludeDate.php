<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExcludeDate extends Model
{
    protected $fillable = [
        'date',
    
    ];
    
    
    protected $dates = [
        'created_at',
        // 'date',
        'updated_at',
    
    ];
    
    protected $casts = [
        'date' => 'datetime:Y-m-d 00:00:00'
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/exclude-dates/'.$this->getKey());
    }
}
