<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ProductCartStore extends Model
{
	protected $table = 'product_cart_stores';

	protected $fillable = [
    	'store_id', 'product_id', 'bill_number', 'price', 'qty'
    ];

    protected $primaryKey = 'id';
}
