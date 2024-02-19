<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $fillable = [
        'name',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/labs/' . $this->getKey());
    }

    /* ************************ RELATION ************************* */

    public function labDetails()
    {
        return $this->hasMany('App\Models\LabDetail');
    }
}
