<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $table = 'products';

	protected $fillable = [
    	'category_id', 'brand_id', 'product_code', 'product_type', 'product_name', 'detail', 'property', 'status'
    ];

    protected $primaryKey = 'id';
}
