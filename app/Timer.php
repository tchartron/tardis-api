<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class Timer extends Model
{

    protected $fillable = ['finished_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function group()
    // {
    //     return $this->belongsTo(Group::class);
    // }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Get total time for humans
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function getTimeSpent()
    {
        $start  = new Carbon($this->created_at);
        $end  = new Carbon($this->finished_at);
        // return $start->diffForHumans($end);
        return $start->diffInHours($end) . ':' . $start->diff($end)->format('%I:%S');;
    }
}
