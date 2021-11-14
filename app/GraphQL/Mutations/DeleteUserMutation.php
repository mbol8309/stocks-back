<?php
namespace App\GraphQL\Mutations;

use GraphQL;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;

class DeleteUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteUser',
        'description' => 'Delete a user'
    ];
    
    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        return true;
    }
    
    public function type() :Type
    {
        return Type::boolean();
    }

    public function rules(array $args = []):array
    {
        return [
            'id' => [
                'required', 'numeric', 'min:1', 'exists:users,id'
            ],
        ];
    }

    public function args():array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $user = User::findOrFail($args['id']);

        return  $user->delete() ? true : false;
    }
}