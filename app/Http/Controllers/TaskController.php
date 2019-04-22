<?php

namespace App\Http\Controllers;

use App\Task;
use App\Company;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskController extends Controller
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
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Company $company)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:10']
        ]);
        ///////////////////
        //First approach //
        ///////////////////
        $task = new Task();
        $task->title = request('title');
        $task->description = request('description');
        // $task->user_id = \Auth::user()->id;
        $company->tasks()->save($task); // Saves the company_id type hinted as the relation

        ////////////////////
        //Second approach //
        ////////////////////
        // $company->addTask(request(['title', 'description']));

        ///////////////////
        //Third approach //
        ///////////////////
        // $task = new Task();
        // $task->title = request('title');
        // $task->description = request('description');
        // // $task->user_id = \Auth::user()->id;
        // $task->user()->associate(\Auth::user());
        // // $task->company_id = $company->id;
        // $task->company()->associate($company);
        // $task->save();

        return redirect('/companies/'.$company->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //Retrieve Timer
        // Query for timer belonging to this user and this task => pass data to view so we can pass the data to Vue for the stop button to update the timer
        // if no timer initialize a new one
        $user = \Auth::user();
        //Getting timers of this task which belongs to logged user and are not finished
        $userRunningTimers = $task->timers()
                        ->where([
                            ['user_id', $user->id],
                            ['finished_at', '=', \DB::raw('created_at')]
                        ])->get(); //Use toSql to see query and DB::raw() is to compare two columns values
        // dd($userRunningTimers);
        // dd(Carbon::now());
        $secondesTotal = 0;
        $timerId = 0;
        foreach ($userRunningTimers as $runningTimer) {
            // Calculate the difference using carbon to pass data to Timer vue component and initialize it
            // dd($runningTimer->finished_at);
            $start  = new Carbon($runningTimer->created_at);
            // $end    = new Carbon($runningTimer->finished_at);
            $end    = Carbon::now();
            //Diff in hours
            // $start->diff($end)->format('%H:%I:%S');
            //Diff in hours more than 24h
            // $start->diffInHours($end) . ':' . $start->diff($end)->format('%I:%S');
            $secondesTotal = $start->diffInSeconds($end);
            $timerId = $runningTimer->id;
            // dd($secondes);
        }
        // dd($secondesTotal);
        return view('tasks.show', ['task' => $task, 'runningTimerSeconds' => $secondesTotal, 'timerId' => $timerId]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        // dd(request()->all());
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:10']
        ]);

        ///////////////////
        //First approach //
        ///////////////////
        // $task->title = request('title');
        // $task->description = request('description');
        // $task->save();

        ////////////////////
        //Second approach //
        ////////////////////
        $task->update([
            'title' => request('title'),
            'description' => request('description'),
            'completed' => request()->has('completed')
        ]);
        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
