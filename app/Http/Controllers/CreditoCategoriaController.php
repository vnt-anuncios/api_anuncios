<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CreditoDestacado;
use App\Categoria;

class CreditoCategoriaController extends ApiController
{
    public function categoriaCredito(){
        
        $categoria = Categoria::select("categorias.id","categorias.nombre","credito_destacados.cantidad")
        ->join("credito_destacados","categorias.id","=","credito_destacados.categoria_id")->get();
        return $this->showAll($categoria);
    }
}
