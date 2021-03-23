<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class WarrantyConfirm extends Model
{
	protected $table = 'warranty_confirms';

	protected $fillable = [
    	'warranty_id', 'status'
    ];

    protected $primaryKey = 'id';
}
