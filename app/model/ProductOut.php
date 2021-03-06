<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ProductOut extends Model
{
	protected $table = 'product_outs';

	protected $fillable = [
    	'film_model_id', 'serialnumber', 'date'
    ];

    protected $primaryKey = 'id';
}
