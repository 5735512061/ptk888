<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
	protected $table = 'image_products';

	protected $fillable = [
    	'image',
    ];

    protected $primaryKey = 'id';
}
