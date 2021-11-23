<?php

namespace App\GraphQL\Entities\User\Mutations;

use App\GraphQL\Mutations\Mutation;
use App\Models\Context;
use GraphQL\Type\Definition\Type;
use Illuminate\Validation\Rule;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\DB;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createUser'
    ];

    public function __construct()
    {
        $this->rules = [
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
            ],
            'context' => [
                'sometimes', 'numeric'
            ]
        ];

        $this->args = [
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
                'name' => 'categories',
                'type' => Type::listOf(Type::int())
            ],
            'context' => [
                'name' => 'context',
                'type' => Type::int()
            ]
        ];
        $this->type = GraphQL::type('User');
    }

    public function resolve($root, $args, $authuser)
    {
        $user = null;
        DB::transaction(function () use ($args, &$user, $authuser) {
            $user = new User();
            $user->fill($args);
            $user->save();
            if (isset($args['categories'])) {
                $user->syncCategories($args['categories']);
            }
            if ($authuser->context->name == 'global') {
                if (isset($args['context'])){
                    $c = Context::findOrFail($args['context']);
                    $user->context()->associate($c->id);
                } else {
                    $context = new Context([
                        'name' => $user->name . '_context'
                    ]);
                    $context->save();
                    $user->context()->associate($context->id);
                }
            } else {
                $user->context()->associate($authuser->context->id);
            }
        });

        return $user;
    }
}
