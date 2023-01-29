<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PruebaCompetenciaSolaResultado extends Model
{
    protected $table = 'prueba_competencias_sola_resultados';
    protected $fillable = [
		'user_id',
        'ajuste_global',
        'factor_desfase_global',
		'estado',
		'fecha_realizacion'
    ];
}
