<?php

namespace App\GraphQL\Entities\User\Mutations;

use App\GraphQL\Mutations\Mutation;
use App\Models\Context;
use App\Models\Role;
use App\Models\Team;
use GraphQL\Type\Definition\Type;
use Illuminate\Validation\Rule;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\DB;
use Rebing\GraphQL\Support\Facades\GraphQL;

class RegisterUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'registerUser'
    ];

    public function __construct()
    {
        $this->rules = [
            'name' => [
                'required', 'max:50', 'min:5'
            ],
            'email' => [
                'required', 'email', 'unique:users,email',
            ],
            'password' => [
                'required', 'string', 'min:5', 'confirmed'
            ],
            'password_confirmation' => [
                'required', 'string', 'min:5'
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
            'password_confirmation' => [
                'name' => 'password_confirmation',
                'type' =>  Type::nonNull(Type::string()),
            ]
        ];
        $this->type = GraphQL::type('User');
    }

    public function resolve($root, $args)
    {
        $user = null;
        DB::transaction(function () use ($args, &$user) {
            $user = new User();
            $user->fill($args);
            $user->save();
            $context = new Context([
                'name' => $user->name . '_context'
            ]);
            $context->save();
            $user->context()->associate($context->id);
            $role = Role::AdminRole();
            $team = Team::find($context->team_id);

            $user->attachRole($role, $team);
            return $user;
        });

        if ($user) {
            $user['token'] = $user->createToken('access')->accessToken;
        }

        return $user;
    }

    public function validationErrorMessages(array $args = []): array
{
    return [
        'password.confirmed' => 'Password must be confirmed',
    ];
}
 
}
