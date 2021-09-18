<?php

namespace App\Http\Controllers\ApiControllers;

use App\Categoria;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class CategoriaController extends ApiController
{
    public function index()
    {
        $categorias = Categoria::all();
        return $this->showAll($categorias);
    }

    public function subCategoria(Categoria $categoria)
    {
        $subCategoria = $categoria->subCategoria;
        if ($subCategoria == null) {
            return $this->errorReponse("La categoria no tiene sub categorias", 400);
        }
        return $this->showAll($subCategoria);
    }

    public function categorias()
    {
        $categoria = Categoria::with(["subCategoria"])->orderBy("id")->get();
        return $this->showAll($categoria);
    }
}
