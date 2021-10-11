<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category([
            'name' => 'Audio'
        ]);
        $category->save();

        $category2 = new Category([
            'name' => 'Reproductoras'
        ]);
        $category2->parent()->associate($category);
        $category2->save();
        

    }
}
