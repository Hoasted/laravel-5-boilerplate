<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StackContent extends Model
{
    public function setMetaAttribute($value)
    {
        $this->attributes['meta'] = serialize($value);
    }

    public function getMetaAttribute($value)
    {
        return unserialize($value);
    }

    public function stack()
    {
        return $this->belongsTo('App\Stack');
    }
}
