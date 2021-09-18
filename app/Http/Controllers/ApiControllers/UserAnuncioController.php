<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\ApiController;
use App\User;
use App\Anuncio;
use App\Favorito;

class UserAnuncioController extends ApiController
{
    public function misAnuncios()
    {
        try {
            $user = auth()->user();
            $anuncios = $user->anuncios()->with(["fotos", "categoria", "destacado", "user"])->get();
            return $this->showAll($anuncios);
        } catch (\Throwable $th) {
            return $this->errorReponse("no se pudo completar la accion", 500);
        }
        return $this->showAll($anuncios);
    }

    public function getUserFavorito()
    {
        $user = auth()->user();
        $favorito = $user::with('anuncios')->get();
        return $this->showAll($favorito);
    }

    public function isAnuncioFavorito(Anuncio $anuncio, User $user)
    {
        $isFavorito = $user->favoritos()->where('anuncio_id', $anuncio->id)->first();
        print($isFavorito == null);

        return $this->showOne($isFavorito == null ? new Favorito() : $isFavorito);
    }

    public function getAnuncioDetail()
    {
        try {
            $user = auth()->user();
            $anuncios = Anuncio::orderBy('fecha_publicacion', 'DESC')
                ->with(['fotos', 'user', 'categoria', 'destacado', 'favoritos' => function ($q) use ($user) {
                    $q->where("user_id", $user->id);
                }])->paginate(15);
            return  response()->json($anuncios, 200);
        } catch (\Throwable $th) {
            return $this->errorReponse("inautorizado", 401);
        }
    }

    public function getAnuncioDetail2()
    {
        $anuncios = Anuncio::orderBy('fecha_publicacion', 'DESC')
            ->with(['fotos', 'user', 'categoria', 'destacado', 'favoritos'])->paginate(15);
        return  response()->json($anuncios, 200);
    }
}
