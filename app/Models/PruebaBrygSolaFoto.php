<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PruebaBrygSolaFoto extends Model
{
    protected $table = 'prueba_brig_sola_candidatos_fotos';
    protected $fillable = [
    	'prueba_id',
    	'user_id',
    	'descripcion'
    ];
}
