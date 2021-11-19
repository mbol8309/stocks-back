<?php
namespace App\GraphQL\Entities\User\Queries;

use App\GraphQL\Queries\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\SelectFields;
use GraphQL\Type\Definition\Type;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;

class UsersQuery extends Query {

    protected $attributes = [
        'name'  => 'users',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('User')); //retrieve a collection of users
    }

    public function args():array
    {
        return [
            'ids'   => [
                'name' => 'ids',
                'type' => Type::listOf(Type::int()),
            ],
        ];
    }

    protected function rules(array $args = []): array
    {
        return [
            'ids' => [
                'array',
            ],
            'ids.*' => [
                'numeric',
            ]
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['ids'])) {
            return User::find($args['ids']);
        }

        return User::all();
    }
}