<?php

namespace App\Http\Controllers;

use App\Episodio;

class EpisodiosController extends BaseController
{
    public function __construct()
    {
        $this->classe = Episodio::class;
    }

    public function buscarPorSerie(int $serieId)
    {
        $episodios = Episodio::query()->where('serie_id', $serieId)->paginate();

        return $episodios;
    }
}
