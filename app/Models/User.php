<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements \Illuminate\Contracts\Auth\Authenticatable
{
    const STATUS_CREATED = 1;
    const STATUS_VERIFIED = 3;
    const STATUS_BLOCKED = 2;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function checkPhone(Model $user, $phoneCode)
    {
        if ($user->phone_code === $phoneCode) {
            $user->status = self::STATUS_VERIFIED;
            $user->save();
            return $user;
        }
        return false;
    }

    public function roles() {
        return $this->belongsToMany('App\Models\Role', 'role_user_details');
    }
}
