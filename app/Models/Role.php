<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];

    public static function AdminRole()
    {
        return Role::where('name', 'admin')->first();
    }
}
