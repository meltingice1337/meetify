<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Comment;
use App\Event;
use Illuminate\Support\Facades\Input;

class ApiController extends Controller
{

	function addImage(Request $request)
	{
		$this->validate($request, [
			"file" => "image|max:3000"
			]);
		$file = Input::file('file');
		$size = getimagesize($file);
		if($size[0] != $size[1])
			return redirect()->back();
		$filename = substr(str_shuffle(MD5(microtime())), 0, 10).'.'.$file->getClientOriginalExtension();
		$file->move('images', $filename);
		Auth::user()->image = 'images/'.$filename;
		Auth::user()->save();
		return redirect()->back();

	}
	function addInterest(Request $request)
	{
		if(!$request->get('name'))
			return 'error';
		$interests = json_decode(Auth::user()->interests);
		if(!$interests)
			$interests = [];
		$name = trim ($request->get('name'));
		if(in_array($name, $interests))
			return 'error';
		$interests[] = $name;
		Auth::user()->interests = json_encode($interests);
		Auth::user()->save();
		return 'ok';
	}

	function deleteInterest(Request $request)
	{
		if(!$request->get('name'))
			return 'error';
		$interests = json_decode(Auth::user()->interests);
		if(!$interests)
			$interests = [];
		$name = trim ($request->get('name'));
		if(!in_array($name, $interests))
			return 'error';
		if (($key = array_search($request->get('name'), $interests)) !== false) {
			unset($interests[$key]);
		}
		$interests = array_values($interests);
		Auth::user()->interests = json_encode($interests);
		Auth::user()->save();
		return 'ok';
	}
	function postComment(Request $request, $id)
	{
		$event = Event::find($id);
		if(!$event)
			return redirect(route('index'));
		if(!$request->get('message'))
			return redirect()->back();
		$this->validate($request, [
			'g-recaptcha-response' => 'required|captcha'
			]);
		$comment = Comment::create([
			'text' => $request->get('message')
			]);
		Auth::user()->comments()->save($comment);
		$event->comments()->save($comment);
		return redirect()->back();
	}

}
