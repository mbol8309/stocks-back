<?php
namespace App\GraphQL\Entities\User\Queries;

use App\GraphQL\Queries\Query;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UserQuery extends Query {

    protected $attributes = [
        'name'  => 'user',
    ];

    public function __construct()
    {
        $this->rules = [
            'id' => [
                'required',
                'numeric',
                'min:1',
                'exists:users,id'
            ]
        ];

        $this->args = [
            'id'    => [
                'name' => 'id',
                'type' => Type::int(),
            ]
        ];
        $this->type = GraphQL::type('User');
    }

    public function resolve($root, $args, User $user, ?SelectFields $fields)
    {   
        return User::findOrFail($args['id']);
    }

}