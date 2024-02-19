<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorMedicine extends Model
{
    protected $fillable = [
        'amount',
        'cheminal_name',
        'patient_history_id',
        'times',
        'tablets',
        'medicine_id',
        'dose',
        'use',
        'type',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $casts = [
        'times' => 'array',
        'tablets' => 'array',
    ];

    protected $appends = ['resource_url'];
    protected $with = ['medicine'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/doctor-medicines/' . $this->getKey());
    }

    /* ************************ RELATION ************************* */

    public function doctorMedicineDetails()
    {
        return $this->belongsTo('App\Models\DoctorMedicineDetail');
    }

    public function medicine()
    {
        return $this->belongsTo('App\Models\Medicine');
    }
}
