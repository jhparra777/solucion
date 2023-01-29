<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotivoRetiro extends Model
{

    protected $table    = 'motivos_retiros';
    protected $fillable = ['id', "descripcion", "active"];
    public $timestamps  = false;

    public function fullEstado()
    {
        $estado = "";
        switch ($this->active) {
            case 1:
                $estado = "Activo";
                break;
            case 0:
                $estado = "Inactivo";
                break;
        }
        return $estado;
    }

}
