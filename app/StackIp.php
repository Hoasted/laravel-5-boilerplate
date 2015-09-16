<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StackIp extends Model
{
    public function stack()
    {
        return $this->belongsTo('App\Stack');
    }
}
