<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GitlabTasks extends Model
{
    protected $fillable = ['tardis_id', 'gitlab_id'];
}
