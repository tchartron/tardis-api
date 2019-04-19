<?php

namespace App\Http\Controllers;

use App\Timer;
use Illuminate\Http\Request;

class TimerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timers = Timer::all();
        return view('timers.index', compact('timers'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(request());
        request()->validate([
            'company_id' => ['required', 'integer'],
            'total_time' => ['required', 'date_format:H:i:s']
        ]);
        //NOT WORKINGit says user_id does not have a default value ...
        // Time::create([
        //     'user_id' => \Auth::user()->id, //or auth()->user()->id
        //     'company_id' => request('company_id'),
        //     'total_time' => request('total_time')
        // ]);
        $timer = new Timer();
        $timer->user_id = \Auth::user()->id; //or auth()->user()->id
        $timer->company_id = request('company_id');
        $timer->total_time = request('total_time');
        $timer->save();
        return back(); // redirect to previous page
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timer $timer)
    {
        $timer->delete();
        return back();
    }
}
