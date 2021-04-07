<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class PaymentCheckoutStoreFilmBrand extends Model
{
	protected $table = 'payment_checkout_store_film_brands';

	protected $fillable = [
    	'store_id', 'bill_number', 'payday', 'time', 'money', 'slip'
    ];

    protected $primaryKey = 'id';
}
