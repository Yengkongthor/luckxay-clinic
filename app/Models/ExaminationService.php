<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExaminationService extends Model
{
    protected $fillable = [
        'lab_detail_id',
        'lab_id',
        'patient_history_id',
        'service_id',
        'value',
        'input_status'

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url', 'service_name','lab_detail_price'];
    protected  $with = ['labDetail', 'lab', 'service'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/examination-services/' . $this->getKey());
    }

    public function getServiceNameAttribute()
    {
        return $this->service->name;
    }
    public function getLabDetailPriceAttribute()
    {
        return $this->labDetail->price;
    }


    public function lab()
    {
        return $this->belongsTo('App\Models\Lab')->withDefault();
    }

    public function labDetail()
    {
        return $this->belongsTo('App\Models\LabDetail')->withDefault();
    }
    public function service()
    {
        return $this->belongsTo('App\Models\Service')->withDefault();
    }

    public function patientHistory()
    {
        return $this->belongsTo('App\Models\PatientHistory')->withDefault();
    }
}
