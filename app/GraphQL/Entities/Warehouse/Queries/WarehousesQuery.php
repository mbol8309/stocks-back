<?php
namespace App\GraphQL\Entities\Warehouse\Queries;

use App\GraphQL\Queries\Query;
use App\Models\Context;
use Rinvex\Categories\Models\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\User;
use App\Models\Warehouse;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;

class WarehousesQuery extends Query {

    protected $attributes = [
        'name'  => 'warehouses',
    ];

    public function __construct()
    {
        $this->paginate=true;
        $this->rules = [];

        $this->args = [];
        $this->type = GraphQL::paginate(GraphQL::type('Warehouse'));
    }

    public function resolve($root, $args, $user, ?SelectFields $fields)
    {
        
        return $this->basePaginate(Warehouse::query());//whereIn('id',$ids)->get();
    }

}