<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $fillable = [
        'medicine_id',
        'medicine_pricing_id',
        'price',
        'amount',

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
        return url('/admin/shopping-carts/' . $this->getKey());
    }

    public function medicine()
    {
        return $this->belongsTo('App\Models\Medicine');
    }
}
