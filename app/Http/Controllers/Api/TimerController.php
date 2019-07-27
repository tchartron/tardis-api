<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Timer;
use App\Task;
use App\Group;
use Carbon\Carbon;

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
        return response()->json($timers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Group $group, Task $task)
    {
        $user = \Auth::user();
        // dd($group->tasks->contains($task));
        if($group->tasks->contains($task)) {
            $timer = new Timer();
            $timer->user_id = $user->id; //or auth()->user()->id
            $timer->task_id = $task->id;
            $timer->finished_at = Carbon::now();
            $timer->save();
            return response()->json(['success' => 'Timer added to task : '.$task->title.' (id:'.$task->id.')',
                                    'timer' => $timer], 200);
        } else {
            return response()->json(['error' => 'This task does not belongs to this group'], 401);
        }
        // $user->timers()->save($timer);
        // $task->timers()->save($timer);
        // $group->tasks()->timers()->save($timer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group, Task $task, Timer $timer)
    {
        $returnTimer = $group->timers()
                            ->where([
                                ['task_id', '=', $task->id],
                                ['timers.id', '=', $timer->id],
                            ])->get();
        return response()->json($returnTimer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group, Task $task, Timer $timer)
    {
        // dd(Timer::where('id', $timer->id)->exists()); //Check if timer exists
        // dd($group->tasks->contains($task)); //Check if task belongs to this group
        // dd($task->timers->contains($timer)); //Check if timer belongs to this task timers
        if(Timer::where('id', $timer->id)->exists()) {
            if($group->tasks->contains($task)) {
                if($task->timers->contains($timer)) {
                    $timer->update([
                        'finished_at' => Carbon::now()
                    ]);
                    return response()->json(["success" => "Timer successfully updated"], 200);
                } else {
                    return response()->json(["error" => "This timer does not belongs to this task"], 404);
                }
            } else {
                return response()->json(["error" => "This task does not belongs to this group"], 404);
            }
        } else {
            return response()->json(["error" => "This timer id does not exists"], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group, Task $task, Timer $timer)
    {
        if(Timer::where('id', $timer->id)->exists()) {
            if($group->tasks->contains($task)) {
                if($task->timers->contains($timer)) {
                    $timer->delete();
                    return response()->json(["sucess" => "Timer successfully deleted"], 200);
                } else {
                    return response()->json(["error" => "This timer does not belongs to this task"], 404);
                }
            } else {
                return response()->json(["error" => "This task does not belongs to this group"], 404);
            }
        } else {
            return response()->json(["error" => "This timer id does not exists"], 404);
        }
    }

    public function now()
    {
        return response()->json(["now" => Carbon::now()]);
    }
}
