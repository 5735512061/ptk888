<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'member_id', 'name', 'surname', 'phone', 'username', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}
