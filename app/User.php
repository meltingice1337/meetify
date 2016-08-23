<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function events()
    {
        return $this->belongsToMany('App\Event','user_event');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    function parseInterests()
    {
        $result = '';
        $interests = json_decode($this->interests);
        if(count($interests) > 0)
        {
            foreach ($interests as $key => $i)
            {
                $result.=$i;
                if($key < count($interests) - 1)

                    $result.=', ';
            }
        }
        return $result;
    }
}
