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

class DeleteWarehouseMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteWarehouse'
    ];

    public function __construct()
    {
        $this->rules = [
            'id' => [
                'required','exists:warehouses,id'
            ],
        ];

        $this->args = [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
            ],
        ];
        $this->type = Type::boolean();
    }

    public function resolve($root, $args, $user)
    {
        $warehouse = Warehouse::findOrFail($args['id']);

        return $warehouse->delete() ? true : false;
    }
}
