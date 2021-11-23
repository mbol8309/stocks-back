<?php

namespace App\Models;

use App\Traits\useContext;
use Facade\FlareClient\Concerns\HasContext;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use HasFactory, useContext, SoftDeletes;

    protected $fillable = ['name','location','capacity','parent_id','context_id'];

    public function parent()
    {
        return $this->belongsTo(Warehouse::class,'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Warehouse::class,'parent_id','id');
    }
}
