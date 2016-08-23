<?php

namespace App\Http\Controllers;

use App\User;
use App\Event;
use App\Http\Controllers\Controller;
use Auth;
use DB;
class IndexController extends Controller
{

    function index()
    {
        if(!Auth::user())
        {
            $events = Event::where('expired','0')->orderBy('start_time', 'asc')->take(12)->get();
            return view('guest.index', compact('events'));
        }
        else 
        {

            self::expireEvents();
            $names = json_decode(Auth::user()->interests);
            if($names)
            {
                $events = Event::leftJoin('interests', function($join) use($names)
                {
                    $join->on('interests.event_id', '=', 'events.id')
                    ->whereIn('interests.name', $names);
                })
                ->where('events.expired','0')
                ->groupBy('events.id')
                ->orderBy('interests_count', 'DESC')
                ->orderBy('start_time', 'asc')
                ->get(['events.*', \DB::raw('COUNT(`' . \DB::getTablePrefix() . 'interests`.`id`) AS `interests_count`')]);
            }
            else
            {
                $events = Event::where('expired', '0')->orderBy('start_time', 'asc')->get();
            }

            return view('user.index', compact('events'));
        }
    }
    function expireEvents(){
       // $events = Event::where('expired', '0')->whereRaw('start_time' , '<=', date('H:i'))->where('date', '<=', date('d.m.Y'))->get();
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
