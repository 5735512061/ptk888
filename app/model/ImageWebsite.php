<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ImageWebsite extends Model
{
	protected $table = 'image_websites';

	protected $fillable = [
    	'image_type', 'image', 'heading_detail', 'detail'
    ];

    protected $primaryKey = 'id';
}
