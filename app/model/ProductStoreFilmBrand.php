<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ProductStoreFilmBrand extends Model
{
	protected $table = 'product_store_film_brands';

	protected $fillable = [
    	'film_type_id', 'film_brand',
    ];

    protected $primaryKey = 'id';
}