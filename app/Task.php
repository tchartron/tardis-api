<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'completed'];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function timers()
    {
        return $this->hasMany(Timer::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, "owner_id");
    }
}
