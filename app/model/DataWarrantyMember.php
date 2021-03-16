<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class DataWarrantyMember extends Model
{
	protected $table = 'data_warranty_members';

	protected $fillable = [
    	'name', 'surname', 'phone', 'film_model', 'serialnumber', 'phone_model', 'date_order', 'service_point', 'address_service', 'date'
    ];

    protected $primaryKey = 'id';
}
