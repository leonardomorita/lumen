<?php

namespace App\Http\Controllers;

use App\Serie;
use Illuminate\Http\Request;

class SeriesController
{
    public function index()
    {
        return Serie::all(); // retorna todos os registros da tabela 'series'.
    }

    public function store(Request $requisicao)
    {
        return response()->json(Serie::create(['nome' => $requisicao->nome]), 201);
    }

    public function show($id)
    {
        $serie = Serie::find($id);
        if (is_null($serie)) {
            return response()->json('', 204);
        }
        return response()->json($serie);
    }

    public function update(int $id, Request $requisicao)
    {
        $serie = Serie::find($id);
        if (is_null($serie)) {
            return response()->json(['mensagem' => 'Recurso não encontrado'], 404);
        }
        $serie->fill($requisicao->all()); // preenche a série selecionada com todas as informações passados pelo parâmetro do método fill().
        $serie->save();

        return $serie;
    }

    public function destroy(int $id)
    {
        $quantidadeRecursosRemovidos = Serie::destroy($id);
        if ($quantidadeRecursosRemovidos === 0) {
            return response()->json(['mensagem' => 'Recurso não encontrado'], 404);
        }
        return response()->json(['mensagem' => 'Recurso removido'], 204);
    }
}
