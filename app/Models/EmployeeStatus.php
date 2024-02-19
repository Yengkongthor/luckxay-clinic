<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeStatus extends Model
{
    protected $fillable = [
        'employee_id',
        'assign',
        'status',

    ];



    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/employee-statuses/' . $this->getKey());
    }


    /* ************************ ACCESSOR ************************* */

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }
}
