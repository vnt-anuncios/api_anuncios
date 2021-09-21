<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\ApiController;
use App\Anuncio;
use App\Destacado;
use App\Favorito;

class AnuncioDetailController extends ApiController
{
    public function getAnuncioUser(Anuncio $anuncio)
    {
        $user = $anuncio->user;
        return $this->showOne($user);
    }

    public function getAnuncioCategoria(Anuncio $anuncio)
    {
        $categoria = $anuncio->categoria;
        return $this->showOne($categoria);
    }

    public function getAnuncioDestacado(Anuncio $anuncio)
    {
        $destacado = $anuncio->destacado;
        if ($destacado == null) {
            return $this->showOne(new Destacado());
        }
        return $this->showOne($destacado);
    }

    public function getAnuncioFotos(Anuncio $anuncio)
    {
        $fotos = $anuncio->fotos;
        return $this->showAll($fotos);
    }
}
