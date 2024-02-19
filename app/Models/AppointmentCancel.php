<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentCancel extends Model
{
    protected $fillable = [
        'user_id',
        'booking_date',
        'booking_time',
        'reason',
    ];
}
