<?php

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;
use phpDocumentor\Reflection\Types\Null_;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'parent'
    ];

    public function includeParent(?Category $category=null)
    {
        if ($category==null) return null;

        return $this->item($category->parent, $this);
    }
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(?Category $category=null)
    {
        if ($category==null) return [];

        return [
            'id'=>$category->id,
            'name'=>$category->name,
            'parent_id'=>$category->parent_id,
            'created_at'=>$category->created_at,
            'updated_at'=>$category->updated_at
            //
        ];
    }
}
