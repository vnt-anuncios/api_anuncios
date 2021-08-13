<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends ApiController
{
    
    public function index()
    {
        //$categorias = Categoria::orderBy('id','DESC')->paginate(15);
        //return view('admin.categoria.index',compact('categorias'));
        $categoria = Categoria::all();
        return $this->showAll($categoria);
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(Categoria $categoria)
    {
        //
    }

    
    public function edit(Categoria $categoria)
    {
        //
    }

    
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    
    public function destroy(Categoria $categoria)
    {
        //
    }
}
