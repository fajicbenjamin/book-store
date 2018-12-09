<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

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
            //dd($validator->errors());
            return response($validator->errors(), Response::HTTP_OK);
//            return redirect('book/create')
//                ->withErrors($validator)
//                ->withInput();
        }
        $attributes['code'] = uniqid();
        //TODO user relacija
        //TODO kategorija relacija
        $attributes['user_id'] = 1;

        $book = new Book();
        $book->fill($attributes)->save();
        $this->uploadImage($book, $attributes['image']);

        return response('Successfully stored book', Response::HTTP_CREATED);
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
        $imagePath = 'storage/' . $image->id . '/' . $image->file_name;

        return response()->view('book.show', ['book' => $book, 'image' => asset($imagePath)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
