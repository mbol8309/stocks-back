<?php
namespace App\GraphQL\Entities\Category\Queries;

use App\GraphQL\Queries\Query;
use App\Models\Context;
use Rinvex\Categories\Models\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CategoriesQuery extends Query {

    protected $attributes = [
        'name'  => 'categories',
    ];

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        return true;
    }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Category')); //retrieve a single user
    }

    protected function rules(array $args = []): array
    {
        return [
        ];
    }

    public function args(): array
    {
        return [
        ];
    }

    public function resolve($root, $args, $user, ?SelectFields $fields)
    {
        $user = Auth::user();
        $ids = [];
        if ($user !=null){
            $context = Context::find($user->context_id);
            /*if ($context != null){
                $bc = $context->BaseCategory();
                $ids = $bc->descendants()->select('id')->get();
            }*/

        }
        return Category::all();//whereIn('id',$ids)->get();
    }

}