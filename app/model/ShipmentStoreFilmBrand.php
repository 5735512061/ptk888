<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ShipmentStoreFilmBrand extends Model
{
	protected $table = 'shipment_store_film_brands';

	protected $fillable = [
    	'store_id', 'bill_number', 'name', 'phone', 'phone_sec', 'address', 'district', 'amphoe', 'province', 'zipcode'
    ];

    protected $primaryKey = 'id';
}
