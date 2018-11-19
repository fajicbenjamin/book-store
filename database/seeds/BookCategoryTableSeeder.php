<?php

use App\Book;
use App\Category;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: benjaminfajic
 * Date: 19/11/2018
 * Time: 19:47
 */

class BookCategoryTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $books = Book::all();
        $categories = Category::all();

        // give two books for each category
        foreach ($books as $book) {
            $book->categories()->attach(array_random($categories->pluck('id')->toArray(), 2));
        }
    }
}