<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PruebaCompetenciaSolaFoto extends Model
{
    protected $table = 'prueba_competencias_sola_candidatos_fotos';
    protected $fillable = [
    	'prueba_id',
    	'user_id',
    	'descripcion'
    ];
}
