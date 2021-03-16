<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Serialnumber extends Model
{
	protected $table = 'serialnumbers';

	protected $fillable = [
    	'film_model', 'serialnumber', 'status'
    ];

    protected $primaryKey = 'id';
}
