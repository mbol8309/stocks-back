<?php

namespace App\Models;

use App\Scope\CategoryScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rinvex\Categories\Models\Category;
use Rinvex\Categories\Traits\Categorizable;

class Context extends Model
{
    use HasFactory, SoftDeletes, Categorizable;

    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class, 'context_id', 'id');
    }

    public function BaseCategory()
    {
        return $this->categories()->first();
    }

    public function team(){
        return $this->belongsTo(Team::class,'team_id');
    }

    public static function globalContext()
    {
        return Context::where('name','global')->first();
    }
}

Context::saved(function (Context $context) {
    //new context created, create base structure
    
    if ($context->BaseCategory() == null) {
        //base Category

        //$rid = Context::globalContext()->BaseCategory();
        $c = new Category([
            'name' => 'RootCategory-' . $context->id,
        ]);
        $c->saveAsRoot();
        $context->attachCategories($c->id);
    }

    if ($context->team == null){
        $team = new Team([
            'name' => 'rootteam-'.$context->id,
            'description' => 'Base team for context',
            'display_name' => "RootTeam({$context->id})"
        ]);
        $team->save();
        $context->team_id = $team->id;
    }
    $context->saveQuietly();
    
});
Category::addGlobalScope(new CategoryScope);
