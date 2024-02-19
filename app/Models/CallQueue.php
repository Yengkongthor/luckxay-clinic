<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallQueue extends Model
{
    protected $fillable = [
        'queue_id',
        'start_at',
        'end_at',

    ];


    protected $dates = [
        'start_at',
        'end_at',
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/call-queues/' . $this->getKey());
    }

    /* ************************ RELATION ************************* */


    public function queue()
    {
        return $this->belongsTo('App\Models\Queue');
    }
}
