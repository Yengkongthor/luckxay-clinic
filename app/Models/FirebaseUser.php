<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FirebaseUser extends Model
{
    protected $fillable = [
        'user_id',
        'f_user_uid',
        'provider_id',
        'provider_uid',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/firebase-users/'.$this->getKey());
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
