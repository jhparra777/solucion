<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PruebaBrigSolaResultado;
use App\Models\PruebaCompetenciaSolaResultado;

use App\Models\PruebaValoresRespuestasGeneral;
use App\Models\PruebaExcelSoloRespuestaUser;

class PruebasCvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(empty($this->user->id)){
            session(["url_deseada_redireccion_candidato" => url($_SERVER['REQUEST_URI'])]);
            return redirect()->route('login');
        }

        $menu = DB::table("menu_candidato")
        ->where("estado", 1)
        ->orderBy("orden")
        ->select("menu_candidato.*")
        ->get();

        // Buscar pruebas y listarlas
        $prueba_pskills = PruebaCompetenciaSolaResultado::where('user_id', $request->user()->id)->first();
        $prueba_bryg = PruebaBrigSolaResultado::where('user_id', $request->user()->id)->first();
        $prueba_valores = PruebaValoresRespuestasGeneral::where('user_id', $this->user->id)->first();
        $excel_basico = PruebaExcelSoloRespuestaUser::where('user_id', $this->user->id)->where('tipo', 'basico')->first();
        $excel_intermedio = PruebaExcelSoloRespuestaUser::where('user_id', $this->user->id)->where('tipo', 'intermedio')->first();

        return view("cv.mis_pruebas", compact('prueba_pskills', 'prueba_bryg', 'prueba_valores', 'excel_basico', 'excel_intermedio', 'menu'));
    }
}
