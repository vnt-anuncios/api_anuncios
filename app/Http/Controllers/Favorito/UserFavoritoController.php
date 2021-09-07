<?php

namespace App\Http\Controllers\Favorito;

use App\Anuncio;
use App\Favorito;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Auth\Access\Response;

class UserFavoritoController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $favoritos = $user->favoritos();
        return $this->showAll($favoritos->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Anuncio $anuncio)
    {
        if ($user->favoritos()->find($anuncio->id)) {
            return $this->showOne($user->favoritos()->find($anuncio), 201);
        }
        $user->favoritos()->attach($anuncio->id);
        return $this->showOne($user->favoritos()->find($anuncio), 201);
    }

    public function destroy(User $user, Anuncio $anuncio)
    {
        $user->favoritos()->detach($anuncio->id);
        return $this->deleteSuccesfull();
    }
}
