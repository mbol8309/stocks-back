<?php

namespace App\GraphQL\Entities\User\Mutations;

use App\GraphQL\Mutations\Mutation;
use GraphQL\Type\Definition\Type;
use Illuminate\Validation\Rule;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UpdateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateUser'
    ];

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        return true;
    }

    public function rules(array $args = []): array
    {
        return [
            'id' => [
                'required', 'numeric', 'min:1', 'exists:users,id'
            ],
            'name' => [
                'required', 'max:50'
            ],
            'email' => [
                'required', 'email', 'unique:users,email,' . $args['id'],
            ],
            'password' => [
                'sometimes', 'string', 'min:5'
            ],
            'categories' => [
                'sometimes', 'array', 'exists:categories,id'
            ]
        ];
    }

    public function type(): Type
    {
        return GraphQL::type('User');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' =>  Type::nonNull(Type::int()),
            ],
            'name' => [
                'name' => 'name',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'email' => [
                'name' => 'email',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'password' => [
                'name' => 'App\GraphQL\Entities\Userpassword',
                'type' =>  Type::string(),
            ],
            'categories' => [
                'name' => 'categories',
                'type' => Type::listOf(Type::int())
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $user = User::findOrFail($args['id']);
        $user->fill($args);

        if (isset($args['categories']))
        {
            $user->syncCategories($args['categories']);
        }
        $user->save();

        return $user;
    }
}
