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

class MeasuresTypesQuery extends Query
{

    protected $attributes = [
        'name'  => 'measurestypes',
    ];
    public function __construct()
    {
        $this->paginate = true;
        $this->rules = [
            'ids' => [
                'array',
            ],
            'ids.*' => [
                'numeric',
            ]
        ];

        $this->args = [
            'ids'   => [
                'name' => 'ids',
                'type' => Type::listOf(Type::int()),
            ]
        ];
        $this->type = GraphQL::paginate(GraphQL::type('MeasureType'));
    }

    public function resolve($root, $args, $user, ?SelectFields $fields)
    {

        $measures = MeasurementType::query();
        if (isset($args['ids'])) {
            $measures->with($fields->getRelations())
            ->select($fields->getSelect())->whereIn('id',$args['ids']);
        } else {
            $measures->with($fields->getRelations())
            ->select($fields->getSelect());
        }

        $measures = $this->basePaginate($measures, $args);
        return $measures;
    }
}
