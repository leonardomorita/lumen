<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController
{
    protected $classe;

    public function index()
    {
        return $this->classe::all(); // retorna todos os registros da tabela.
    }

    public function store(Request $requisicao)
    {
        return response()->json($this->classe::create($requisicao->all()), 201);
    }

    public function show($id)
    {
        $recurso = $this->classe::find($id);
        if (is_null($recurso)) {
            return response()->json('', 204);
        }
        return response()->json($recurso);
    }

    public function update(int $id, Request $requisicao)
    {
        $recurso = $this->classe::find($id);
        if (is_null($recurso)) {
            return response()->json(['mensagem' => 'Recurso não encontrado'], 404);
        }
        $recurso->fill($requisicao->all()); // preenche a série selecionada com todas as informações passados pelo parâmetro do método fill().
        $recurso->save();

        return $recurso;
    }

    public function destroy(int $id)
    {
        $quantidadeRecursosRemovidos = $this->classe::destroy($id);
        if ($quantidadeRecursosRemovidos === 0) {
            return response()->json(['mensagem' => 'Recurso não encontrado'], 404);
        }
        return response()->json(['mensagem' => 'Recurso removido'], 204);
    }
}
