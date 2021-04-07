<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ProductCartSessionStoreFilmBrand extends Model
{
	protected $table = 'product_cart_session_store_film_brands';

	protected $fillable = [
    	'store_id', 'product_id', 'qty'
    ];

    protected $primaryKey = 'id';
}
