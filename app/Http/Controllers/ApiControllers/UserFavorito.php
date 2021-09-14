<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Anuncio;
use App\Favorito;
use App\User;

class UserFavorito extends ApiController
{
    public function addFavorito(Anuncio $anuncio)
    {
        try {
            $user = auth()->user();
            $user->favoritos()->attach($anuncio->id);
            return $this->showOne($anuncio);
        } catch (\Throwable $th) {
            print($th);
        }
    }
    public function deleteFavorito(Anuncio $anuncio)
    {
        try {
            $user = auth()->user();
            $user->favoritos()->detach($anuncio->id);
            return $this->showOne($anuncio, 204);
        } catch (\Throwable $th) {
            print($th);
        }
    }

    public function getFavoritos()
    {
        $user = auth()->user();
        $favorito = $user->favoritos();
        print($favorito);
    }
}
