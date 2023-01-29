<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PruebaCompetenciaSolaTotal extends Model
{
    protected $table = 'prueba_competencias_sola_totales';
    protected $fillable = [
    	'id',
    	'prueba_id',
    	'user_id',
    	'competencia_id',
    	'calificacion_obtenida',
    	'desfase',
    	'desfase_absoluto',
    	'ajuste_perfil'
    ];
}
