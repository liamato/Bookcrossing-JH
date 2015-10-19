<?php

use Illuminate\Database\Seeder;
use App\User;
use App\School;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 20)->create()->each(function($u){
        	School::find(rand(1, 5))->users()->save($u);
        });
    }
}
