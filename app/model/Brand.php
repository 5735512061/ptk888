<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
	protected $table = 'brands';

	protected $fillable = [
    	'brand', 'brand_eng', 'image'
    ];

    protected $primaryKey = 'id';
}
