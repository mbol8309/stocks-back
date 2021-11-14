<?php
namespace App\GraphQL\Queries;

use App\Models\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CategoryQuery extends Query {

    protected $attributes = [
        'name'  => 'category',
    ];

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        return true;
    }

    public function type(): Type
    {
        return GraphQL::type('Category'); //retrieve a single user
    }

    protected function rules(array $args = []): array
    {
        return [
            'id' => [
                'required',
                'numeric',
                'min:1',
                'exists:categories,id'
            ],
        ];
    }

    public function args(): array
    {
        return [
            'id'    => [
                'name' => 'id',
                'type' => Type::int(),
            ],
        ];
    }

    public function resolve($root, $args, ?SelectFields $fields)
    {
        return Category::findOrFail($args['id']);
    }

}