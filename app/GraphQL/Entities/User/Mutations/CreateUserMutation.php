<?php
namespace App\GraphQL\Entities\User\Mutations;

use App\GraphQL\Mutations\Mutation;
use GraphQL\Type\Definition\Type;
use Illuminate\Validation\Rule;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createUser'
    ];

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        return true;
    }

    public function rules(array $args = []):array
    {
        return [
            'name' => [
                'required', 'max:50'
            ],
            'email' => [
                'required', 'email', 'unique:users,email',
            ],
            'password' => [
                'required', 'string', 'min:5'
            ],
            'categories' => [
                'sometimes', 'array', 'exists:categories,id'
            ]
        ];
    }

    public function type() : Type
    {
        return GraphQL::type('User');
    }

    public function args():array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'email' => [
                'name' => 'email',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'password' => [
                'name' => 'password',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'categories' => [
                'name' => 'Categories',
                'type' => Type::listOf(GraphQL::type('Category'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $user = new User();
        $user->fill($args);
        $user->save();
        if (isset($args['categories']))
        {
            $user->syncCategories($args['categories']);
        }

        return $user;
    }
}