<?php
namespace App\GraphQL\Entities\Warehouse\Types;

use App\GraphQL\Entities\Category\CategoryResolver;
use App\GraphQL\Entities\User\Types\UserType;
use Rinvex\Categories\Models\Category;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\User;
use App\Models\Warehouse;
use GraphQL\GraphQL as GraphQLGraphQL;
use Rebing\GraphQL\GraphQL as RebingGraphQLGraphQL;
use Rebing\GraphQL\Support\Facades\GraphQL;

class WarehouseType extends GraphQLType {

    protected $attributes = [
        'name'          => 'Warehouse', //defining the GraphQL type name
        'description'   => 'A warehouse', //providing a description for the GraphQL type name
        'model'         => Warehouse::class, //mapping the GraphQL type to the Laravel model
    ];

    public function fields(): array
    {
        return [
            'id' => [
                //defining the id field as a non-null integer
                'type'          => Type::nonNull(Type::int()),
                'description'   => 'ID of the warehouse',
            ],
            'name' => [
                //defining the name field as a non-null string
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'Name of the warehouse',
            ],
            'location' => [
                //defining the name field as a non-null string
                'type'          => Type::string(),
                'description'   => 'Location of warehouse',
            ],
            'capacity' => [
                //defining the name field as a non-null string
                'type'          => Type::int(),
                'description'   => 'Capacity of warehouse',
            ],
            'parent' => [
                //defining the email field as a non-null string
                'type'          => GraphQL::type('Warehouse'),
                'description'   => 'Parent warehouse',
            ],
            'children' => [
                'type'      =>  Type::listOf(GraphQL::type('Warehouse')),
                'description' =>    'Children warehouses'
            ],
            'context' => [
                'type'  => GraphQL::type('Context'),
                'description'   => 'Context who belongs'
            ]
        ];
    }
}