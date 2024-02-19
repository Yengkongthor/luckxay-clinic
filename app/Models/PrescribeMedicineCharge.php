<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrescribeMedicineCharge extends Model
{
    protected $fillable = [
        'prescribe_medicine_id',
        'charge',
        'vat',
        'exam_fee_discount',
        'discounted_services',
        'doctor_fee',
        'doctor_fee_discount',
        'medicine_discount',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/prescribe-medicine-charges/' . $this->getKey());
    }
}
