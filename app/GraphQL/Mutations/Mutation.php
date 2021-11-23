<?php
namespace App\GraphQL\Mutations;

use App\GraphQL\Queries\Query;
use GraphQL\Type\Definition\ResolveInfo;
use Closure;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation as SupportMutation;

abstract class Mutation extends SupportMutation
{

    protected $rules = [];
    protected $args = [];
    protected bool $paginate = false;
    protected $type = null;

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        return true;
    }

    public static function paginate_rules()
    {
        return [
            'page' => ['numeric'],
            'limit' => ['numeric']
        ];
    }

    public static function paginate_args()
    {

        return [
            'page'   => [
                'name' => 'page',
                'type' => Type::int(),
            ],
            'limit'   => [
                'name' => 'limit',
                'type' => Type::int(),
            ]
        ];
    }

    protected function rules(array $args = []): array
    {
        return $this->paginate ?
            array_merge($this->rules, static::paginate_rules())
            : $this->rules;
    }

    public function args(): array
    {
        return $this->paginate ?
            array_merge($this->args, static::paginate_args())
            : $this->args;
    }

    public function type(): Type
    {
        return $this->type ? $this->type : Type::string(); //retrieve a collection of users
    }

    public function basePaginate($query,$args=['limit'=>10,'page'=>0])
    {
        return $query->paginate($args['limit'], ['*'], 'page', $args['page']);
    }
    
}