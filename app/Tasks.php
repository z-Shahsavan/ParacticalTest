<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = [
        'id', 'to_dos_id', 'title','taskdesc','status','duedate','sort',
    ];
}