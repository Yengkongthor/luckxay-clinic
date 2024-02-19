<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookAnAppointment extends Model
{
    protected $fillable = [
        'user_id',
        'booking_date',
        'booking_time',
        'purpose',
    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/book-an-appointments/' . $this->getKey());
    }



    /* ************************ RELATIONS ************************ */

    public function time()
    {
        return $this->belongsTo('App\Models\BookingTime', 'booking_time');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
