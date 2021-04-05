<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class OrderStore extends Model
{
	protected $table = 'order_stores';

	protected $fillable = [
    	'store_id', 'payment_id', 'shipment_id', 'product_cart_id', 'date', 'bill_number'
    ];

    protected $primaryKey = 'id';
}
