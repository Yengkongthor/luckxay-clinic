<?php

namespace App\Models;

use Brackets\AdminAuth\Activation\Contracts\CanActivate as CanActivateContract;
use Brackets\AdminAuth\Activation\Traits\CanActivate;
use Brackets\AdminAuth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements CanActivateContract
{
    use Notifiable;
    use CanActivate;
    use HasRoles;
    use HasApiTokens;
    use SoftDeletes;


    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
        'email_verified_at',
        'password',

    ];

    protected $hidden = [
        'password',
        'remember_token',

    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',

    ];

    // protected $with = ['patient'];


    protected $appends = ['full_name_phone', 'resource_url','full_name'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/users/' . $this->getKey());
    }

    public function getFullNamePhoneAttribute()
    {
        return sprintf("%s %s (%s)", $this->name, $this->surname, $this->phone);
        // return $this->name . " " . $this->surname . " (" . $this->phone . ")";
    }

    public function getFullNameAttribute()
    {
        return $this->name . " " . $this->surname;
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(app(ResetPassword::class, ['token' => $token]));
    }

    /* ************************ RELATIONS ************************ */

    public function patient()
    {
        return $this->hasOne('App\Models\Patient')->withDefault();
    }

    public function appointments()
    {
        return $this->hasMany('App\Models\BookAnAppointment');
    }
}
