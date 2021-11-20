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

class MeasuresTypesQuery extends Query {

    protected $attributes = [
        'name'  => 'measurestypes',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('MeasureType')); 
    }

    protected function rules(array $args = []): array
    {
        return [
            'ids' => [
                'array',
            ],
            'ids.*' => [
                'numeric',
            ]
        ];
    }

    public function args(): array
    {
        return [
            'ids'   => [
                'name' => 'ids',
                'type' => Type::listOf(Type::int()),
            ],
        ];
    }

    public function resolve($root, $args, $user, ?SelectFields $fields)
    {
        if (isset($args['ids'])) {
            return MeasurementType::find($args['ids']);
        } else {
            return MeasurementType::all();
        }
    }

}