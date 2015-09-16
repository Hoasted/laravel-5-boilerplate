<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StackActionLog extends Model
{
    public function member()
    {
        return $this->belongsTo('App\StackMember');
    }

    public function action()
    {
        return $this->belongsTo('App\StackAction');
    }
}
