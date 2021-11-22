<?php
namespace App\GraphQL\Entities\User\Mutations;

use App\GraphQL\Mutations\Mutation;
use GraphQL;

use GraphQL\Type\Definition\Type;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;

class DeleteUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteUser',
        'description' => 'Delete a user'
    ];

    public function __construct()
    {
        $this->rules = [
            'id' => [
                'required', 'numeric', 'min:1', 'exists:users,id'
            ],
        ];

        $this->args = [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ]
        ];
        $this->type = Type::boolean();
    }

    public function resolve($root, $args)
    {
        $user = User::findOrFail($args['id']);

        return  $user->delete() ? true : false;
    }
}