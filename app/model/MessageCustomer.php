<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class MessageCustomer extends Model
{
	protected $table = 'message_customers';

	protected $fillable = [
    	'customer_id','name', 'phone', 'subject', 'message', 'answer_message',
    ];

    protected $primaryKey = 'id';
}
