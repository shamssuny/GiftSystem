<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','password','email','active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function approve()
    {
        return $this->hasOne(Approve::class);
    }

    public function point()
    {
        return $this->hasOne(Point::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function prizes()
    {
        return $this->hasMany(Order::class);
    }
}
