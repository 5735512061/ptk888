<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categorys';

	protected $fillable = [
    	'category', 'category_eng'
    ];

    protected $primaryKey = 'id';
}
