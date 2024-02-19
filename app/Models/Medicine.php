<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'brand_id',
        'category_id',
        'cheminal_name',
        'dose',
        'price',
        'status_approved',
        'amount',
        'min_amount',
        'medicines',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url', 'name_amount'];
    protected $with = ['brand', 'category'];



    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/medicines/' . $this->getKey());
    }
    public function getNameAmountAttribute()
    {
        return $this->cheminal_name . ' ' . ('ຈຳນວນ: ' . $this->amount). ' ປະເພດ :' .$this->category->name;
    }

    /* ************************ RELATION ************************* */

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
