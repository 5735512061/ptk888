<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Seller extends Authenticatable
{
    use Notifiable;

    protected $table = 'sellers';

    protected $guard = 'seller';

    protected $fillable = [
        'admin_id', 'seller_id', 'name', 'surname', 'phone', 'username', 'password', 'role', 'status', 
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}
