<?php

namespace App\Http\Controllers;

use App\Serie;
use Illuminate\Http\Request;

class SeriesController
{
    public function index()
    {
        return Serie::all();
    }

    public function store(Request $requisicao)
    {
        return response()->json(Serie::create(['nome' => $requisicao->nome]), 201);
    }

    public function get($id)
    {
        $serie = Serie::find($id);
        if (is_null($serie)) {
            return response()->json('', 204);
        }
        return response()->json($serie);
    }
}
