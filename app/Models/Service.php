<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'price',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];


    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/services/' . $this->getKey());
    }

    /* ************************ RELATION ************************* */

    public function labDetailService()
    {
        return $this->belongsToMany('App\Models\LabDetail', 'lab_detail_service', 'service_id', 'lab_detail_id')->withTimestamps()->withPivot('lab_id');
    }
}
