<?php

namespace App\Http\Controllers;

use App\Timer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TimerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
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
            'task_id' => ['required', 'integer']
            // 'finished_at' => ['required', 'date_format:H:i:s']
        ]);
        //NOT WORKINGit says user_id does not have a default value ...
        // Time::create([
        //     'user_id' => \Auth::user()->id, //or auth()->user()->id
        //     'company_id' => request('company_id'),
        //     'total_time' => request('total_time')
        // ]);
        $timer = new Timer();
        $timer->user_id = \Auth::user()->id; //or auth()->user()->id
        $timer->task_id = request('task_id');
        $timer->finished_at = Carbon::now();
        $timer->save();
        return response()->json([
            'timer' => $timer
        ]);
        // return back(); // no need to return it's called via ajax at timer start
    }

    public function update(Request $request, Timer $timer)
    {
        // request()->validate([
        //     'task_id' => ['required', 'integer']
        //     // 'finished_at' => ['required', 'date_format:H:i:s']
        // ]);

        $timer->update([
            'finished_at' => Carbon::now()
        ]);
        // return redirect('/tasks'); // called via ajax when timer stop button pressed
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
