<?php
namespace App\GraphQL\Queries;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Query as BaseQuery;

abstract class Query extends BaseQuery
{
    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        return false;
    }
}