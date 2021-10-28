<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Transformers\CategoryTransformer;
use Illuminate\Http\Request;
use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Serializer\DataArraySerializer;

class CategoryController extends BaseController
{
    protected $Model = Category::class;
    protected $Transformer = CategoryTransformer::class;
    protected $Request = CategoryRequest::class;
}
