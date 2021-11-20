<?php 
namespace App\GraphQL\Entities\User\Types;

use App\Models\Context;
use App\Models\Role;
use GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL as FacadesGraphQL;

class ContextType extends GraphQLType {

    protected $attributes = [
        'name'          => 'Context', //defining the GraphQL type name
        'description'   => 'Contexts', //providing a description for the GraphQL type name
        'model'         => Context::class, //mapping the GraphQL type to the Laravel model
        
    ];

    public function fields(): array
    {
        return [
            'id' => [
                //defining the id field as a non-null integer
                'type'          => Type::nonNull(Type::int()),
                'description'   => 'ID of the role',
            ],
            'name' => [
                //defining the name field as a non-null string
                'type'          => Type::string(),
                'description'   => 'Name of the role',
            ]
        ];
    }
}