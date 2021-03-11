<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class PhoneModel extends Model
{
	protected $table = 'phone_models';

	protected $fillable = [
    	'brand_id','model', 'model_eng', 'status',
    ];

    protected $primaryKey = 'id';
}
