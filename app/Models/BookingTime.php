<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingTime extends Model
{
    protected $fillable = [
        'start_time',
        'end_time',
        'status_time',
        'status'

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/booking-times/'.$this->getKey());
    }
}
