<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{

    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function company()
    // {
    //     return $this->belongsTo(Company::class);
    // }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
