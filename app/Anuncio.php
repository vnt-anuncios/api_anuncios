<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $fillable = ['titulo', 'precio', 'estado', 'enlace', 'descripcion'];
    protected $hidden = ['created_at','updated_at'];

    public function fotos()
    {
        return $this->hasMany('App\Foto');
    }

    public function banners()
    {
        return $this->hasOne('App\Banner');
    }
    public function destacado()
    {
        return $this->hasOne('App\Destacado');
    }
    public function favoritos()
    {
        return $this->belongsToMany('App\Anuncio')->using('App\Favorito');
    }
    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
