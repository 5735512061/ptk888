<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
	protected $table = 'product_prices';

	protected $fillable = [
    	'product_id', 'price', 'status',
    ];

    protected $primaryKey = 'id';
}
