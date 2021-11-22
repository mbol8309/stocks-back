<?php

declare(strict_types=1);

namespace App\GraphQL\Entities\User\Queries;

use App\GraphQL\Queries\Query;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\SelectFields;

class UserMeQuery extends Query
{
    protected $attributes = [
        'name' => 'me',
        'description' => 'Asking for current user'
    ];

    public function __construct()
    {
        
        $this->type = GraphQL::type('User');
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return Auth::user();
    }
}
