<?php

namespace App\Http\Controllers;

use App\Task;
use App\Company;
use Illuminate\Http\Request;

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
        $task->user_id = \Auth::user()->id;
        $company->tasks()->save($task);

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

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
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
        // $task->update(request()->all());
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