<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destacado extends Model
{
    protected $fillable = ['fechainicio','fechafin'];

    public function anuncio(){
        return $this->hasOne('App\Anuncio');
    }
}
