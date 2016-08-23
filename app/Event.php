<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $table = 'events';
	protected $fillable = [
	'title', 'description', 'location', 'start_time', 'end_time', 'date', 'icon', 'expired', 'expire_time'
	];

	function users()
	{
		return $this->belongsToMany('App\User','user_event');
	}
	function interests()
	{
		return $this->hasMany('App\Interest');
	}
	public function comments()
	{
		return $this->hasMany('App\Comment')->orderBy('created_at','desc');
	}
	function parseInterests()
	{
		$result = '';

		$interests = $this->interests;
		if(count($interests) > 0)
		{
			foreach ($interests as $key => $i)
			{
				$result.=$i->name;
				if($key < count($interests) - 1)

					$result.=', ';
			}
		}
		return $result;
	}
	function attending()
	{
		$stuff = 'going';
		if(Auth::user())
		{
			if(Auth::user()->events->contains($this->id))
				$stuff .= '. You are also going.';
		}
		if($this->expired)
			$stuff = 'went';
		if($this->users->count() == 1)
			return "1 person ".$stuff;
		else
			return $this->users->count(). ' people '.$stuff;
	}

	public function isOverLapping(){
		foreach(Auth::user()->events()->where('expired','0')->get() as $e)
		{
			$his_start_time = strtotime($e->date.' '.$e->start_time );
			$his_end_time = strtotime($e->date.' '.$e->end_time );

			$my_start_time = strtotime($this->date.' '.$this->start_time);
			$my_end_time = strtotime($this->date.' '.$this->end_time);
			if( !($my_start_time > $his_end_time || $my_end_time < $his_start_time )){
				return $e->name;
			}
		}
		return false;
	}
	public function scopeActive($query)
	{
		return $query->where('expired', 0);
	}
	function time()
	{
		$diff = date_diff(date_create($this->start_time), date_create($this->end_time));

		if($diff->h == 0)
		{
			if($diff->i > 1)
				return $diff->i.' minutes';
			else
				return "1 minute";
		}
		else{
			if($diff->i == 0)
			{
				if($diff->h == 1)
					return '1 hour';
				else 
					return $diff->h.' hours';
			}
			else{
				if($diff->h == 1)
				{
					$a = '1 hour and ';
					$a.= $diff->i == 1 ? " 1 minute" : $diff->i.' minutes';
					return $a;
				}
				else 
				{
					$a = $diff->h.' hours and ';
					$a.= $diff->i == 1 ? " 1 minute" : $diff->i.' minutes';
					return $a;
				}
			}
		}
	}

}