<?php

namespace App\Http\Controllers;

use App\Foto;
use Illuminate\Http\Request;

class FotoController extends ApiController
{

    public function show(Foto $foto)
    {
        return $this->showOne($foto);
    }

    public function destroy(Foto $foto)
    {
        $foto->delete();
        return $this->showOne($foto);
    }
}
