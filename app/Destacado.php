<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Destacado extends Model
{
    protected $fillable = ['fecha_inicio', 'fecha_fin', 'estado'];
    protected $hidden = ["created_at", "updated_at", "anuncio_id"];

    public function anuncio()
    {
        return $this->belongsTo('App\Anuncio');
    }

    public function expireDay()
    {
        $now = Carbon::today();
        //$destacados = $this->where('estado', '1')->whereDate('fecha_fin', '<=', $now)->get();
        $destacados = $this->where('estado', '1')->whereDate('fecha_fin', '<=', $now)->update(['estado' => false]);
        return $destacados;
    }

    protected $casts = [
        "estado" => "boolean",
    ];
}
