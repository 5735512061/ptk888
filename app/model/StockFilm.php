<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class StockFilm extends Model
{
	protected $table = 'stock_films';

	protected $fillable = [
    	'film_type', 'amount', 'comment',
    ];

    protected $primaryKey = 'id';
}
