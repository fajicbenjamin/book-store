<?php

use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: benjaminfajic
 * Date: 19/11/2018
 * Time: 19:12
 */

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Category::class, 20)->create();
    }
}