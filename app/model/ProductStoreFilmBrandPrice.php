<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ProductStoreFilmBrandPrice extends Model
{
	protected $table = 'product_store_film_brand_prices';

	protected $fillable = [
    	'product_id', 'price', 'status'
    ];

    protected $primaryKey = 'id';
}