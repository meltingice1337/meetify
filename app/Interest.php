<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
	protected $table = 'interests';
	protected $fillable = [
	'name',
	];

	function event()
	{
		return $this->belongsTo('App\Event');
	}

}