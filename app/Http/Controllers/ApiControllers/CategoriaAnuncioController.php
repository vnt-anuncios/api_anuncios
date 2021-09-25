<?php

namespace App\Http\Controllers\ApiControllers;

use App\Anuncio;
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
    public function anuncioOrderByDestacadoFirst()
    {
        $user = auth()->user();
        //$anuncios = $categoria->anuncios()->with(['categoria', 'user', 'fotos', 'favoritos', 'destacado'])->get();
        $anuncios = Anuncio::leftjoin("destacados", "anuncios.id", "=", "destacados.anuncio_id")
            ->orderBy('destacados.fecha_fin', 'DESC')->orderBy("anuncios.fecha_publicacion", 'DESC')->select("anuncios.*")
            ->with(['categoria', 'user', 'fotos', 'favoritos' => function ($q) use ($user) {
                return $q->where("favoritos.user_id", $user->id);
            }, 'destacado'])->paginate(15);
        return response()->json($anuncios);
    }

    public function anunciosOfCategoria($categoria)
    {
        if ($categoria == 0) {
            return $this->anuncioOrderByDestacadoFirst();
        }
        $user = auth()->user();
        $categoria = Categoria::find($categoria);
        //$anuncios = $categoria->anuncios()->with(['categoria', 'user', 'fotos', 'favoritos', 'destacado'])->get();
        $anuncios = $categoria->anuncios()->leftjoin("destacados", "anuncios.id", "=", "destacados.anuncio_id")
            ->orderBy('destacados.fecha_fin', 'DESC')->orderBy("anuncios.fecha_publicacion", 'DESC')->select("anuncios.*")
            ->with(['categoria', 'user', 'fotos', 'favoritos' => function ($q) use ($user) {
                return $q->where("favoritos.user_id", $user->id);
            }, 'destacado'])
            ->paginate(15);
        //$anuncios = $anuncios->orderBy($anuncios->favoritos->fecha_fin)->get();
        return response()->json($anuncios);
    }
}
