<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class PaymentCheckoutCustomer extends Model
{
	protected $table = 'payment_checkout_customers';

	protected $fillable = [
    	'customer_id', 'bill_number', 'payday', 'time', 'money', 'slip'
    ];

    protected $primaryKey = 'id';
}
