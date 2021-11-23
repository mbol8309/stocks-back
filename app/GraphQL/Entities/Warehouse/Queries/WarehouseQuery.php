<?php

namespace App\GraphQL\Entities\Warehouse\Queries;

use App\GraphQL\Queries\Query;
use Rinvex\Categories\Models\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\User;
use App\Models\Warehouse;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class WarehouseQuery extends Query
{

    protected $attributes = [
        'name'  => 'warehouse',
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
        $this->type = GraphQL::type('Warehouse');
    }

    public function resolve($root, $args, $user, ?SelectFields $fields)
    {
        return Warehouse::findOrFail($args['id']);
    }
}
