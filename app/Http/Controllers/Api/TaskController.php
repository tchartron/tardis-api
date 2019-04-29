<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Task;
use App\Company;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {
        // $tasks = Task::all();
        $tasks = $company->tasks;
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Company $company)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:10']
        ]);

        $task = new Task();
        $task->title = request('title');
        $task->description = request('description');
        $company->tasks()->save($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company, Task $task)
    {
        // $returnTask = $company->tasks()
        //             ->where([
        //                 ['id', $task->id]
        //             ])->get();
        $returnTask = $company->tasks()
                    ->whereId($task->id)->get();
        return response()->json($returnTask);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company, Task $task)
    {
        $validatedRequest = request()->validate([
            'title' => ['min:3'],
            'description' => ['min:10']
        ]);
        // $task->update([
        //     'title' => request('title'),
        //     'description' => request('description'),
        //     'completed' => request('completed')
        // ]);
        $task->update($validatedRequest); // We do this because the previous method generate a sql query with each fields and some cannot be empty, instead validatedrequest just mention the specified filed in sql so the others are not setted to null
        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company, Task $task)
    {
        return response()->json($task->delete());
    }
}
