<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class To_dos extends Model
{
    protected $fillable = [
        'id', 'user_id', 'title','text','status','sort'
    ];
}
