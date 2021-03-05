<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class FilmType extends Model
{
	protected $table = 'film_types';

	protected $fillable = [
    	'film_type', 'film_type_eng'
    ];

    protected $primaryKey = 'id';
}
