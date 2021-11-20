<?php

namespace App\Scope;

use App\Models\Context;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class CategoryScope implements Scope
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
        if ($user !=null){
            $context = Context::find($user->context_id);
            if ($context != null){
                $bc = $context->categories()->withoutGlobalScope(CategoryScope::class)->first();
                $builder->where('root_id',$bc->id);
            }

        }
    }
}
