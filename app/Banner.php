<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['enlace','fechainicio','fechafin'];

    public function anuncio(){
        return $this->belongsTo('App\Anuncio');
    }
}
