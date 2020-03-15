<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController
{
    protected $classe;

    public function index(Request $requisicao)
    {
        /*$offset = ($requisicao->page - 1) * $requisicao->per_page;
        return $this->classe::query()
            ->offset($offset) // offset -> busque a partir deste elemento exclusivo, ou seja, a partir do próximo elemento
            ->limit($requisicao->per_page)
            ->get();*/
        // Retorna os registros. A quantidade de registros por página é definida pelo usuário.
            // Caso o usuário não especifique a quantidade, ai o valor será padrão (15).
        return $this->classe::paginate($requisicao->per_page);
    }

    public function store(Request $requisicao)
    {
        // Adicionar o registro dentro do banco de dados.
        return response()->json($this->classe::create($requisicao->all()), 201);
    }

    public function show($id)
    {
        // Retorna o registro (recurso) pelo ID.
        $recurso = $this->classe::find($id);
        if (is_null($recurso)) { // Recurso não encontrado.
            return response()->json('', 204);
        }
        // Recurso encontrado.
        return response()->json($recurso);
    }

    public function update(int $id, Request $requisicao)
    {
        // Retorna o registro (recurso) pelo ID.
        $recurso = $this->classe::find($id);
        if (is_null($recurso)) { // Recurso não encontrado.
            return response()->json(['mensagem' => 'Recurso não encontrado'], 404);
        }
        // Preenche a série selecionada com todas as informações passados pelo parâmetro do método fill().
        $recurso->fill($requisicao->all());
        // Salva os registros dentro do banco de dados.
        $recurso->save();

        return $recurso;
    }

    public function destroy(int $id)
    {
        // Remove o registro dentro do banco de dados, com base no ID passado pelo parâmetro.
        $quantidadeRecursosRemovidos = $this->classe::destroy($id);
        if ($quantidadeRecursosRemovidos === 0) { // Recurso não encontrado.
            return response()->json(['mensagem' => 'Recurso não encontrado'], 404);
        }
        // Recurso encontrado.
        return response()->json(['mensagem' => 'Recurso removido'], 204);
    }
}
