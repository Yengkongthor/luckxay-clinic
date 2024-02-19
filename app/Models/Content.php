<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['title', 'content', 'image'];
    protected $dates = [
        'created_at',
        'updated_at',

    ];
}
