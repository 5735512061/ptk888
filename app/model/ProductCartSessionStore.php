<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ProductCartSessionStore extends Model
{
	protected $table = 'product_cart_session_stores';

	protected $fillable = [
    	'store_id', 'product_id', 'qty'
    ];

    protected $primaryKey = 'id';
}
