<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'description'];

    // protected $guarded = [];

    public function timers()
    {
        return $this->hasMany(Timer::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
