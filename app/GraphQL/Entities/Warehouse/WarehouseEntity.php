<?php

namespace App\GraphQL\Entities\Warehouse;

use App\GraphQL\Entities\BaseEntity;
use App\GraphQL\Entities\Warehouse\Mutations\CreateWarehouseMutation;
use App\GraphQL\Entities\Warehouse\Mutations\DeleteWarehouseMutation;
use App\GraphQL\Entities\Warehouse\Mutations\UpdateWarehouseMutation;
use App\GraphQL\Entities\Warehouse\Queries\WarehouseQuery;
use App\GraphQL\Entities\Warehouse\Queries\WarehousesQuery;
use App\GraphQL\Entities\Warehouse\Types\WarehouseType;

class WarehouseEntity extends BaseEntity
{
    public static function getEntity(): array
    {
        return [
            'default' => [
                'query' => [
                    'warehouse' => WarehouseQuery::class,
                    'warehouses' => WarehousesQuery::class,
                ],
                'mutation' => [
                    'createWarehouse' => CreateWarehouseMutation::class,
                    'updateWarehouse' => UpdateWarehouseMutation::class,
                    'deleteWarehouse' => DeleteWarehouseMutation::class
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
            WarehouseType::class
        ];
    }
}
