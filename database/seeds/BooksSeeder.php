<?php

use Illuminate\Database\Seeder;
use App\Book;
use App\School;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Book::class, 150)->create()->each(function($v){
        	School::find(rand(1, 5))->books()->save($v);
        });
    }
}
