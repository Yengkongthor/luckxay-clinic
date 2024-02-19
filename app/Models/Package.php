<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
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
        return url('/admin/packages/'.$this->getKey());
    }

    public function packageDetails()
    {
        return $this->belongsToMany('App\Models\LabDetail', 'package_details', 'package_id', 'lab_detail_id')->withTimestamps()->withPivot('lab_id');;
    }
}
