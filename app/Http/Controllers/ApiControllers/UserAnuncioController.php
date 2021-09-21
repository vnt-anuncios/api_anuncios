<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\ApiController;
use App\User;
use App\Anuncio;
use App\Favorito;
use App\Categoria;
use Carbon\Carbon;
use App\Foto;
use Illuminate\Http\Request;

class UserAnuncioController extends ApiController
{
    public function misAnuncios()
    {
        try {
            $user = auth()->user();
            $anuncios = $user->anuncios()->with(["fotos", "categoria", "destacado", "user", 'favoritos' => function ($q) use ($user) {
                $q->where("user_id", $user->id);
            }])->get();
            return $this->showAll($anuncios);
        } catch (\Throwable $th) {
            return $this->errorReponse("no se pudo completar la accion", 500);
        }
        return $this->showAll($anuncios);
    }

    public function  eliminarAnuncio(Anuncio $anuncio)
    {
        try {
            //code...
            $anuncio->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
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

    public function agregarAnuncio(Request $request)
    {
        try {
            $request->validate([
                "anuncio" => "required",
                "id_categoria" => "required",
            ]);

            $resCategoria = json_decode($request->id_categoria);
            $categoria = Categoria::find($resCategoria);
            if ($categoria == null) {
                return  $this->errorReponse("no se encontro la categoria", 201);
            }

            $resAnuncio = json_decode($request->anuncio);

            $user = auth()->user();

            $anuncio = new Anuncio();
            $anuncio->titulo = $resAnuncio->titulo;
            $anuncio->precio = $resAnuncio->precio;
            $anuncio->fecha_publicacion = now();
            $anuncio->condicion_encuentra = $resAnuncio->condicion;
            $anuncio->ubicacion = $resAnuncio->ubicacion;
            $anuncio->descripcion = $resAnuncio->descripcion;
            $anuncio->enlace = $resAnuncio->enlace;
            $anuncio->user_id = $user->id;
            $anuncio->categoria_id = $categoria->id;
            $anuncio->save();




            $path = "";
            $i = 0;
            $foto = "fotos";

            while ($request->hasFile($foto . $i)) {
                $path = $path . "si";
                $date = Carbon::now()->timestamp;
                $response = cloudinary()->upload($request->file($foto . $i)->getRealPath(), [
                    "folder" => "anuncios/$user->id/$anuncio->id/",
                    "public_id" => $date . $i
                ])->getSecurePath();
                $photo = new Foto();
                $photo->enlace = $response;
                $photo->anuncio_id = $anuncio->id;
                $photo->save();
                $i += 1;
            }


            return response()->json(["mensage" => $response]);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->errorReponse($th, 500);
        }
    }
}
