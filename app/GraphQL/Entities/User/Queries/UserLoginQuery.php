<?php

namespace App\GraphQL\Entities\User\Queries;

use App\GraphQL\Queries\Query;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Hash;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UserLoginQuery extends Query
{

    protected $attributes = [
        'name'  => 'user',
    ];

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        return true;
    }

    public function type(): Type
    {
        return GraphQL::type('User'); //retrieve a single user
    }

    protected function rules(array $args = []): array
    {
        return [
            'email' => [
                'required',
                'string',
                'min:1',
            ],
            'password' => [
                'required',
                'string'
            ]
        ];
    }

    public function args(): array
    {
        return [
            'email'    => [
                'name' => 'email',
                'type' => Type::string(),
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::string()
            ]
        ];
    }

    public function resolve($root, $args, ?SelectFields $fields)
    {
        $user = User::where('email', $args['email'])->first();
        if ($user && Hash::check($args['password'], $user->password)) {
            $user['token'] = $user->createToken('access')->accessToken;
            return $user;
        }
    }
}
