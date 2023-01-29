<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatosAprendiz extends Model
{
    protected $table = 'datos_aprendiz';

    protected $guarded = ['id'];

   public function datosBasicos()
    {
        return $this->belongsTo('App\Models\DatosBasicos');
    }
}
