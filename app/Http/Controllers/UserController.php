<?php
/**
 * Created by PhpStorm.
 * User: benjaminfajic
 * Date: 02/01/2019
 * Time: 18:08
 */

namespace App\Http\Controllers;


class UserController extends Controller
{
    protected $bookController;

    public function __construct(BookController $bookController)
    {
        $this->bookController = $bookController;
    }

    public function showUserBooks($id) {
        $books = $this->bookController->getBooksByUserId($id);
        return view('user.show', ['books' => $books]);
    }

    public function showCart() {
        return view('cart.show');
    }
}