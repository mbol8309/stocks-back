<?php

namespace App\GraphQL\Entities\User\Mutations;

use App\GraphQL\Exceptions\StocksExceptions;
use App\GraphQL\Queries\Query;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\User;
use Closure;
use Exception;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UserLoginMutation extends Query
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
            'username' => [
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
            'username'    => [
                'name' => 'username',
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
        $user = User::where('email', $args['username'])->first();
        if ($user && Hash::check($args['password'], $user->password)) {
            $user['token'] = $user->createToken('access')->accessToken;
            return $user;
        } else {
            throw new StocksExceptions('Bad user or password');
        }
        
    }
}
