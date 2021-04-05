<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ShipmentStore extends Model
{
	protected $table = 'shipment_stores';

	protected $fillable = [
    	'store_id', 'bill_number', 'name', 'phone', 'phone_sec', 'address', 'district', 'amphoe', 'province', 'zipcode'
    ];

    protected $primaryKey = 'id';
}
