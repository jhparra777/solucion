<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PruebaBrigSolaConfig extends Model
{
    protected $table      = 'prueba_brig_sola_configuracion';
    protected $fillable   = [
        'radical',
        'genuino',
        'garante',
        'basico',
        'perfil'
    ];
}
