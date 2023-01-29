<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\DatosBasicos;
use App\Models\PruebaValoresAreaImportante;
use App\Models\PruebaValoresConfigEstandar;
use App\Models\PruebaValoresInterpretacion;
use App\Models\PruebaValoresNormasNacionales;
use App\Models\PruebaValoresPreguntas;
use App\Models\PruebaValoresRespuestasGeneral;
use App\Models\Sitio;
use App\Models\User;

use DB;
use triPostmaster;

use Storage;
use File;
use Carbon\Carbon;
use PDF;

class PruebaEthicalValuesController extends Controller
{
    public function index_prueba(Request $data)
    {
        if(empty($this->user->id)){
            session(["url_deseada_redireccion_candidato" => url($_SERVER['REQUEST_URI'])]);
            return redirect()->route('login');
        }

        $check_test = PruebaValoresRespuestasGeneral::where('user_id', $this->user->id)
            ->orderBy('created_at', 'DESC')
        ->first();

        if(!is_null($check_test)){
            return redirect()->route('dashboard')->with('no_prueba','Ya has respondido esta prueba.');
        }

        $name_user = DatosBasicos::where('user_id', $this->user->id)
            ->select(DB::raw("CONCAT(datos_basicos.nombres,' ',datos_basicos.primer_apellido) AS nombre_candidato"))
        ->first();

        $sitio = Sitio::first();
        $user = User::find($this->user->id);
        $nombre_prueba = 'Prueba de Ethical Values';
        $req_id = (int)"-1";

        $configuracion = PruebaValoresConfigEstandar::where('active', 1)->orderBy('id', 'desc')->first();

        //dd($configuracion);
        
        $prueba_questions = PruebaValoresPreguntas::where('active', 1)->orderByRaw('RAND()')->get();

        $total_preguntas = count($prueba_questions);

        $ids = array();
        foreach($prueba_questions as $question){ $ids[] = (int)$question->id; }

        //Reload
        $reloadPage = $data->session()->get('reloadPage');

        $ruta_save = route('cv.prueba_valores_general_save');

        if ($reloadPage === 'yes') {
            $data->session()->forget('reloadPage');
        }else {
            session(['reloadPage' => 'not']);
        }

        return view('cv.pruebas.valores_1.prueba_valores_1', compact('sitio', 'user', 'name_user', 'nombre_prueba', 'total_preguntas', 'ids', 'prueba_questions', 'reloadPage', 'req_id', 'configuracion', 'ruta_save'));
    }

