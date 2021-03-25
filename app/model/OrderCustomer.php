<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class OrderCustomer extends Model
{
	protected $table = 'order_customers';

	protected $fillable = [
    	'customer_id', 'payment_id', 'shipment_id', 'product_cart_id', 'date', 'bill_number'
    ];

    protected $primaryKey = 'id';
}
