<?php

namespace App\GraphQL\Entities\User;

use App\GraphQL\Entities\BaseEntity;
use App\GraphQL\Entities\User\Mutations\CreateUserMutation;
use App\GraphQL\Entities\User\Mutations\DeleteUserMutation;
use App\GraphQL\Entities\User\Mutations\RegisterUserMutation;
use App\GraphQL\Entities\User\Mutations\UpdateUserMutation;
use App\GraphQL\Entities\User\Queries\UserLoginQuery;
use App\GraphQL\Entities\User\Queries\UserMeQuery;
use App\GraphQL\Entities\User\Queries\UserQuery;
use App\GraphQL\Entities\User\Queries\UsersQuery;
use App\GraphQL\Entities\User\Types\ContextType;
use App\GraphQL\Entities\User\Types\RoleType;
use App\GraphQL\Entities\User\Types\UserType;

class UserEntity extends BaseEntity
{
    public static function getEntity(): array
    {
        return [
            'default' => [
                'query' => [
                    //retrieve a single user
                    'user' => UserQuery::class,
                    'me' => UserMeQuery::class,
                    //retrieve a collection of users
                    'users' => UsersQuery::class,
                ],
                'mutation' => [
                    //create a user
                    'createUser' => CreateUserMutation::class,
                    //update a user
                    'updateUser' => UpdateUserMutation::class,
                    //delete a user
                    'deleteUser' => DeleteUserMutation::class,
                ],
                'types' => [
                    
                ],
                'middleware' => ['auth:api'],
            ],
            'login' => [
                'query' => [
                    'login' => UserLoginQuery::class,
                ],
                'mutation' => [
                    'registerUser' => RegisterUserMutation::class
                ],
                'types' => [],
                'middleware' => ['api'],
            ],
            'method' => ['get', 'post'],
        ];
    }

    public static function getTypes(): array
    {
        return [
            UserType::class,
            RoleType::class,
            ContextType::class
        ];
    }
}
