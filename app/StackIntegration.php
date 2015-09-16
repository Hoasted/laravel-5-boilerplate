<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class StackIntegration extends Model
{
    use SoftDeletes;

    protected $table = 'stack_integrations';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

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
}
