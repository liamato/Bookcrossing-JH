<?php

use Illuminate\Database\Seeder;
use App\Video;
use App\School;

class VideosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Video::class, 30)->create()->each(function($v){
        	School::find(rand(1, 5))->videos()->save($v);
        });
    }
}
