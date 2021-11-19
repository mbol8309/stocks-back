<?php
namespace App\GraphQL\Entities\Category\Types;

use Rinvex\Categories\Models\Category;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\User;
use GraphQL\GraphQL as GraphQLGraphQL;
use Rebing\GraphQL\GraphQL as RebingGraphQLGraphQL;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CategoryType extends GraphQLType {

    protected $attributes = [
        'name'          => 'Category', //defining the GraphQL type name
        'description'   => 'A Category', //providing a description for the GraphQL type name
        'model'         => Category::class, //mapping the GraphQL type to the Laravel model
    ];

    public function fields(): array
    {
        return [
            'id' => [
                //defining the id field as a non-null integer
                'type'          => Type::nonNull(Type::int()),
                'description'   => 'ID of the category',
            ],
            'name' => [
                //defining the name field as a non-null string
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'Name of the category',
            ],
            'parent' => [
                //defining the email field as a non-null string
                'type'          => GraphQL::type('Category'),
                'description'   => 'Parent category',
            ],
            'children' => [
                'type'      =>  Type::listOf(GraphQL::type('Category'))
            ]
        ];
    }
}