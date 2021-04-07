<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class OrderStoreFilmBrand extends Model
{
	protected $table = 'order_store_film_brands';

	protected $fillable = [
    	'store_id', 'payment_id', 'shipment_id', 'product_cart_id', 'date', 'bill_number'
    ];

    protected $primaryKey = 'id';
}
