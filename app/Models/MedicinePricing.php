<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicinePricing extends Model
{
    protected $table = 'medicine_pricing';

    protected $fillable = [
        'amount',
        'base_price',
        'best_before_date',
        'manufacture_date',
        'medicine_id',
        'supplier_id',
        'current_amount',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];
    protected $with = ['medicine'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/medicine-pricings/' . $this->getKey());
    }


    /* ************************ RELATION ************************* */

    public function medicine()
    {
        return $this->belongsTo('App\Models\Medicine');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }
}
