<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class OrderCustomerConfirm extends Model
{
	protected $table = 'order_customer_confirms';

	protected $fillable = [
    	'order_id', 'status'
	];
	
    protected $primaryKey = 'id';
}
