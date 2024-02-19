<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
        'en_name',
        'la_name',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url', 'count_district'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/provinces/' . $this->getKey());
    }

    public function getCountDistrictAttribute()
    {
        return  $this->districts->count();
    }

    public function districts()
    {
        return $this->hasMany('App\Models\District');
    }
}
