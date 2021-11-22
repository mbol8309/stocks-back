<?php

namespace App\GraphQL\Entities\Measures\Queries;

use App\GraphQL\Queries\Query;
use App\Models\MeasurementType;
use Rinvex\Categories\Models\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class MeasureTypeQuery extends Query
{

    protected $attributes = [
        'name'  => 'measuretype',
    ];

    public function __construct()
    {
        $this->rules = [
            'id' => [
                'required', 'numeric'
            ]
        ];

        $this->args = [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ]
        ];
        $this->type = GraphQL::type('MeasureType');
    }

    public function resolve($root, $args, $user, ?SelectFields $fields)
    {
         
        $m = MeasurementType::findOrFail($args['id']);
        return $m;
    }
}
