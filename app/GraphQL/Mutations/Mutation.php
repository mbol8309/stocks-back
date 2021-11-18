<?php
namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Closure;
use Rebing\GraphQL\Support\Mutation as SupportMutation;

abstract class Mutation extends SupportMutation
{
    public function authorize($root, array $args, $ctx, ?ResolveInfo $resolveInfo = null, ?Closure $getSelectFields = null): bool
    {
        return false;
    }
}