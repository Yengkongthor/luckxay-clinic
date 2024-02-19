<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamPackage extends Model
{
    protected $fillable = [
        'package_id',
        'employee_id',
        'status'

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url','patientHistory'];
    protected $with = ['package', 'employee'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/exam-packages/' . $this->getKey());
    }

    public function getPatientHistoryAttribute()
    {
        $patientHistory = PatientHistory::wherePatientHistoryableType('App\Models\ExamPackage')->wherePatientHistoryableId($this->id)->first();
        return $patientHistory;
    }


    /* ************************ RELATION ************************* */


    public function package()
    {
        return $this->belongsTo('App\Models\Package');
    }

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }

    public function comments()
    {
        return $this->morphOne('App\Models\Comment', 'commentable');
    }

}
