<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends \Brackets\AdminAuth\Models\AdminUser
{



    /* ************************ Relation ************************* */

    public function employee()
    {
        return $this->hasOne('App\Models\Employee')->withDefault();
    }


    /* ************************ OTHERS ************************* */

    /**
     * Check user in department
     *
     * @param String $code department code
     * @return Boolean
     **/
    public function inDepartment($code)
    {
        if (!isset($this->employee)) return false;

        return $this->employee->department_code == $code;
    }

    /**
     * Only superadmin can manage superadmin
     *
     * @return abort(403)|null
     **/
    public function onlySuperAdmin()
    {
        if ($this->id == 1 && auth()->user()->id != 1) abort(403);
    }
}
