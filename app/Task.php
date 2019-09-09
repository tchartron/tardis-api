<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'completed', 'gitlab_id'];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function timers()
    {
        return $this->hasMany(Timer::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, "owner_id");
    }
}
