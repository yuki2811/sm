<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'account', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public function classes()
    {
        return $this->belongsToMany('App\Classes', 'class_user', 'user_id', 'class_id');
    }

}
