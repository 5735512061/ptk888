<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class FilmPriceStore extends Model
{
	protected $table = 'film_price_stores';

	protected $fillable = [
    	'film_id', 'price', 'date',
    ];

    protected $primaryKey = 'id';
}