    public function save_result_valores(Request $request)
    {
        $user_id = $this->user->id;

        $imagenes = json_decode($request->fotosPrueba, true);

        $nombres_fotos = '';

        $total_imagenes = count($imagenes);

        for($i = 0; $i < $total_imagenes; $i++) {
            //Se verifica que la imagen tenga datos
            if ($imagenes[$i]['picture'] != null && $imagenes[$i]['picture'] != '') {
                //Convertir base64 a PNG
                $image_parts = explode(";base64,", $imagenes[$i]['picture']);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $fotoNombre = "candidato-foto-$i-$user_id.png";

                if ($i == $total_imagenes-1) {
                    $nombres_fotos = $nombres_fotos . $fotoNombre;
                } else {
                    $nombres_fotos = $nombres_fotos . "$fotoNombre,";
                }

                Storage::disk('public')->put("recursos_prueba_valores_1/prueba_valores_1_".$user_id."/$fotoNombre", $image_base64);
            }
        }

        $preguntas = PruebaValoresPreguntas::where('active', 1)->get();

        $valor_amor = 0;
        $valor_no_violencia = 0;
        $valor_paz = 0;
        $valor_rectitud = 0;
        $valor_verdad = 0;

        $item_amor = 0;
        $item_no_violencia = 0;
        $item_paz = 0;
        $item_rectitud = 0;
        $item_verdad = 0;

        $preg_resp = $request->except('req_id', 'userId', '_token', 'fotosPrueba');
        $respuestas_json = json_encode($preg_resp);
        foreach ($preg_resp as $preg_id_text => $estrellas) {
            //preg_id-24-premisa_1
            $pregunta_id_premisa = str_replace('preg_id-', '', $preg_id_text);

            $pregunta_id = str_replace('-premisa_1', '', str_replace('-premisa_2', '', $pregunta_id_premisa));

            $tipo_premisa_txt = 'tipo_' . str_replace('preg_id-'.$pregunta_id.'-', '', $preg_id_text);

            $preg = $preguntas->find($pregunta_id);

            $id_tipo_premisa = $preg->$tipo_premisa_txt;

            switch ($id_tipo_premisa) {
                case '1':
                    $valor_amor += $estrellas;
                    $item_amor++;
                    break;
                case '2':
                    $valor_no_violencia += $estrellas;
                    $item_no_violencia++;
                    break;
                case '3':
                    $valor_paz += $estrellas;
                    $item_paz++;
                    break;
                case '4':
                    $valor_rectitud += $estrellas;
                    $item_rectitud++;
                    break;
                case '5':
                    $valor_verdad += $estrellas;
                    $item_verdad++;
                    break;
                
                default:
                    break;
            }
        }

        $configuracion = PruebaValoresConfigEstandar::where('active', 1)->select('id')->orderBy('id', 'desc')->first();

        $respuestasPrueba = new PruebaValoresRespuestasGeneral();

        $respuestasPrueba->user_id          = $this->user->id;
        $respuestasPrueba->config_id        = $configuracion->id;
        $respuestasPrueba->fecha_respuesta  = date('Y-m-d');
        $respuestasPrueba->respuestas       = $respuestas_json;
        $respuestasPrueba->fotos            = $nombres_fotos;
        $respuestasPrueba->valor_amor       = $valor_amor;
        $respuestasPrueba->valor_paz        = $valor_paz;
        $respuestasPrueba->valor_rectitud   = $valor_rectitud;
        $respuestasPrueba->valor_verdad     = $valor_verdad;
        $respuestasPrueba->valor_no_violencia   = $valor_no_violencia;
        $respuestasPrueba->item_amor       = $item_amor;
        $respuestasPrueba->item_paz        = $item_paz;
        $respuestasPrueba->item_rectitud   = $item_rectitud;
        $respuestasPrueba->item_verdad     = $item_verdad;
        $respuestasPrueba->item_no_violencia   = $item_no_violencia;

        $respuestasPrueba->save();

        return response()->json(['success' => true]);
    }


