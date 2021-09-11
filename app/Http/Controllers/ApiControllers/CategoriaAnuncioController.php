<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Categoria;

class CategoriaAnuncioController extends ApiController
{
    public function anuncioOfTheCategoria(Categoria $categoria)
    {
        //$anuncios = $categoria->anuncios()->with(['categoria', 'user', 'fotos', 'favoritos', 'destacado'])->get();
        $anuncios = $categoria->anuncios()->leftjoin("destacados", "anuncios.id", "=", "destacados.anuncio_id")
            ->orderBy('destacados.fecha_fin', 'DESC')->orderBy("anuncios.fecha_publicacion", 'DESC')->select("anuncios.*")
            ->with(['categoria', 'user', 'fotos', 'favoritos', 'destacado'])
            ->get();
        //$anuncios = $anuncios->orderBy($anuncios->favoritos->fecha_fin)->get();
        return $this->showAll($anuncios);
    }
}
