<?php

namespace App\GraphQL\Entities;

abstract class BaseEntity
{
    public static function getEntity(): array
    {
        return [];
    }

    public static function getTypes(): array
    {
        return [];
    }
}
