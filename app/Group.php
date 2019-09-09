<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Group extends Model
{
    protected $fillable = ['name', 'description', 'gitlab_id'];

    // protected $guarded = [];

    // public function timers()
    // {
    //     return $this->hasMany(Timer::class);
    // }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function timers()
    {
        return $this->hasManyThrough(Timer::class, Task::class);
    }

    public function addTask($task)
    {
        $task['user_id'] = \Auth::user()->id;
        $task['group_id'] = $this->id;
        $this->tasks()->create($task);

        //Does not work
        // return Task::create([
        //     'group_id' => $this->id,
        //     'user_id' => \Auth::user()->id,
        //     'title' => $task['title'],
        //     'description' => $task['description'],
        // ]);
    }

    public function totalTimeSpent() //later add date picker in view for peroid range
    {
        $tasks = $this->tasks;
        // dd($tasks);
        foreach ($tasks as $key => $value) {
            // dd($value->timers);
        }
        // dd($tasks);
    }

}
