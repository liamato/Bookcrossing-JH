<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\School;
use App\Category;


class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        factory(Post::class, 150)->create()->each(function($p){
            School::find(rand(1, 5))->posts()->save($p);
            $sCategories = Category::where('school_id', $p->school->id)->get(['id']);
            Category::find($sCategories[rand(1, count($sCategories))-1]->id)->posts()->save($p);
            if ((bool)rand(0,1)){
                if ((bool)rand(0,1)){
                    $sPosts = Post::where('school_id', $p->school->id)->get(['id']);
                    $p->parent = $sPosts[rand(1, count($sPosts))-1]->id;
                    $p->save();
                    
                }
            }
        });
    }
}
