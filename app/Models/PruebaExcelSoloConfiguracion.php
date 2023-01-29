<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PruebaExcelSoloConfiguracion extends Model
{
    protected $table    = 'prueba_excel_solo_configuracion';
    protected $fillable = [
        'excel_basico',
        'excel_intermedio',
        'tiempo_excel_basico',
        'tiempo_excel_intermedio',
        'aprobacion_excel_basico',
        'aprobacion_excel_intermedio',
        'gestiono'
    ];
}
