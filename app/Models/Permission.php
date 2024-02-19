<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission as BasePermission;

class Permission extends BasePermission
{
    protected $fillable = [
        'name',
        'guard_name',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/permissions/' . $this->getKey());
    }

    /* ************************ OTHERS ************************* */

    public static function getKeys()
    {
        $keys = Permission::select('id', 'name')->where('guard_name', 'admin')->get()->groupBy(function ($item) {
            $explode = explode('.', $item->name);
            if (count($explode) == 1) {
                return $explode[0];
            } else {
                $search = $explode[0] . '.' . $explode[1];
                if (Str::contains($item->name, $search)) {
                    return $search;
                }
            }
        });

        return $keys;
    }
}
