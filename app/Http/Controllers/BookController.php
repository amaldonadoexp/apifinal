<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return BookResource::collection(Book::all());
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
        ];

        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
        ];

        $validateData = $request->validate($rules, $messages);
        $book = Book::create($validateData);
        return new BookResource($book);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $rules = [
            'title' => 'max:255',
            'description' => 'max:255',
        ];

        $validatedData = $request->validate($rules);

        
        $book->fill($validatedData);

        //Indica si a cambiado algun valor del modelo antes del cambio
        if (!$book->isDirty()) {

            return response()->json(['error' => ['code' => 422, 'message' => 'especifica algun cambio distinto']], 422);
        }
        $book->save();
        return new BookResource($book);
    }


}
