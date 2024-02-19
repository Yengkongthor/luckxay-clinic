<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrescribeMedicineDetail extends Model
{
    protected $fillable = [
        'amount',
        'name',
        'prescribe_medicine_id',
        'price',
        'medicine_id',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];
    // protected $with = ['prescribeMedicine'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/prescribe-medicine-details/' . $this->getKey());
    }

    public function prescribeMedicine()
    {
        return $this->belongsTo('App\Models\PrescribeMedicine');
    }

    public function medicine()
    {
        return $this->belongsTo('App\Models\Medicine');
    }

    public function labDetail()
    {
        return $this->belongsTo('App\Models\LabDetail');
    }
}
