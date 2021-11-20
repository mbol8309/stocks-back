<?php

namespace App\Traits;

use App\Models\Context;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ContextScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $user = Auth::user();
        if ($user != null) {
            $context_id = $user->context_id;
            $global_context = Context::where('name','global')->first();
            if ($context_id != $global_context->id){
                $builder->where('context_id', $context_id);
            }
        }
    }
}
