<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ShipmentCustomer extends Model
{
	protected $table = 'shipment_customers';

	protected $fillable = [
    	'customer_id', 'bill_number', 'name', 'phone', 'phone_sec', 'address', 'district', 'amphoe', 'province', 'zipcode'
    ];

    protected $primaryKey = 'id';
}
