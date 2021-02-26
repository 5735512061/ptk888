<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class MessageCustomer extends Model
{
	protected $table = 'message_customers';

	protected $fillable = [
    	'name', 'phone', 'subject', 'message'
    ];

    protected $primaryKey = 'id';
}
