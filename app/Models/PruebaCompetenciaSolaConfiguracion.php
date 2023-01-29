<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PruebaCompetenciaSolaConfiguracion extends Model
{
    protected $table = 'prueba_competencias_sola_conf';
    protected $fillable = [
    	'competencia_id',
    	'nivel_cargo',
    	'nivel_esperado',
    	'margen_acertividad'
    ];
}
