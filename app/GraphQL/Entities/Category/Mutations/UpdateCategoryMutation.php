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

class UpdateCategoryMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateCategory'
    ];

    public function __construct()
    {
        $this->rules = [
            'id' => [
                'required', 'exists:categories,id'
            ],
            'name' => [
                'required', 'max:50'
            ],
            'parent' => [
                'integer', 'exists:categories,id'
            ]
        ];

        $this->args = [
            'id'=> [
                'name'=>'id',
                'type' => Type::int(),
            ],
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
        $category = Category::findOrFail($args['id']);
        $category->update($args);

        if (isset($args['parent'])) {
            $category->parent_id = $args['parent'];
        } else {
            $category->makeRoot();
        }
        $category->save();

        return $category;
    }
}
