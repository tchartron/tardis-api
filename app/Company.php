<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'description'];

    // protected $guarded = [];

    public function time()
    {
        return $this->hasMany(Time::class);
    }
}
