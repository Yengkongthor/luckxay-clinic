<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabDetail extends Model
{
    protected $fillable = [
        'lab_id',
        'name',
        'unit',
        'reference',
        'cost',
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
        return url('/admin/lab-details/' . $this->getKey());
    }

    /* ************************ Relation ************************* */

    public function lab()
    {
        return $this->belongsTo('App\Models\Lab');
    }
}
