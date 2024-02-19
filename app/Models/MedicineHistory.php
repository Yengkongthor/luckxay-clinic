<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineHistory extends Model
{
    protected $fillable = [
        'medicine_id',
        'price',
        'status_approved',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];


    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/medicine-histories/' . $this->getKey());
    }

    public function medicine()
    {
        return $this->belongsTo('App\Models\Medicine');
    }
}
