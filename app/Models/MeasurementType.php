<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeasurementType extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'symbol'];

    public function measures()
    {
        return $this->hasMany(Measurement::class,'measurementtype_id','id');
    }
}
