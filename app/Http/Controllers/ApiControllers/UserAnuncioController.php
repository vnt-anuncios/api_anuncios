<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\ApiController;
use App\User;
use App\Anuncio;
use App\Favorito;
use Illuminate\Http\Request;

class UserAnuncioController extends ApiController
{
    public function getUserAnuncio(User $user)
    {
        $anuncios = $user->anuncios;
        return $this->showAll($anuncios);
    }

    public function getUserFavorito(User $user)
    {
        $favorito = $user->favoritos;
        return $this->showAll($favorito);
    }

    public function isAnuncioFavorito(Anuncio $anuncio, User $user)
    {
        $isFavorito = $user->favoritos()->where('anuncio_id', $anuncio->id)->first();
        print($isFavorito == null);

        return $this->showOne($isFavorito == null ? new Favorito() : $isFavorito);
    }

    public function getAnuncioDetail(User $user)
    {
        $anuncios = Anuncio::orderBy('fecha_publicacion', 'DESC')
            ->with(['fotos', 'user', 'categoria', 'destacado', 'favoritos' => function ($q) use ($user) {
                $q->where("user_id", $user->id);
            }])->paginate(15);
        return  response()->json($anuncios, 200);
    }

    public function getAnuncioDetail2()
    {
        $anuncios = Anuncio::orderBy('fecha_publicacion', 'DESC')
            ->with(['fotos', 'user', 'categoria', 'destacado', 'favoritos'])->paginate(15);
        return  response()->json($anuncios, 200);
    }
}
