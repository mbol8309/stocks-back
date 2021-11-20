<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Rinvex\Categories\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();
        foreach($categories as $cat)
        {
            if ($cat->root_id == null && $cat->parent_id !=null)
            {
                $root = Category::find($cat->parent_id);
                while($root->parent_id!=null)
                {
                    $root = Category::find($root->parent_id);
                }
                $cat->root_id = $root->id;
                $cat->save();

            }
        }
    }
}
