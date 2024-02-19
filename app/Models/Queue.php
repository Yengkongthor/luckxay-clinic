<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $fillable = [
        'patient_id',
        'employee_id',
        'queues_status',
        'queue_number',
        'comment',
        'important',
        'date'

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url', 'patient_history_last', 'prescribe_medicines', 'medicine_patient','no_number_queue_assign'];

    protected $with = ['patient', 'employee'];


    /* ************************ ACCESSOR ************************* */

    public function getNoNumberQueueAssignAttribute()
    {
        $queue_number =  Queue::where('date', now()->format('Y-m-d'))->where('queues_status','processing')->count();

        return $queue_number + 1;
    }

    public function getResourceUrlAttribute()
    {
        return url('/admin/queues/' . $this->getKey());
    }

    public function getPatientHistoryLastAttribute()
    {
        return $this->patientHistory;
    }

    public function getPrescribeMedicinesAttribute()
    {
        $prescribe_medicines = PrescribeMedicine::wherePatientHistoryId($this->patient_history_last ? $this->patient_history_last->id : null)->first();

        return $prescribe_medicines;
    }

    public function getMedicinePatientAttribute()
    {
        $prescribe_medicines = PrescribeMedicine::wherePatientHistoryId($this->patient_history_last ? $this->patient_history_last->id : null)->first();
        $prescribe_medicines_detail =  PrescribeMedicineDetail::wherePrescribeMedicineId($prescribe_medicines ? $prescribe_medicines->id : null)->where('status', 'medicine')->get();

        return $prescribe_medicines_detail;
    }

    /* ************************ Relation ************************* */

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient')->withDefault();
    }

    public function queuePatientHistory()
    {
        return $this->hasMany('App\Models\PatientHistory', 'patient_id', 'patient_id');
    }

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }

    public function comments()
    {
        return $this->morphOne('App\Models\Comment', 'commentable');
    }

    public function patientHistory()
    {
        return $this->morphOne('App\Models\PatientHistory', 'patient_historyable');
    }
}
