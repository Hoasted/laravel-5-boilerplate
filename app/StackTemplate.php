<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StackTemplate extends Model
{
    public function stacks()
    {
        return $this->hasMany('App\Stack');
    }
}
