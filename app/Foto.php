<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable = ['enlace', 'anuncio_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function anuncio()
    {
        return $this->belongsTo('App\Anuncio');
    }
}
