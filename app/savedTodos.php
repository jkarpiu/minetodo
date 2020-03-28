<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class savedTodos extends Model
{
    protected $fillable = ['todo', 'done', 'owner', 'priority'];
}
