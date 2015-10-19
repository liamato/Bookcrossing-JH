<?php

use Illuminate\Database\Seeder;
use App\Report;
use App\School;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Report::class, 25)->create()->each(function($n){
        	School::find(rand(1, 5))->news()->save($n);
        });
    }
}
