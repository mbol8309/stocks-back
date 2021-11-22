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

class CreateCategoryMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createCategory'
    ];

    public function __construct()
    {
        $this->rules = [
            'name' => [
                'required', 'max:50'
            ],
            'parent' => [
                'integer', 'exists:categories,id'
            ]
        ];

        $this->args = [
            'name' => [
                'name' => 'name',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'parent' => [
                'name' => 'parent',
                'type' => Type::int(),
            ]
        ];
        $this->type = GraphQL::type('Category');
    }

    public function resolve($root, $args)
    {
        $category = new Category();
        $category->fill($args);

        if (isset($args['parent'])) {
            $category->parent_id = $args['parent'];
        } else {
            $category->makeRoot();
        }

        $category->save();

        return $category;
    }
}
