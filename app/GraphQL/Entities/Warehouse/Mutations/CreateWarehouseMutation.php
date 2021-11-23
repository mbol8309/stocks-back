<?php

namespace App\GraphQL\Entities\Warehouse\Mutations;

use App\GraphQL\Mutations\Mutation;
use GraphQL\Type\Definition\Type;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Warehouse;
use App\Rules\SameContext;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rinvex\Categories\Models\Category;

class CreateWarehouseMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createWarehouse'
    ];

    public function __construct()
    {
        $this->rules = [
            'name' => [
                'required', 'max:50'
            ],
            'location' => [
                'string'
            ],
            'capacity' => [
                'numeric'
            ],
            'parent' => [
                'integer', 'exists:warehouses,id', new SameContext('warehouses')
            ]
        ];

        $this->args = [
            'name' => [
                'name' => 'name',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'location' => [
                'name' => 'location',
                'type' => Type::string(),
            ],
            'capacity' => [
                'name' => 'capacity',
                'type' => Type::int(),
            ],
            'parent' => [
                'name' => 'parent',
                'type' => Type::int(),
            ]
        ];
        $this->type = GraphQL::type('Warehouse');
    }

    public function resolve($root, $args, $user)
    {
        $warehouse = new Warehouse();
        $warehouse->fill($args);

        if (isset($args['parent'])) {
            $warehouse->parent_id = $args['parent'];
        }
        $warehouse->context_id = $user->context_id;

        $warehouse->save();

        return $warehouse;
    }
}
