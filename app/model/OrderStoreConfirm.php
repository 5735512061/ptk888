<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class OrderStoreConfirm extends Model
{
	protected $table = 'order_store_confirms';

	protected $fillable = [
    	'order_id', 'status'
	];
	
    protected $primaryKey = 'id';
}
