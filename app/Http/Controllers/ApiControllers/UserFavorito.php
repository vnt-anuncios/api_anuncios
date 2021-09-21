<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\ApiController;
use App\Anuncio;

class UserFavorito extends ApiController
{
    public function addFavorito(Anuncio $anuncio)
    {
        try {
            $user = auth()->user();
            $user->favoritos()->attach($anuncio->id);
            return $this->showOne($anuncio, 201);
        } catch (\Throwable $th) {
            return $this->error();
        }
    }
    public function deleteFavorito(Anuncio $anuncio)
    {
        try {
            $user = auth()->user();
            $user->favoritos()->detach($anuncio->id);
            return $this->showOne($anuncio, 204);
        } catch (\Throwable $th) {
            return $this->error();
        }
    }

    public function getFavoritos()
    {
        try {
            $user = auth()->user();
            $favorito = $user->favoritos()->select("anuncios.*")->leftjoin("destacados", "anuncios.id", "=", "destacados.anuncio_id")
                ->orderBy('destacados.fecha_fin', 'DESC')->orderBy("anuncios.fecha_publicacion", 'DESC')->select("anuncios.*")->with(['fotos', 'user', 'categoria', 'destacado',])->get();
            return $this->showAll($favorito);
        } catch (\Throwable $th) {
            return $this->error();
        }
    }

    public function error()
    {
        return $this->errorReponse("hubo un problema con el servidor intente nuevamente", 500);
    }
}
