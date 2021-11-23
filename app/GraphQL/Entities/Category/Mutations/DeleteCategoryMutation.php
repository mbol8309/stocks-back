<?php

namespace App\GraphQL\Entities\Category\Mutations;

use App\GraphQL\Mutations\Mutation;
use GraphQL\Type\Definition\Type;
use Illuminate\Validation\Rule;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rinvex\Categories\Models\Category;

class DeleteCategoryMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteCategory'
    ];

    public function __construct()
    {
        $this->rules = [
            'id' => [
                'required', 'exists:categories,id'
            ]
        ];

        $this->args = [
            'id'=> [
                'name'=>'id',
                'type' => Type::int(),
            ]
        ];
        $this->type = Type::boolean();
    }

    public function resolve($root, $args)
    {
        $category = Category::findOrFail($args['id']);

        return $category->delete() ? true : false;
    }
}
