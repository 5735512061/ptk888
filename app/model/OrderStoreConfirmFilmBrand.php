<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class OrderStoreConfirmFilmBrand extends Model
{
	protected $table = 'order_store_confirm_film_brands';

	protected $fillable = [
    	'order_id', 'status'
	];
	
    protected $primaryKey = 'id';
}
