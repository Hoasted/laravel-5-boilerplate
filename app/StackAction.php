<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StackAction extends Model
{
    public function setConfigAttribute($value)
    {
        $this->attributes['config'] = serialize($value);
    }

    public function getConfigAttribute($value)
    {
        return unserialize($value);
    }

    public function stack()
    {
        return $this->belongsTo('App\Stack');
    }

    public function tier()
    {
        return $this->belongsTo('App\StackTier');
    }

    public function integration()
    {
        return $this->belongsTo('App\StackIntegration');
    }


}
