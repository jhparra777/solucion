<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PruebaExcelSoloRespuestaIntermedio extends Model
{
    protected $table    = 'prueba_excel_solo_respuestas_intermedio';
    protected $fillable = [
        'user_id',
        'pregunta_id',
        'respuesta_user_id',
        'opcion_id'
    ];

    public function pregunta() {
        return $this->belongsTo('App\Models\PruebaExcelSoloPreguntas', 'pregunta_id', 'id');
    }

    public function preguntaOpciones() {
    	return PruebaExcelSoloPreguntas::join('prueba_excel_solo_opciones', 'prueba_excel_solo_opciones.pregunta.id_pregunta', '=', 'prueba_excel_solo_preguntas.id')->where('prueba_excel_solo_preguntas.id', $this->pregunta_id)->first();
    }

    public function opciones() {
    	return $this->hasMany('App\Models\PruebaExcelSoloOpciones', 'id_pregunta', 'pregunta_id');
    }
}