    //Generar informe de la prueba
    public function pdf_prueba_valores_general($respuesta_id,$download=0)
    {
        $candidato_valores = PruebaValoresRespuestasGeneral::join('datos_basicos', 'datos_basicos.user_id', '=', 'prueba_valores_1_respuestas_general.user_id')
        ->join('users', 'users.id', '=', 'datos_basicos.user_id')
        ->leftjoin("tipo_identificacion", "tipo_identificacion.id", "=", "datos_basicos.tipo_id")
        ->where('prueba_valores_1_respuestas_general.id', $respuesta_id)
        ->select(
            'prueba_valores_1_respuestas_general.*',

            'datos_basicos.nombres',
            'datos_basicos.numero_id as cedula',
            'datos_basicos.fecha_nacimiento',
            'datos_basicos.telefono_movil as celular',
            'datos_basicos.email as correo',
            'datos_basicos.primer_apellido',
            'datos_basicos.segundo_apellido',

            'tipo_identificacion.descripcion as tipo_id_desc',

            'users.foto_perfil'
        )
        ->first();

        if ($candidato_valores == null) {
            return redirect()->back();
        }

        /*
        if (!Sentinel::inRole("admin") || !Sentinel::inRole("req")) {
            if ($this->user->id != $candidato_valores->user_id) {
                \Log::info('Intento de ver una prueba modulo CV, que no corresponde al usuario logueado');
                return redirect()->back();
            }
        }
        */

        $candidato_valores->nombre_completo = $candidato_valores->nombres . ' ' . $candidato_valores->primer_apellido . ($candidato_valores->segundo_apellido != null && $candidato_valores->segundo_apellido != '' ? " $candidato_valores->segundo_apellido" : '');

        $sitio_informacion = Sitio::first();

        //$concepto = PruebaBrigConcepto::where('bryg_id', $bryg_id)->first();

        $normas_nacionales = PruebaValoresNormasNacionales::first();

        $valores_obtenidos_normalizados = [
            "amor"          => $this->normalizacionDatos($candidato_valores->valor_amor, $normas_nacionales->promedio_amor, $normas_nacionales->desviacion_amor, 2),
            "no_violencia"  => $this->normalizacionDatos($candidato_valores->valor_no_violencia, $normas_nacionales->promedio_no_violencia, $normas_nacionales->desviacion_no_violencia, 2),
            "paz"           => $this->normalizacionDatos($candidato_valores->valor_paz, $normas_nacionales->promedio_paz, $normas_nacionales->desviacion_paz, 2),
            "rectitud"      => $this->normalizacionDatos($candidato_valores->valor_rectitud, $normas_nacionales->promedio_rectitud, $normas_nacionales->desviacion_rectitud, 2),
            "verdad"        => $this->normalizacionDatos($candidato_valores->valor_verdad, $normas_nacionales->promedio_verdad, $normas_nacionales->desviacion_verdad, 2)
        ];

        $maximos_normalizados = [
            "amor"          => $this->normalizacionDatos($candidato_valores->item_amor * 3, $normas_nacionales->promedio_amor, $normas_nacionales->desviacion_amor),
            "no_violencia"  => $this->normalizacionDatos($candidato_valores->item_no_violencia * 3, $normas_nacionales->promedio_no_violencia, $normas_nacionales->desviacion_no_violencia),
            "paz"           => $this->normalizacionDatos($candidato_valores->item_paz * 3, $normas_nacionales->promedio_paz, $normas_nacionales->desviacion_paz),
            "rectitud"      => $this->normalizacionDatos($candidato_valores->item_rectitud * 3, $normas_nacionales->promedio_rectitud, $normas_nacionales->desviacion_rectitud),
            "verdad"        => $this->normalizacionDatos($candidato_valores->item_verdad * 3, $normas_nacionales->promedio_verdad, $normas_nacionales->desviacion_verdad)
        ];

        //(Buscar el valor más alto)
        $valores_mayor = array_keys($valores_obtenidos_normalizados, max($valores_obtenidos_normalizados));

        $valores_menor = array_keys($valores_obtenidos_normalizados, min($valores_obtenidos_normalizados));

        $configuracion = PruebaValoresConfigEstandar::where('id', $candidato_valores->config_id)->first();

        $valores_ideal_grafico = [
            "amor"          => intval($configuracion->valor_amor),
            "no_violencia"  => intval($configuracion->valor_no_violencia),
            "paz"           => intval($configuracion->valor_paz),
            "rectitud"      => intval($configuracion->valor_rectitud),
            "verdad"        => intval($configuracion->valor_verdad)
        ];

        $valores_ideales_normalizados = [
            "amor"          => round($maximos_normalizados['amor'] * $configuracion->valor_amor / 100),
            "no_violencia"  => round($maximos_normalizados['no_violencia'] * $configuracion->valor_no_violencia / 100),
            "paz"           => round($maximos_normalizados['paz'] * $configuracion->valor_paz / 100),
            "rectitud"      => round($maximos_normalizados['rectitud'] * $configuracion->valor_rectitud / 100),
            "verdad"        => round($maximos_normalizados['verdad'] * $configuracion->valor_verdad / 100)
        ];

        $valores_cruzados = [
            "amor"          => $valores_obtenidos_normalizados['amor'] - $valores_ideales_normalizados['amor'],
            "no_violencia"  => $valores_obtenidos_normalizados['no_violencia'] - $valores_ideales_normalizados['no_violencia'],
            "paz"           => $valores_obtenidos_normalizados['paz'] - $valores_ideales_normalizados['paz'],
            "rectitud"      => $valores_obtenidos_normalizados['rectitud'] - $valores_ideales_normalizados['rectitud'],
            "verdad"        => $valores_obtenidos_normalizados['verdad'] - $valores_ideales_normalizados['verdad']
        ];

        $porcentaje_valores_obtenidos = [
            "amor"          => $this->obtenerPorcentaje($maximos_normalizados['amor'], $valores_obtenidos_normalizados['amor']),
            "no_violencia"  => $this->obtenerPorcentaje($maximos_normalizados['no_violencia'], $valores_obtenidos_normalizados['no_violencia']),
            "paz"           => $this->obtenerPorcentaje($maximos_normalizados['paz'], $valores_obtenidos_normalizados['paz']),
            "rectitud"      => $this->obtenerPorcentaje($maximos_normalizados['rectitud'], $valores_obtenidos_normalizados['rectitud']),
            "verdad"        => $this->obtenerPorcentaje($maximos_normalizados['verdad'], $valores_obtenidos_normalizados['verdad'])
        ];

        $porcentajes_cruzados = [
            "amor"          => $porcentaje_valores_obtenidos['amor'] - $valores_ideal_grafico['amor'],
            "no_violencia"  => $porcentaje_valores_obtenidos['no_violencia'] - $valores_ideal_grafico['no_violencia'],
            "paz"           => $porcentaje_valores_obtenidos['paz'] - $valores_ideal_grafico['paz'],
            "rectitud"      => $porcentaje_valores_obtenidos['rectitud'] - $valores_ideal_grafico['rectitud'],
            "verdad"        => $porcentaje_valores_obtenidos['verdad'] - $valores_ideal_grafico['verdad']
        ];

        $interpretacion = PruebaValoresInterpretacion::get();

        $textosCuantitativos = [
            'amor'          => $this->obtenerInterpretacion($interpretacion, $valores_obtenidos_normalizados['amor']),
            'no_violencia'  => $this->obtenerInterpretacion($interpretacion, $valores_obtenidos_normalizados['no_violencia']),
            'paz'           => $this->obtenerInterpretacion($interpretacion, $valores_obtenidos_normalizados['paz']),
            'rectitud'      => $this->obtenerInterpretacion($interpretacion, $valores_obtenidos_normalizados['rectitud']),
            'verdad'        => $this->obtenerInterpretacion($interpretacion, $valores_obtenidos_normalizados['verdad'])
        ];


        $area = PruebaValoresAreaImportante::first();

        $columna_mayor = $valores_mayor[0].'_mayor';
        $columna_menor = $valores_menor[0].'_menor';

        $area_mayor = $area->$columna_mayor;
        $area_menor = $area->$columna_menor;

        $area_mayor = str_replace('$nombre_candidato', $candidato_valores->nombre_completo, $area_mayor);
        $area_menor = str_replace('$nombre_candidato', $candidato_valores->nombre_completo, $area_menor);

        //dd($valores_ideal_grafico, $valores_ideales_normalizados, $valores_obtenidos_normalizados, $valores_cruzados, $area_mayor, $area_menor, $porcentaje_valores_obtenidos);
        //dd($porcentajes_cruzados);

        //Convertir fecha de realización a letras
        $fecha_realizacion_letra = $candidato_valores->formatoFecha($candidato_valores->fecha_respuesta);

        $candidato_edad = Carbon::parse($candidato_valores->fecha_nacimiento)->age;

        //Generar gráfico radar BRYG
        $grafico_radar_valores = [
            'type' => 'radar',
            'data' => [
                'labels' => ['AMOR', 'NO VIOLENCIA', 'PAZ', 'RECTITUD', 'VERDAD'],
                'datasets' => [
                    [
                        'backgroundColor' => [
                            'rgb(58, 181, 74)'
                        ],
                        'label' => 'Perfil Ideal',
                        'borderColor' => [
                            "rgb(58, 181, 74)"
                        ],
                        'data' => [
                            $valores_ideal_grafico['amor'],
                            $valores_ideal_grafico['no_violencia'],
                            $valores_ideal_grafico['paz'],
                            $valores_ideal_grafico['rectitud'],
                            $valores_ideal_grafico['verdad']
                        ],
                        'borderWidth' => 2,
                        'fill' => false
                    ],
                    [
                        'backgroundColor' => [
                            'rgb(114, 46, 135)'
                        ],
                        'label' => 'Perfil del Candidato',
                        'borderColor' => [
                            "rgb(114, 46, 135)"
                        ],
                        'data' => [
                            $porcentaje_valores_obtenidos['amor'],
                            $porcentaje_valores_obtenidos['no_violencia'],
                            $porcentaje_valores_obtenidos['paz'],
                            $porcentaje_valores_obtenidos['rectitud'],
                            $porcentaje_valores_obtenidos['verdad']
                        ],
                        'borderWidth' => 2,
                        'fill' => false
                    ]
                ]
            ],
            'options' => [
                //'legend' => ['display' => false],
                'title' => [
                    'display' => true,
                    'text' => 'Comparativa Perfil Ideal vs. Perfil del Candidato'
                ]
            ]
        ];

        if(!$download){
            return view('admin.prueba_valores_1.informe_valores_general', [
                "candidato_valores" => $candidato_valores,
                "sitio_informacion" => $sitio_informacion,

                //"concepto" => $concepto,
                "area_mayor" => $area_mayor,
                "area_menor" => $area_menor,
                "textos_cuantitativos" => $textosCuantitativos,

                "valores_ideal_grafico" => $valores_ideal_grafico, 
                "valores_ideales_normalizados" => $valores_ideales_normalizados,
                "valores_obtenidos_normalizados" => $valores_obtenidos_normalizados, 

                "valores_cruzados" => $valores_cruzados,
                "porcentajes_cruzados" => $porcentajes_cruzados,

                "porcentaje_valores_obtenidos" => $porcentaje_valores_obtenidos,

                "candidato_edad" => $candidato_edad,
                "fecha_evaluacion_letra" => $fecha_evaluacion_letra,
                "fecha_realizacion_letra" => $fecha_realizacion_letra,
                "grafico_radar_valores" => $grafico_radar_valores
            ]);
        }
        else{
            return \SnappyPDF::loadView('admin.prueba_valores_1.informe_valores_general', [
                "candidato_valores" => $candidato_valores,
                "sitio_informacion" => $sitio_informacion,

                //"concepto" => $concepto,
                "area_mayor" => $area_mayor,
                "area_menor" => $area_menor,
                "textos_cuantitativos" => $textosCuantitativos,

                "valores_ideal_grafico" => $valores_ideal_grafico, 
                "valores_ideales_normalizados" => $valores_ideales_normalizados,
                "valores_obtenidos_normalizados" => $valores_obtenidos_normalizados, 

                "valores_cruzados" => $valores_cruzados,
                "porcentajes_cruzados" => $porcentajes_cruzados,

                "porcentaje_valores_obtenidos" => $porcentaje_valores_obtenidos,

                "candidato_edad" => $candidato_edad,
                "fecha_evaluacion_letra" => $fecha_evaluacion_letra,
                "fecha_realizacion_letra" => $fecha_realizacion_letra,
                "grafico_radar_valores" => $grafico_radar_valores
            ])
            ->output();

            //->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            //->stream('informe-resultado-ethical-values.pdf');
        }
    }

    protected function normalizacionDatos($obtenido, $promedio, $desviacion, $division = 1) {
        $total = 0;
        if ($desviacion != 0 && $division != 0) {
            //logger("ob $obtenido; prom $promedio; desv $desviacion");
            //Se divide entre 2 porque la formula esta en base de 3 puntos y nosotros en 6 estrellas
            $total = round((50 + (((($obtenido / $division) - $promedio) / $desviacion) * 10)), 0);
        }
        //logger("t $total");
        return $total;
    }

    protected function obtenerInterpretacion($interpretaciones, $valor) {
        $interpretacionValor = null;
        foreach ($interpretaciones as $key => $interpretacion) {
            $interpretacionValor = $interpretacion->where('rango_inferior', '<=', $valor)->where('rango_superior', '>', $valor)->first();
            if ($interpretacionValor != null) {
                return $interpretacionValor;
            }
        }
        return '';
    }

    protected function obtenerPorcentaje($maximo, $buscar, $base = 100) {
        $porc = 0;
        if ($maximo != 0) {
            $porc = round($buscar * $base / $maximo);
        }
        return $porc;
    }
}
