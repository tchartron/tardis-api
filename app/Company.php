<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'description'];

    // protected $guarded = [];

    public function timer()
    {
        return $this->hasMany(Timer::class);
    }
}
