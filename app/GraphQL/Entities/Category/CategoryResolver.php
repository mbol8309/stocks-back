<?php
namespace App\GraphQL\Entities\Category;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Field;

class CategoryResolver extends Field
{
    protected $attributes = [
        'description' => 'List of items who belong',
        'is_relation' => false
    ];

    public function __construct(array $settings = [])
    {
        $this->attributes = \array_merge($this->attributes, $settings);
    }

    public function type(): Type
    {
        $type =  $this->attributes['type'] ? $this->attributes['type'] : Type::string();  
        return Type::listOf(GraphQL::type($type));
    }

    public function args(): array
    {
        return [
        ];
    }

    protected function resolve($root, array $args)
    {
        $class = $this->attributes['class'] ?? $this->attributes['class'];
        if ($class == null) return null;

        $list = $root->entries($class)->get();
       
        

        return $list;
    }

}