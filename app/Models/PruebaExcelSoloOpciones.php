<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PruebaExcelSoloOpciones extends Model
{
    protected $table      = 'prueba_excel_solo_opciones';
    protected $fillable   = [
        'id_pregunta',
        'descripcion',
        'correcta',
        'active'
    ];

    public function pregunta() {
        return $this->belongsTo('App\Models\PreguntaExcelSoloPreguntas', 'id_pregunta', 'id');
    }
}
