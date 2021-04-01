<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class MessageStore extends Model
{
	protected $table = 'message_stores';

	protected $fillable = [
    	'store_id', 'subject', 'message', 'answer_message',
    ];

    protected $primaryKey = 'id';
}
