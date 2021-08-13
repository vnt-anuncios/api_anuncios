<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Categoria;

class CreditoDestacado extends Model
{
    protected $fillable = ['cantidad'];

    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
}
