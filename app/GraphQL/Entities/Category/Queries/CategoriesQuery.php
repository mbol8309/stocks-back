<?php
namespace App\GraphQL\Entities\Category\Queries;

use App\GraphQL\Queries\Query;
use Rinvex\Categories\Models\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CategoriesQuery extends Query {

    protected $attributes = [
        'name'  => 'categories',
    ];

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        return true;
    }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Category')); //retrieve a single user
    }

    protected function rules(array $args = []): array
    {
        return [
        ];
    }

    public function args(): array
    {
        return [
        ];
    }

    public function resolve($root, $args, $user, ?SelectFields $fields)
    {
        return Category::all();
    }

}