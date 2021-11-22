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

    public function __construct()
    {
        $this->paginate=true;
        $this->rules = [];

        $this->args = [];
        $this->type = GraphQL::paginate(GraphQL::type('Category'));
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
        return $this->basePaginate(Category::query());//whereIn('id',$ids)->get();
    }

}