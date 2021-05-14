<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ProductFilmInformation extends Model
{
	protected $table = 'product_film_informations';

	protected $fillable = [
    	'film_type_id','type_information', 'film_information_th', 'film_information_en'
    ];

    protected $primaryKey = 'id';
}
