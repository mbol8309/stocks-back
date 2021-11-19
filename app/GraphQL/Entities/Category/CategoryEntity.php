<?php

namespace App\GraphQL\Entities\Category;

use App\GraphQL\Entities\BaseEntity;
use App\GraphQL\Entities\Category\Mutations\CreateCategoryMutation;
use App\GraphQL\Entities\Category\Queries\CategoriesQuery;
use App\GraphQL\Entities\Category\Queries\CategoryQuery;
use App\GraphQL\Entities\Category\Types\CategoryType;

class CategoryEntity extends BaseEntity
{
    public static function getEntity(): array
    {
        return [
            'default' => [
                'query' => [
                    'category' => CategoryQuery::class,
                    'categories' => CategoriesQuery::class,
                ],
                'mutation' => [
                    'createCategory' => CreateCategoryMutation::class,
                ],
                'types' => [
                    
                ],
                'middleware' => ['auth:api'],
                'method' => ['get', 'post'],
        
            ]
        ];
    }

    public static function getTypes(): array
    {
        return [
            CategoryType::class
        ];
    }
}
