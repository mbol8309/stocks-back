<?php

namespace App\Models;

use App\Traits\useContext;
use Laratrust\Models\LaratrustTeam;

class Team extends LaratrustTeam
{
    public $guarded = [];

    public function context()
    {
        return $this->hasOne(Context::class,'team_id');
    }

}
