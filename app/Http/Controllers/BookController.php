<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\Models\Media;

class BookController extends Controller
{
    public function index()
    {
        return Book::with('user', 'categories', 'media')->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->all();
        $validator = Validator::make($attributes, [
            'author' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:13',
            'publisher' => 'required|string|max:255',
            'available' => 'sometimes|boolean',
            'pages' => 'required|integer',
            'price' => 'required|integer',
            'language' => 'required|string|max:255',
            'edition' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|file',
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $attributes['code'] = uniqid();
        $attributes['user_id'] = auth()->user()->id;

        //TODO kategorija relacija

        $book = new Book();
        $book->fill($attributes)->save();
        $this->uploadImage($book, $attributes['image']);

        return response($book->id, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);

        $image = $book->getFirstMedia('book-images');
        $user = User::findOrFail($book->user_id);
        $currentUser = auth()->user() ? auth()->user()->id : null;

        return response()->view('book.show', ['book' => $book, 'image' => asset($image->getUrl()), 'user' => $user, 'currentUser' => $currentUser]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);

        return view('book.edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $attributes = $request->all();
        $validator = Validator::make($attributes, [
            'author' => 'sometimes|string|max:255',
            'title' => 'sometimes|string|max:255',
            'isbn' => 'sometimes|string|max:13',
            'publisher' => 'sometimes|string|max:255',
            'available' => 'sometimes|boolean',
            'pages' => 'sometimes|integer',
            'price' => 'sometimes|integer',
            'language' => 'sometimes|string|max:255',
            'edition' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'image' => 'file',
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), Response::HTTP_OK);
        }

        //TODO kategorija relacija

        $book->fill($attributes)->save();

        if (isset($attributes['image'])) {
            $oldImage = $book->getMedia('book-images')[0]->id;
            Media::destroy($oldImage);
            $this->uploadImage($book, $attributes['image']);
        }

        return response($book->id, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::destroy($id);

        return response('Book successfully destroyed', Response::HTTP_OK);
    }

    private function uploadImage($book, $image) {
        $book->addMedia($image)->toMediaCollection('book-images');
    }

    public function getBooksByUserId($user_id) {
        return Book::with('categories', 'media')
            ->whereUserId($user_id)
            ->get();
    }
}
