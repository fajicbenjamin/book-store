<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $bookController;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookController $bookController)
    {
        $this->middleware('auth');
        $this->bookController = $bookController;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = $this->bookController->getBooksByUserId(auth()->user()->id);
        return view('home', ['books' => $books]);
    }
}
