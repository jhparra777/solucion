<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class EvaluacionSST extends Model
{

    protected $table    = 'evaluacion_sst';
    protected $fillable = [ "id_candidato",
                            "id_req","preg_uno",
                            "preg_dos","preg_tres",
                            "preg_cuatro","preg_cinco",
                            "preg_seis","preg_siete","preg_ocho"];


}
