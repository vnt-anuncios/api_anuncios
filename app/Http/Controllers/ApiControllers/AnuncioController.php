<?php

namespace App\Http\Controllers\ApiControllers;

use App\Anuncio;
use App\Http\Controllers\ApiController;

class AnuncioController extends ApiController
{
    public function index()
    {
        $anuncios = Anuncio::orderBy('fecha_publicacion', 'DESC')->get();
        return $this->showAll($anuncios);
    }

    public function show(Anuncio $anuncio)
    {
        return $this->showOne($anuncio);
    }
}
