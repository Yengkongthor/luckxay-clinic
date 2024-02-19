<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class PrescribeMedicine extends Model
{
    protected $fillable = [
        'patient_history_id',
        'price_total',
        'date',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url','list_medicine'];
    protected $with = ['prescribeMedicineDetail', 'prescribeMedicineCharge', 'patientHistory'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/prescribe-medicines/' . $this->getKey());
    }

    public function getListMedicineAttribute()
    {
        $data = [];
        foreach ($this->prescribeMedicineDetail->where('status','medicine') as $key => $value) {
            $data[]=$value;
        }
        return $data;
    }


    /* ************************ RELATION ************************* */


    public function prescribeMedicineDetail()
    {
        return $this->hasMany('App\Models\PrescribeMedicineDetail');
    }

    public function prescribeMedicineCharge()
    {
        return $this->hasOne('App\Models\PrescribeMedicineCharge')->withDefault();
    }

    public function patientHistory()
    {
        return $this->belongsTo('App\Models\PatientHistory');
    }
}
