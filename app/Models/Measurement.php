<?php

namespace App\Models;

use App\Traits\useContext;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Measurement extends Model
{
    use HasFactory, SoftDeletes, useContext;

    protected $fillable = ['name','symbol','base_multiplier','measurementtype_id'];

    public function type()
    {
        return $this->belongsTo(MeasurementType::class,'measurementtype_id');
    }
}
