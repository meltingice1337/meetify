<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Auth;

class UserController extends Controller
{

	function getProfile()
	{
		$user = Auth::user();
		$user->interests = json_decode($user->interests);
		return view('user.profile', compact('user'));
	}
	

}
