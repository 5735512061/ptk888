<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ProductCartStoreFilmBrand extends Model
{
	protected $table = 'product_cart_store_film_brands';

	protected $fillable = [
    	'store_id', 'product_id', 'bill_number', 'price', 'qty'
    ];

    protected $primaryKey = 'id';
}
