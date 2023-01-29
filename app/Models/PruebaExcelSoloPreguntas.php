<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PruebaExcelSoloPreguntas extends Model
{
    protected $table      = 'prueba_excel_solo_preguntas';
    protected $fillable   = [
        'descripcion',
        'tipo',
        'active'
    ];

    public function getOpciones(){
        return $this->hasMany('App\Models\PruebaExcelSoloOpciones', 'id_pregunta', 'id')->where('active', 1)->orderByRaw('RAND()');
    }

    public function allOpciones(){
        return $this->hasMany('App\Models\PruebaExcelSoloOpciones', 'id_pregunta', 'id');
    }
}
