<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    public $timestamps = false;
    protected $fillable = ['temporada', 'numero', 'assistido', 'serie_id'];
    protected $appends = ['links'];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    // Criou este método para que o valor retorne um booleano.
    public function getAssistidoAttribute($assistido): bool
    {
        return $assistido;
    }

    public function getLinksAttribute()
    {
        return [
            'self' => '/api/episodios/ . $this->id',
            'serie' => '/api/series/' . $this->serie_id
        ];
    }

}
