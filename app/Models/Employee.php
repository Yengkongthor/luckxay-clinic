<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'branch_id',
        'admin_user_id',
        'department_code',
        'lao_first_name',
        'lao_last_name',
        'position',
        'phone',
        'lab_id',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $casts = [
        'lab_id' => 'array',
    ];

    protected $appends = ['resource_url', 'employee_status_online'];

    protected $with = ['employeeStatus'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/employees/' . $this->getKey());
    }

    public function getEmployeeStatusOnlineAttribute()
    {
        return $this->employeeStatus ? $this->employeeStatus->status : 0;
    }

    /* ************************ RELATION ************************* */

    public function employeeStatus()
    {
        return $this->hasOne('App\Models\EmployeeStatus');
    }
}
