<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasicPhysicalExamination extends Model
{
    protected $fillable = [
        'patient_id',
        'pressure',
        'weight',
        'temperature',
        'ta',
        'spo2',
        'pr',
        'bp',
        'rr'

    ];


    protected $dates = [
        // 'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/basic-physical-examinations/' . $this->getKey());
    }

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }
}
