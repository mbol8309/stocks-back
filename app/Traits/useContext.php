<?php
namespace App\Traits;

use App\Models\Context;
use App\Scope\ContextScope;

trait useContext 
{
    public function context()
    {
        return $this->belongsTo(Context::class,'context_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ContextScope);
    }
}