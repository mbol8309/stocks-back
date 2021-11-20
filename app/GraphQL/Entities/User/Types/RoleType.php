<?php 
namespace App\GraphQL\Entities\User\Types;

use App\Models\Role;
use GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL as FacadesGraphQL;

class RoleType extends GraphQLType {

    protected $attributes = [
        'name'          => 'Role', //defining the GraphQL type name
        'description'   => 'Roles', //providing a description for the GraphQL type name
        'model'         => Role::class, //mapping the GraphQL type to the Laravel model
        
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
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'Name of the role',
            ],
            'display_name' => [
                //defining the name field as a non-null string
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'Name of the role',
            ],
            'description' => [
                //defining the email field as a non-null string
                'type'          => Type::string(),
                'description'   => 'Description of role',
            ]
        ];
    }
}