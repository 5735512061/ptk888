<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ProductPromotionPrice extends Model
{
	protected $table = 'product_promotion_prices';

	protected $fillable = [
    	'product_id', 'promotion_price', 'status',
    ];

    protected $primaryKey = 'id';
}