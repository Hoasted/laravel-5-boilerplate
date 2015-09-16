<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StackMember extends Model
{
    protected $table = 'stack_members';

    public function stack()
    {
        return $this->belongsTo('App\Stack');
    }

    public function referred()
    {
        return $this->hasMany('App\StackMember', 'referred_by')->where('is_valid_signup_ip', true);
    }

    public function referredBy()
    {
        return $this->belongsTo('App\StackMember', 'referred_by');
    }

    public function shares()
    {
        return $this->hasMany('App\StackShare');
    }

    public function getTillNextTierAttribute()
    {
        $stack = $this->stack()->first();
        $tier = $stack->tiers()->where('signups_required', '>', $this->referred()->count())->first();
        return $tier->signups_required - $this->referred()->count();
    }
}
