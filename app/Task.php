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

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
