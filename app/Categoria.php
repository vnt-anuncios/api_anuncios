<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre','imagen'];
    protected $hidden = ['created_at','updated_at'];

    public function parentCategoria(){
        return $this->belongsTo('App\Categoria','categoria_id');
    }

    public function subCategoria(){
        return $this->hasMany('App\Categoria','categoria_id');
    }

    public function credito(){
        return $this->hasOne('App\Credito');
    }

    public function anuncios(){
        return $this->hasMany('App\Anuncio');
    }
}
