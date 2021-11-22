<?php

namespace App\GraphQL\Entities\Category\Queries;

use App\GraphQL\Queries\Query;
use Rinvex\Categories\Models\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CategoryQuery extends Query
{

    protected $attributes = [
        'name'  => 'category',
    ];

    public function __construct()
    {
        $this->rules = [
            'id' => [
                'required',
                'numeric',
                'min:1'
            ],
        ];

        $this->args = [
            'id'    => [
                'name' => 'id',
                'type' => Type::int(),
            ],
        ];
        $this->type = GraphQL::type('Category');
    }

    public function resolve($root, $args, $user, ?SelectFields $fields)
    {
        return Category::findOrFail($args['id']);
    }
}
