<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientHistory extends Model
{
    protected $fillable = [
        'patient_id',
        'patient_historyable_id',
        'patient_historyable_type',
        'test_at',
        'doctor_fee',
        'doctor_fee_discount',
    ];


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'resource_url',
        'examination_lab',
        'infor_History_key_value',
        'examination_services_edit',
        'history_medicine',
        'queue_comment',
    ];

    protected $with = [
        'patient',
        'examinationServicesResult',
        'informationHistoryDetail',
        'doctorMedicines',
    ];


    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/patient-histories/' . $this->getKey());
    }

    public function getExaminationLabAttribute()
    {
        $response = [];
        foreach ($this->examinationServices as $key => $value) {
            $labDetail = LabDetail::find($value->pivot->lab_detail_id);
            if (!$labDetail) continue;
            $response[] = [
                'lab_detail_name' => $labDetail->name,
                'lab_detail_unit' => $labDetail->unit,
                'lab_detail_reference' => $labDetail->reference,
                'lab_detail_cost' => $labDetail->cost,
                'lab_detail_price' => $labDetail->price,
                'value' => $value->pivot->value,
            ];
        }

        return $response;
    }

    public function getExaminationServicesEditAttribute()
    {
        $examinationServicesEdit =  $this->examinationServicesResult->map(function ($value) {
            return [
                'lab_detail_id' => $value->lab_detail_id,
                'service_id' => $value->service_id,
                'lab_id' => $value->lab_id,
            ];
        });

        return $examinationServicesEdit;
    }

    public function getInforHistoryKeyValueAttribute()
    {
        $info = [];
        $this->informationHistoryDetail->each(function ($value) use (&$info) {
            $info[$value->key] = $value->value;
        });

        return $info;
    }

    public function getHistoryMedicineAttribute()
    {
        $prescribeMedicine = PrescribeMedicine::wherePatientHistoryId($this->id)->first();

        return $prescribeMedicine ?  $prescribeMedicine->prescribeMedicineDetail->where('status', 'medicine') : [];
    }

    public function getQueueCommentAttribute()
    {
        $queue = Queue::find($this->patient_historyable_id);

        return $queue ? ($queue->comments ? $queue->comments->body : '') : '';
    }

    /* ************************ RELATION ************************* */


    public function patient()
    {
        return $this->belongsTo('App\Models\Patient')->withDefault();
    }

    public function examinationServices()
    {
        return $this->belongsToMany('App\Models\Service', 'examination_services', 'patient_history_id', 'service_id')->withTimestamps()->withPivot(['value', 'lab_detail_id', 'service_id', 'lab_id']);
    }

    public function examinationServicesResult()
    {
        return $this->hasMany('App\Models\ExaminationService');
    }

    public function informationHistoryDetail()
    {
        return $this->hasMany('App\Models\InformationHistoryDetail');
    }

    public function doctorMedicines()
    {
        return $this->hasMany('App\Models\DoctorMedicine');
    }

    public function patientHistoryable()
    {
        return $this->morphTo();
    }
}
