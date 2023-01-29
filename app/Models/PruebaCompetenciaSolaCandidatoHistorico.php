<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PruebaCompetenciaSolaCandidatoHistorico extends Model
{
    protected $table = 'prueba_competencias_sola_candidatos_historicos';
    protected $fillable = [
    	'user_id',
    	'prueba_id',
		'competencia_id',
		'codigo_pregunta',
		'pregunta',
		'opcion',
		'valor'
    ];
}
