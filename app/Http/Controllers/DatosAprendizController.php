<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\DatosAprendiz;
use App\Models\DatosBasicos;

class DatosAprendizController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $datos_basicos = DatosBasicos::find($request->datos_basicos_id);

        $datos_aprendiz = DatosAprendiz::where('datos_basicos_id', $datos_basicos->id)->first();

        if ( is_null($datos_aprendiz) ) {
            $datos_aprendiz = new DatosAprendiz();
        }

        $datos_aprendiz->especialidad = $request->especialidad;
        $datos_aprendiz->numero_grupo = $request->numero_grupo;
        $datos_aprendiz->institucion = $request->institucion;
        $datos_aprendiz->sena_centro_formacion = $request->sena_centro_formacion;
        $datos_aprendiz->datos_basicos_id = $request->datos_basicos_id;

        $datos_aprendiz->save();

        return redirect()->route('admin.actualizar_hv_admin', $datos_basicos->user_id)->with("mensaje_success", "Datos de Aprendiz Guardado correctamente.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

}
