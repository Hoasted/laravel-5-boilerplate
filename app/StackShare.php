<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StackShare extends Model
{
    public function member()
    {
        return $this->belongsTo('App\StackMember');
    }
}
