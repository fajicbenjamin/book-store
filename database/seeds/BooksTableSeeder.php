<?php

use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: benjaminfajic
 * Date: 19/11/2018
 * Time: 19:11
 */

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Book::class, 200)->create();
    }
}