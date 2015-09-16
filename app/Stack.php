<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stack extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stacks';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * For soft deletes
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function actions()
    {
        return $this->hasMany('App\StackAction');
    }

    public function tiers()
    {
        return $this->hasMany('App\StackTier')->orderBy('signups_required');;
    }

    public function integrations()
    {
        return $this->hasMany('App\StackIntegration');
    }

    public function members()
    {
        return $this->hasMany('App\StackMember');
    }

    public function ips()
    {
        return $this->hasMany('App\StackIp');
    }

    public function template()
    {
        return $this->belongsTo('App\StackTemplate');
    }

    public function content()
    {
        return $this->hasMany('App\StackContent');
    }
}
