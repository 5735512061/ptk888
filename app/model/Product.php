<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $table = 'products';

	protected $fillable = [
    	'category_id', 'brand_id', 'phone_model_id','product_code', 'product_type', 'product_name', 'detail', 'property', 'status', 'product_recommend', 'film_model'
    ];

    protected $primaryKey = 'id';
}
