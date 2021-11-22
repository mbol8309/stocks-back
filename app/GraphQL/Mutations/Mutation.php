<?php
namespace App\GraphQL\Mutations;

use App\GraphQL\Queries\Query;
use GraphQL\Type\Definition\ResolveInfo;
use Closure;
use Rebing\GraphQL\Support\Mutation as SupportMutation;

abstract class Mutation extends Query
{

    protected $rules = [];
    protected $args = [];
    protected bool $paginate = false;
    protected $type = null;

    public function authorize($root, array $args, $ctx, ?ResolveInfo $resolveInfo = null, ?Closure $getSelectFields = null): bool
    {
        return true;
    }
    
}