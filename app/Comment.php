<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $table = 'comments';
	protected $fillable = [
	'text',
	];
	function user()
	{
		return $this->belongsTo('App\User');
	}
	function event()
	{
		return $this->belongsTo('App\Event');
	}
}