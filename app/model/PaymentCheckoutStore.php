<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class PaymentCheckoutStore extends Model
{
	protected $table = 'payment_checkout_stores';

	protected $fillable = [
    	'store_id', 'bill_number', 'payday', 'time', 'money', 'slip'
    ];

    protected $primaryKey = 'id';
}
