<?php
namespace App\GraphQL\Entities\Measures\Types;

use App\GraphQL\Entities\Category\CategoryResolver;
use App\Models\MeasurementType;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\User;
use Rebing\GraphQL\Support\Facades\GraphQL;

class MeasuresTypesType extends GraphQLType {

    protected $attributes = [
        'name'          => 'MeasureType', //defining the GraphQL type name
        'description'   => 'A measure type', //providing a description for the GraphQL type name
        'model'         => MeasurementType::class, //mapping the GraphQL type to the Laravel model
    ];

    public function fields(): array
    {
        return [
            'id' => [
                //defining the id field as a non-null integer
                'type'          => Type::nonNull(Type::int()),
                'description'   => 'ID of the measure type',
            ],
            'name' => [
                //defining the name field as a non-null string
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'Name of the measure type',
            ],
            'symbol' => [
                //defining the email field as a non-null string
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'symbol of the measure type',
            ]
        ];
    }
}