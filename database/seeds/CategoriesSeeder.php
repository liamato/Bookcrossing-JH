<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\School;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 30)->create()->each(function($c){
        	School::find(rand(1, 5))->categories()->save($c);
        });
    }
}
