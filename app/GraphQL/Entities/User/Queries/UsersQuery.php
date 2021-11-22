<?php

namespace App\GraphQL\Entities\User\Queries;

use App\GraphQL\Queries\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\SelectFields;
use GraphQL\Type\Definition\Type;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;

class UsersQuery extends Query
{

    protected $attributes = [
        'name'  => 'users',
    ];

    public function __construct()
    {
        $this->paginate = true;
        $this->rules = [
            'ids' => [
                'array',
            ],
            'ids.*' => [
                'numeric',
            ]
        ];

        $this->args = [
            'ids'   => [
                'name' => 'ids',
                'type' => Type::listOf(Type::int()),
            ]
        ];
        $this->type = GraphQL::paginate(GraphQL::type('User'));
    }

    public function resolve($root, $args, $context, ResolveInfo $info, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $users = User::query();
        if (isset($args['ids'])) {
            $users->find($args['ids']);
        }
        $users->with($fields->getRelations())
            ->select($fields->getSelect());
        
        $users = $this->basePaginate($users,$args);

        return $users;
    }
}
