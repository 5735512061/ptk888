<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Store extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'admin_id', 'store_id', 'name', 'phone', 'username', 'password', 'role', 'status', 'image_logo', 'address'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}
