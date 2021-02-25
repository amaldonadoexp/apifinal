<?php

namespace App\Http\Controllers;

use App\Prestamos;
use Illuminate\Http\Request;
use App\Http\Resources\PrestamosResource;

class PrestamosController extends Controller
{
    public function index()
    {
        return PrestamosResource::collection(Prestamos::all());
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
            'user_id' => 'integer|required|min:1',
            'book_id' => 'integer|required|min:1',
        ];

        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
        ];

        $validateData = $request->validate($rules, $messages);
        $prestamos = Prestamos::create($validateData);
        return new PrestamosResource($prestamos);
    }

}
