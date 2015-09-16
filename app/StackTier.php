<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StackTier extends Model
{
    public function stack()
    {
        return $this->belongsTo('App\Stack');
    }

    public function actions()
    {
        return $this->hasMany('App\StackAction', 'tier_id');
    }

    public function getPositionAttribute()
    {
        $tiers = \App\StackTier::where('stack_id', '=', $this->stack_id)->get();
        $orderPostion = $tiers->search($this);
        $position = (( ( 1 / ($tiers->count() ) ) / 2 ) + ( ( 1 / ( $tiers->count() ) ) * $orderPostion)) * 100;
        return $position;
    }
}
