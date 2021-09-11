<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\ApiController;
use App\Destacado;
use App\Anuncio;

class DestacadoAnuncioController extends ApiController
{
    public function index()
    {
        $destacados = Anuncio::join('destacados', 'anuncios.id', '=', 'destacados.anuncio_id')
            ->where('destacados.estado', '1')
            ->select('anuncios.*')
            ->with(['categoria', 'user', 'fotos', 'favoritos'])->get();
        return $this->showAll($destacados);
    }
}
