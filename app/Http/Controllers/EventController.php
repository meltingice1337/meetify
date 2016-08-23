<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use App\User;
use App\Event;
use App\Interest;
use App\Comment;

class EventController extends Controller
{
	function getHistory(){
		self::expireEvents();
		$events = Auth::user()->events()->where('expired', '1')->orderBy('expire_time', 'desc')->get();
		return view('user.events.history', compact('events'));
	}
	function getJoinedEvents(){
		self::expireEvents();
		$events = Auth::user()->events()->where('expired', '0')->orderBy('start_time', 'asc')->get();
		return view('user.events.joined', compact('events'));
	}

	function getJoinEvent($id)
	{
		$event = Event::find($id);
		if(!$event)
			return response()->view('errors.404', [], 404);
		if($event->expired)
			return response()->view('errors.404', [], 404);
		if(!Auth::user()->events->contains($event->id))
		{
			foreach(Auth::user()->events()->where('expired','0') as $e)
			{
				if(strtotime($e->date.' '.$e->end_time )> strtotime($event->date.' '.$event->start_time))
					return redirect(route('index'));
			}
			$event->users()->attach(Auth::user()->id);
		}
		return redirect()->back();
	}
	function getUnjoinEvent($id)
	{
		$event = Event::find($id);
		if(!$event)
			return response()->view('errors.404', [], 404);
		if($event->expired)
			return response()->view('errors.404', [], 404);

		Auth::user()->events()->detach($event->id);
		return redirect(route('index'));
	}
	function getEvent($id){
		$event = Event::find($id);
		if(!$event)
			return response()->view('errors.404', [], 404);
		$comments = Comment::where('event_id', $event->id)->orderBy('created_at', 'desc')->paginate(10);
		if($event->expired)
			return view('user.events.expired', compact('event', 'comments'));
		else
			return view('user.event', compact('event', 'comments'));
	}

	function getCreateEvent()
	{
		return view('user.events.create');
	}

	function postCreateEvent(Request $request)
	{
		$this->validate($request, [
			'title' => 'required',
			'description' => 'required',
			'start_time' => 'required',
			'end_time' => 'required',
			'date' => 'required',
			'interests' => 'required',
			'location' => 'required',
			]);
		$errors = [];
		if(!self::validateDate($request->get('start_time'),'H:i'))
			$errors[] = "Start time is not valid";
		if(!self::validateDate($request->get('end_time'),'H:i'))
			$errors[] = "End time is not valid";
		if(!self::validateDate($request->get('date'),'Y-m-d'))
			$errors[] = "Date  is not valid";
		if(strtotime($request->get('start_time')) >= strtotime($request->get('end_time')))
			$errors[] = "The start time cannot be less than the end time";
		if(strtotime($request->get('date').' '.$request->get('start_time')) <= time())
			$errors[] = "Cannot start with a time less than now ";

		foreach(Auth::user()->events()->where('expired', '0')->get() as $e)
		{
			$his_start_time = strtotime($e->date.' '.$e->start_time );
			$his_end_time = strtotime($e->date.' '.$e->end_time );

			$my_start_time = strtotime($request->get('date').' '.$request->get('start_time'));
			$my_end_time = strtotime($request->get('date').' '.$request->get('end_time'));
			if( !($my_start_time > $his_end_time || $my_end_time < $his_start_time ))
			{

				$errors[] = 'You cannot create an event while participating in another';
			}
		}

		if(count($errors) > 0)
			return redirect()->back()->withErrors($errors);
		$icon = $request->get('icon','unknown');
		if(in_array($icon, ['food','drink','movie','walk','games','unknown']))
			$icon = 'images/'.$icon.'.png';
		else{
			$icon = 'images/unknown.png';
		}
		$event = Event::create([
			'title' => $request->get('title'),
			'description' => $request->get('description'),
			'start_time' => $request->get('start_time'),
			'end_time' => $request->get('end_time'),
			'date' => date("d.m.Y", strtotime($request->get('date'))),
			'location' => $request->get('location',''),
			'expire_time' => date('Y-m-d H:i', strtotime($request->get('start_time').' '.$request->get('date'))),
			'icon' => $icon,
			]);
		$event->users()->attach(Auth::user()->id);
		$interests = explode(',', $request->get('interests'));
		foreach($interests as $interest)
		{
			$i = Interest::create(['name' => trim($interest)]);
			$event->interests()->save($i);
		}
		return redirect(route('index'));
	}
	static public function validateDate($date,$format)
	{
		return (DateTime::createFromFormat($format, $date) !== false);
	}
	function expireEvents(){
		$events = Event::active()
		->where('expire_time','<=',date('Y-m-d H:i'))
		->get();
		foreach($events as $e)
		{
			$e->expired = 1;
			$e->save();
		}
		return;
	}
}