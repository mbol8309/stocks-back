<?php

namespace App\GraphQL\Entities\Measures;

use App\GraphQL\Entities\BaseEntity;
use App\GraphQL\Entities\Measures\Queries\MeasuresTypesQuery;
use App\GraphQL\Entities\Measures\Queries\MeasureTypeQuery;
use App\GraphQL\Entities\Measures\Types\MeasuresTypesType;

class MeasuresEntity extends BaseEntity
{
    public static function getEntity(): array
    {
        return [
            'default' => [
                'query' => [
                    'measuretype' => MeasureTypeQuery::class,
                    'measurestypes' => MeasuresTypesQuery::class,
                ],
                'mutation' => [
                    //'createCategory' => CreateCategoryMutation::class,
                ],
                'types' => [
                    
                ],
                'middleware' => ['auth:api'],
                'method' => ['get', 'post'],
        
            ]
        ];
    }

    public static function getTypes(): array
    {
        return [
            MeasuresTypesType::class
        ];
    }
}
