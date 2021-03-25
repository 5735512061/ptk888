<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ProductCartCustomer extends Model
{
	protected $table = 'product_cart_customers';

	protected $fillable = [
    	'customer_id', 'product_id', 'bill_number', 'price', 'qty'
    ];

    protected $primaryKey = 'id';
}
