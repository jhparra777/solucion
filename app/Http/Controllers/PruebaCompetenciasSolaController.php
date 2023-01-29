<?php

namespace App\Http\Controllers;

use PDF;

use File;
use Storage;

use SnappyPDF;
use Carbon\Carbon;
use triPostmaster;
use App\Models\User;
use App\Models\Sitio;

use App\Http\Requests;
use App\Models\DatosBasicos;
use Illuminate\Http\Request;
use App\Models\Requerimiento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\PruebaCompetenciaReq;
use Illuminate\Support\Facades\Mail;
use App\Models\PruebaCompetenciaCargo;
use App\Models\PruebaCompetenciaCompetencia;
use App\Models\PruebaCompetenciaTotal;

use App\Models\PruebaCompetenciaDirecta;
use App\Models\PruebaCompetenciaInversa;
use App\Models\PruebaCompetenciaConcepto;

use App\Models\PruebaCompetenciaSolaFoto;

use App\Models\PruebaCompetenciaResultado;
use App\Models\PruebaCompetenciaSolaTotal;
use App\Models\PruebaCompetenciaSolaResultado;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Models\PruebaCompetenciaSolaConfiguracion;
use App\Models\PruebaCompetenciaSolaCandidatoHistorico;

class PruebaCompetenciasSolaController extends Controller
{
    public function __construct(){
        parent::__construct();

        $this->meses = [
            1  => "Enero",
            2  => "Febrero",
            3  => "Marzo",
            4  => "Abril",
            5  => "Mayo",
            6  => "Junio",
            7  => "Julio",
            8  => "Agosto",
            9  => "Septiembre",
            10 => "Octubre",
            11 => "Noviembre",
            12 => "Diciembre"
        ];
    }

    public function index(Request $data)
    {
        if(empty($this->user->id)){
            session(["url_deseada_redireccion_candidato" => url($_SERVER['REQUEST_URI'])]);
            return redirect()->route('login');
        }

        $check_test = PruebaCompetenciaSolaResultado::where('user_id', $this->user->id)->where('estado', 0)->orderBy('created_at', 'DESC')->first();

        if(!empty($check_test)){
            return redirect()->route('dashboard')->with('no_prueba', 'Actualmente no tienes pruebas a realizar.');
        }

        $name_user = DatosBasicos::where('user_id', $this->user->id)
        ->select('datos_basicos.nombres', DB::raw("CONCAT(datos_basicos.nombres,' ',datos_basicos.primer_apellido) AS nombre_candidato"))
        ->first();

        $sitio = Sitio::first();
        $user = User::find($this->user->id);

        return view('cv.pruebas.competencias-sola.prueba_competencias_index', compact('sitio', 'user', 'name_user'));
    }

    public function start(Request $data)
    {
        if(empty($this->user->id)) {
            session(["url_deseada_redireccion_candidato" => url($_SERVER['REQUEST_URI'])]);
            return redirect()->route('login');
        }

        $check_test = PruebaCompetenciaSolaResultado::where('user_id', $this->user->id)->where('estado', 0)->orderBy('created_at', 'DESC')->first();

        if(!empty($check_test)){
            return redirect()->route('dashboard')->with('no_prueba', 'Actualmente no tienes pruebas a realizar.');
        }

        $sitio = Sitio::first();
        $user = User::find($this->user->id);
        // $requerimientoId = $check_test->req_id;

        //Buscar configuración
        $configuracionPrueba = PruebaCompetenciaSolaConfiguracion::all();

        // if (count($configuracionPrueba) <= 0) {
        //     $requerimiento = Requerimiento::where('id', $requerimientoId)->select('cargo_especifico_id')->first();
        //     $configuracionPrueba = PruebaCompetenciaCargo::where('cargo_id', $requerimiento->cargo_especifico_id)->get();
        // }

        $directasCompetencia = [];
        $directasNivel = [];

        foreach ($configuracionPrueba as $configuracion) {
            array_push($directasCompetencia, $configuracion->competencia_id);
            array_push($directasNivel, $configuracion->nivel_cargo);
        }

        // $directas = PruebaCompetenciaDirecta::whereIn('nivel_cargo', array_unique($directasNivel))->whereIn('competencia_id', $directasCompetencia)->groupBy('descripcion')->orderByRaw("RAND()")->get();

        $directas1 = PruebaCompetenciaDirecta::where('nivel_cargo', 4)->orderByRaw("RAND()")->get();

        $directas2 = PruebaCompetenciaDirecta::where('nivel_cargo', 5)->whereIn('competencia_id', [5, 7])->orderByRaw("RAND()")->get();

        $directas3 = PruebaCompetenciaDirecta::where('nivel_cargo', 1)->whereIn('competencia_id', [9])->orderByRaw("RAND()")->get();

        $directas = collect();
        $directasIds = [];

        foreach ($directas2 as $directa) {
            array_push($directasIds, $directa->id);

            $directas->push($directa);
        }

        foreach ($directas1 as $directa) {
            array_push($directasIds, $directa->id);

            $directas->push($directa);
        }

        foreach ($directas3 as $directa) {
            array_push($directasIds, $directa->id);

            $directas->push($directa);
        }

        $inversas = PruebaCompetenciaInversa::whereIn('directa_id', $directasIds)->orderByRaw("RAND()")->get();

        $totalPreguntas = collect();

        foreach ($directas as $key => $directa) {
            $totalPreguntas->push($directa);
            $totalPreguntas->push($inversas[$key]);
        }

        return view('cv.pruebas.competencias-sola.prueba_competencias', compact('sitio', 'user', 'requerimientoId', 'totalPreguntas'));
    }

    public function store(Request $data)
    {
        $userId = $data->userId;
        $sitio = Sitio::first();

        $inversas = $data->inversas;
        $preguntas_id = $data->preguntas_id;
        $competencias_id = $data->competencias_id;
        $codigos = $data->codigos;

        //Crear prueba
        $pruebaCompetencias = PruebaCompetenciaSolaResultado::where('user_id', $userId)->orderBy('created_at', 'DESC')->first();

        //Buscar configuración
        $configuracionPrueba = PruebaCompetenciaSolaConfiguracion::all();

        //Sumar totales de las competencias
        $resultadoTotalCompetencias = [];

        for($i = 0; $i < count($inversas); $i++) {
            //Filtrar solo las directas
            if($inversas[$i] != 1) {
                $resultadoTotalCompetencias[$competencias_id[$i]] = $data["pregunta_$codigos[$i]"] + $resultadoTotalCompetencias[$competencias_id[$i]];
            }
        }

        //Calcular desfases de los totales
        $resultadosTotalDesfases = [];

        foreach ($configuracionPrueba as $key => $configuracion) {
            $desfase = $resultadoTotalCompetencias[$configuracion->competencia_id] - $configuracion->nivel_esperado;

            $resultadosTotalDesfases[$configuracion->competencia_id] = number_format($desfase, 1);
        }

        //Calcular desfases de los totales y convirtiendo a abs
        $resultadosTotalDesfasesAbsolutos = [];

        foreach ($configuracionPrueba as $key => $configuracion) {
            $desfaseAbs = abs($resultadoTotalCompetencias[$configuracion->competencia_id] - $configuracion->nivel_esperado);

            $resultadosTotalDesfasesAbsolutos[$configuracion->competencia_id] = number_format($desfaseAbs, 1);
        }

        //Calcular ajuste al perfil por cada competencia
        $resultadosAjustesPerfiles = [];

        foreach ($configuracionPrueba as $key => $configuracion) {
            $ajustePerfil = 100 - $resultadosTotalDesfasesAbsolutos[$configuracion->competencia_id].'%';

            $resultadosAjustesPerfiles[$configuracion->competencia_id] = $ajustePerfil;
        }

        //Calcular factor y ajuste perfil global
        $ajustePerfilGlobal = number_format(array_sum($resultadosAjustesPerfiles) / count($resultadosAjustesPerfiles), 1);
        $factorGlobalDesfase = number_format(array_sum($resultadosTotalDesfases) / count($resultadosTotalDesfases), 1);

        // Log::debug(json_encode($resultadoTotalCompetencias));
        // Log::debug(json_encode($resultadosTotalDesfases));
        // Log::debug(json_encode($resultadosTotalDesfasesAbsolutos));
        // Log::debug(json_encode($resultadosAjustesPerfiles));
        // Log::debug(json_encode($ajustePerfilGlobal));
        // Log::debug(json_encode($factorGlobalDesfase));

        //Guardar resultados totales de todas las competencias
        ksort($resultadoTotalCompetencias);

        foreach($resultadoTotalCompetencias as $key => $total) {
            $competenciaTotal = new PruebaCompetenciaSolaTotal();

            $competenciaTotal->fill([
                'prueba_id' => $pruebaCompetencias->id,
                'user_id' => $userId,
                'competencia_id' => $key,
                'calificacion_obtenida' => $total,
                'desfase' => $resultadosTotalDesfases[$key],
                'desfase_absoluto' => $resultadosTotalDesfasesAbsolutos[$key],
                'ajuste_perfil' => $resultadosAjustesPerfiles[$key]
            ]);
            $competenciaTotal->save();
        }

        //Actualizar prueba resultado
        $pruebaCompetencias->ajuste_global = $ajustePerfilGlobal;
        $pruebaCompetencias->factor_desfase_global = $factorGlobalDesfase;
        $pruebaCompetencias->estado = 1;
        $pruebaCompetencias->fecha_realizacion = date('Y-m-d');
        $pruebaCompetencias->save();

        /**
         * Guardar historial
         */

        $respuestas = $data->except(['userId', 'inversas', 'preguntas_id', 'competencias_id', 'codigos']);

        foreach ($respuestas as $key => $value) {
            switch ($value) {
                case 15:
                    $opcion = 'Siempre';
                    break;
                case 12:
                    $opcion = 'Casi siempre';
                    break;
                case 9:
                    $opcion = 'Algunas veces';
                    break;
                case 6:
                    $opcion = 'Casi nunca';
                    break;
                case 3:
                    $opcion = 'Nunca';
                    break;
            }

            $codigo_pregunta = strstr($key, 'C');

            $pregunta_prueba = PruebaCompetenciaDirecta::where('codigo', 'like', "%$codigo_pregunta%")->select('descripcion', 'competencia_id')->first();

            if (empty($pregunta_prueba)) {
                $pregunta_prueba = PruebaCompetenciaInversa::leftjoin('prueba_competencias_preguntas_directas', 'prueba_competencias_preguntas_directas.id', '=', 'prueba_competencias_preguntas_inversas.directa_id')
                ->where('prueba_competencias_preguntas_inversas.codigo', 'like', "%$codigo_pregunta%")
                ->select('prueba_competencias_preguntas_inversas.descripcion', 'prueba_competencias_preguntas_directas.competencia_id')
                ->first();
            }

            $historico = new PruebaCompetenciaSolaCandidatoHistorico();

            $historico->fill([
                'user_id' => $userId,
                'prueba_id' => $pruebaCompetencias->id,
                'competencia_id' => $pregunta_prueba->competencia_id,
                'codigo_pregunta' => $codigo_pregunta,
                'pregunta' => $pregunta_prueba->descripcion,
                'opcion' => $opcion,
                'valor' => $value
            ]);

            $historico->save();
        }

        //Crear variables en la sesión para marcar el final de la prueba
        $data->session()->put('finalDigitacion', true);

        return response()->json([
            'success' => true
        ]);
    }

    public function guardar_fotos(Request $data)
    {
        //Buscar prueba
        // $pruebaCompetencias = PruebaCompetenciaSolaResultado::where('user_id', $data->userId)
        // ->select('id', 'created_at')
        // ->orderBy('created_at', 'DESC')
        // ->first();

        $pruebaCompetencias = PruebaCompetenciaSolaResultado::create(['user_id' => $this->user->id]);

        $user_id = $data->userId;
        // $req_id = $data->requerimientoId;

        //Fotos
        $psImagenes = json_decode($data->psImagenes, true);

        //Borrar primera foto del arreglo, porque no tiene información
        unset($psImagenes[0]);

        for($i = 1; $i <= count($psImagenes); $i++) {
            //Se verifica que la imagen tenga datos
            if ($psImagenes[$i]['picture'] != null && $psImagenes[$i]['picture'] != '' && $psImagenes[$i]['picture'] != 'data:,') {
                //Convertir base64 a PNG
                $image_parts = explode(";base64,", $psImagenes[$i]['picture']);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $fotoNombre = "candidato-foto-$i-$user_id-$pruebaCompetencias->id.png";

                Storage::disk('public')
                    ->put("recursos_prueba_ps_sola/prueba_ps_sola_$user_id"."_"."$pruebaCompetencias->id/$fotoNombre", $image_base64);

                //Guardar referencia foto en la tabla
                $psFoto = new PruebaCompetenciaSolaFoto();

                $psFoto->fill([
                    'prueba_id' => $pruebaCompetencias->id,
                    'user_id' => $user_id,
                    // 'req_id' => $req_id,
                    'descripcion' => $fotoNombre
                ]);
                $psFoto->save();
            }
        }
    }

    /*
     * ADMIN
    */
    public function informe_prueba_competencias($prueba_id, $download = 0)
    {
        $candidato_prueba = PruebaCompetenciaSolaResultado::join('datos_basicos', 'datos_basicos.user_id', '=', 'prueba_competencias_sola_resultados.user_id')
        ->join('users', 'users.id', '=', 'datos_basicos.user_id')
        ->where('prueba_competencias_sola_resultados.id', $prueba_id)
        ->select(
            'prueba_competencias_sola_resultados.*',

            'datos_basicos.nombres',
            'datos_basicos.primer_apellido',
            'datos_basicos.numero_id as cedula',
            'datos_basicos.fecha_nacimiento',
            'datos_basicos.telefono_movil as celular',
            'datos_basicos.email as correo',
            DB::raw("CONCAT(datos_basicos.nombres,' ',datos_basicos.primer_apellido,' ',datos_basicos.segundo_apellido) AS nombre_completo"),

            'users.foto_perfil'
        )
        ->first();

        if (empty($candidato_prueba)) {
            return redirect()->back();
        }

        /*
        if (!Sentinel::inRole("admin") || !Sentinel::inRole("req")) {
            if ($this->user->id != $candidato_prueba->user_id) {
                \Log::info('Intento de ver una prueba ps modulo CV, que no corresponde al usuario logueado');
                return redirect()->back();
            }
        }
        */

        $totales_prueba = PruebaCompetenciaSolaTotal::join('prueba_competencias_competencia', 'prueba_competencias_competencia.id', '=', 'prueba_competencias_sola_totales.competencia_id')
        ->where('prueba_id', $candidato_prueba->id)
        ->where('user_id', $candidato_prueba->user_id)
        ->orderBy('prueba_competencias_sola_totales.competencia_id', 'ASC')
        ->get();

        $pskills_fotos = PruebaCompetenciaSolaFoto::where('prueba_id', $prueba_id)
        ->where('user_id', $candidato_prueba->user_id)
        // ->where('req_id', $candidato_prueba->req_id)
        ->orderBy('id', 'DESC')
        ->get();

        //Competencias ajustes
        $sobresalientes = [];
        $sobresalientesDesc = [];

        foreach ($totales_prueba as $total) {
            $sobresalientes[$total->ajuste_perfil] = $total->ajuste_perfil;
            $sobresalientesDesc[$total->ajuste_perfil] = $total->descripcion;
            $sobresalientesDefinicion[$total->ajuste_perfil] = $total->definicion;
        }

        //Más altos
            $sobresalienteA = array_keys($sobresalientes, max($sobresalientes));
            unset($sobresalientes[$sobresalienteA[0]]);

            $sobresalienteB = array_keys($sobresalientes, max($sobresalientes));
            unset($sobresalientes[$sobresalienteB[0]]);
        //

        //Más bajos
            $desarrollarA = array_keys($sobresalientes, min($sobresalientes));
            unset($sobresalientes[$desarrollarA[0]]);

            $desarrollarB = array_keys($sobresalientes, min($sobresalientes));
            unset($sobresalientes[$desarrollarB[0]]);
        //

        //Buscar configuración
        $configuracionPrueba = PruebaCompetenciaSolaConfiguracion::all();

        // if (!count($configuracionPrueba) > 0) {
        //     $requerimiento = Requerimiento::where('id', $candidato_prueba->req_id)->select('cargo_especifico_id')->first();
        //     $configuracionPrueba = PruebaCompetenciaCargo::where('cargo_id', $requerimiento->cargo_especifico_id)->orderBy('competencia_id', 'ASC')->get();
        // }

        $sitio_informacion = Sitio::first();

        //Convertir fecha de solicitud a letras
        $fecha_evaluacion = explode('-', date('Y-m-d', strtotime($candidato_prueba->created_at)));
        $fecha_evaluacion_letra = "$fecha_evaluacion[2] de ".$this->meses[(int) $fecha_evaluacion[1]]." del $fecha_evaluacion[0]";

        //Convertir fecha de realización a letras
        $fecha_realizacion = explode('-', date('Y-m-d', strtotime($candidato_prueba->fecha_realizacion)));
        $fecha_realizacion_letra = "$fecha_realizacion[2] de ".$this->meses[(int) $fecha_realizacion[1]]." del $fecha_realizacion[0]";

        $candidato_edad = Carbon::parse($candidato_prueba->fecha_nacimiento)->age;

        $requerimiento_detalle = Requerimiento::where('requerimientos.id', $candidato_prueba->req_id)->first();

        /*Validar ruta para local*/
        if (route('home') == 'http://localhost:8000') {
            //$url = 'https://desarrollo.t3rsc.co/assets/admin/tests/ps-skills/';
        }else {
            //$url = asset('assets/admin/tests/ps-skills').'/';
        }

        $url = asset('assets/admin/tests/ps-skills').'/';

        if(!$download) {
            return view('cv.pruebas.competencias-sola.pdf.informe_resultado_competencias_new', [
                "candidato_prueba" => $candidato_prueba,
                "totales_prueba" => $totales_prueba,
                "pskills_fotos" => $pskills_fotos,
                "sobresalientesDesc" => $sobresalientesDesc,
                "sobresalientesDefinicion" => $sobresalientesDefinicion,
                "sobresalienteA" => $sobresalienteA,
                "sobresalienteB" => $sobresalienteB,
                "desarrollarA" => $desarrollarA,
                "desarrollarB" => $desarrollarB,
                "configuracionPrueba" => $configuracionPrueba,
                "sitio_informacion" => $sitio_informacion,
                "candidato_edad" => $candidato_edad,
                "fecha_evaluacion_letra" => $fecha_evaluacion_letra,
                "fecha_realizacion_letra" => $fecha_realizacion_letra,
                "requerimiento_detalle" => $requerimiento_detalle,
                "url" => $url
            ]);
        }
        else {
            $img_base64_referencia_puntaje = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencias-referencia-puntaje-crop.txt');
            $img_base64_t3rs_without_bg = file_get_contents('assets/admin/tests/ps-skills/text_base64/t3rs-without-bg.txt');

            /**
             * Validando resultados para devolver base64 correspondiente
             */

            if ($candidato_prueba->factor_desfase_global < 0) {
                $img_base64_negativo_positivo = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencias-negativo.txt');
            } else {
                $img_base64_negativo_positivo = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencias-positivo.txt');
            }

            /**
             * Gráfico circular
             */

            if($candidato_prueba->ajuste_global < 25) {
                $img_base64_barra_circular = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencia-barra-circular-01.txt');

            } elseif($candidato_prueba->ajuste_global >= 25 && $candidato_prueba->ajuste_global <= 50) {
                $img_base64_barra_circular = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencia-barra-circular-00.txt');

            } elseif($candidato_prueba->ajuste_global >= 50 && $candidato_prueba->ajuste_global <= 75) {

                if($candidato_prueba->ajuste_global > 50 && $candidato_prueba->ajuste_global <= 55) {
                    $img_base64_barra_circular = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencia-barra-circular-02.txt');

                } elseif($candidato_prueba->ajuste_global > 55 && $candidato_prueba->ajuste_global <= 58) {
                    $img_base64_barra_circular = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencia-barra-circular-03.txt');

                } elseif($candidato_prueba->ajuste_global > 58 && $candidato_prueba->ajuste_global <= 64) {
                    $img_base64_barra_circular = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencia-barra-circular-04.txt');

                } elseif($candidato_prueba->ajuste_global > 64 && $candidato_prueba->ajuste_global <= 68) {
                    $img_base64_barra_circular = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencia-barra-circular-05.txt');

                } elseif($candidato_prueba->ajuste_global > 68 && $candidato_prueba->ajuste_global <= 72) {
                    $img_base64_barra_circular = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencia-barra-circular-06.txt');

                } elseif($candidato_prueba->ajuste_global > 72 && $candidato_prueba->ajuste_global <= 75) {
                    $img_base64_barra_circular = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencia-barra-circular-07.txt');
                }

            } elseif($candidato_prueba->ajuste_global >= 75 && $candidato_prueba->ajuste_global <= 100) {

                if($candidato_prueba->ajuste_global > 75 && $candidato_prueba->ajuste_global <= 78) {
                    $img_base64_barra_circular = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencia-barra-circular-08.txt');

                } elseif($candidato_prueba->ajuste_global > 78 && $candidato_prueba->ajuste_global <= 80) {
                    $img_base64_barra_circular = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencia-barra-circular-09.txt');

                } elseif($candidato_prueba->ajuste_global > 80 && $candidato_prueba->ajuste_global <= 84) {
                    $img_base64_barra_circular = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencia-barra-circular-10.txt');

                } elseif($candidato_prueba->ajuste_global > 84 && $candidato_prueba->ajuste_global <= 94) {
                    $img_base64_barra_circular = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencia-barra-circular-11.txt');

                } elseif($candidato_prueba->ajuste_global > 94 && $candidato_prueba->ajuste_global <= 100) {
                    $img_base64_barra_circular = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencia-barra-circular-12.txt');
                }
            }

            /**
             * Competencias sobresalientes
             */

            if($sobresalienteA[0] > 0 && $sobresalienteA[0] <= 24) {
                $img_base64_barra_turned_sobresalienteA = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencias-graf-turned-1.txt');

            } elseif($sobresalienteA[0] >= 25 && $sobresalienteA[0] <= 50) {
                $img_base64_barra_turned_sobresalienteA = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencias-graf-turned-2.txt');

            } elseif($sobresalienteA[0] > 50 && $sobresalienteA[0] <= 75) {
                $img_base64_barra_turned_sobresalienteA = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencias-graf-turned-3.txt');

            } elseif($sobresalienteA[0] > 75 && $sobresalienteA[0] <= 100) {
                $img_base64_barra_turned_sobresalienteA = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencias-graf-turned-4.txt');
            }

            /**
             * 
             */
            
            if($desarrollarA[0] > 0 && $desarrollarA[0] <= 24) {
                $img_base64_barra_turned_desarrollarA = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencias-graf-turned-1.txt');

            } elseif($desarrollarA[0] >= 25 && $desarrollarA[0] <= 50) {
                $img_base64_barra_turned_desarrollarA = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencias-graf-turned-2.txt');

            } elseif($desarrollarA[0] > 50 && $desarrollarA[0] <= 75) {
                $img_base64_barra_turned_desarrollarA = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencias-graf-turned-3.txt');

            } elseif($desarrollarA[0] > 75 && $desarrollarA[0] <= 100) {
                $img_base64_barra_turned_desarrollarA = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencias-graf-turned-4.txt');
            }

            /**
             * 
             */

            if($sobresalienteB[0] > 0 && $sobresalienteB[0] <= 24) {
                $img_base64_barra_turned_sobresalienteB = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencias-graf-turned-1.txt');

            } elseif($sobresalienteB[0] >= 25 && $sobresalienteB[0] <= 50) {
                $img_base64_barra_turned_sobresalienteB = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencias-graf-turned-2.txt');

            } elseif($sobresalienteB[0] > 50 && $sobresalienteB[0] <= 75) {
                $img_base64_barra_turned_sobresalienteB = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencias-graf-turned-3.txt');

            } elseif($sobresalienteB[0] > 75 && $sobresalienteB[0] <= 100) {
                $img_base64_barra_turned_sobresalienteB = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencias-graf-turned-4.txt');
            }

            /**
             * 
             */

            if($desarrollarB[0] > 0 && $desarrollarB[0] <= 24) {
                $img_base64_barra_turned_desarrollarB = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencias-graf-turned-1.txt');

            } elseif($desarrollarB[0] >= 25 && $desarrollarB[0] <= 50) {
                $img_base64_barra_turned_desarrollarB = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencias-graf-turned-2.txt');

            } elseif($desarrollarB[0] > 50 && $desarrollarB[0] <= 75) {
                $img_base64_barra_turned_desarrollarB = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencias-graf-turned-3.txt');

            } elseif($desarrollarB[0] > 75 && $desarrollarB[0] <= 100) {
                $img_base64_barra_turned_desarrollarB = file_get_contents('assets/admin/tests/ps-skills/text_base64/competencias-graf-turned-4.txt');
            }

            return SnappyPDF::loadView('cv.pruebas.competencias-sola.pdf.informe_resultado_competencias', [
                "candidato_prueba" => $candidato_prueba,
                "totales_prueba" => $totales_prueba,
                "pskills_fotos" => $pskills_fotos,
                "sobresalientesDesc" => $sobresalientesDesc,
                "sobresalientesDefinicion" => $sobresalientesDefinicion,
                "sobresalienteA" => $sobresalienteA,
                "sobresalienteB" => $sobresalienteB,
                "desarrollarA" => $desarrollarA,
                "desarrollarB" => $desarrollarB,
                "configuracionPrueba" => $configuracionPrueba,
                "sitio_informacion" => $sitio_informacion,
                "candidato_edad" => $candidato_edad,
                "fecha_evaluacion_letra" => $fecha_evaluacion_letra,
                "fecha_realizacion_letra" => $fecha_realizacion_letra,
                "requerimiento_detalle" => $requerimiento_detalle,
                "url" => $url,
                "img_base64_referencia_puntaje" => $img_base64_referencia_puntaje,
                "img_base64_t3rs_without_bg" => $img_base64_t3rs_without_bg,
                "img_base64_negativo_positivo" => $img_base64_negativo_positivo,
                "img_base64_barra_circular" => $img_base64_barra_circular,
                "img_base64_barra_turned_sobresalienteA" => $img_base64_barra_turned_sobresalienteA,
                "img_base64_barra_turned_desarrollarA" => $img_base64_barra_turned_desarrollarA,
                "img_base64_barra_turned_sobresalienteB" => $img_base64_barra_turned_sobresalienteB,
                "img_base64_barra_turned_desarrollarB" => $img_base64_barra_turned_desarrollarB
            ])
            ->output();
            //->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            //->stream("informe-personal-skills-".$candidato_prueba->req_id."-".explode(" ", $candidato_prueba->nombres)[0]."-".$candidato_prueba->primer_apellido.".pdf");
        }
    }

    public function informe_prueba_competencias_preview($prueba_id, $req_id, $user_id)
    {        
        $candidato_prueba = DatosBasicos::join('users', 'users.id', '=', 'datos_basicos.user_id')
        ->where('users.id', $user_id)
        ->select(
            'datos_basicos.nombres',
            'datos_basicos.primer_apellido',
            'datos_basicos.numero_id as cedula',
            'datos_basicos.fecha_nacimiento',
            'datos_basicos.telefono_movil as celular',
            'datos_basicos.email as correo',
            DB::raw("CONCAT(datos_basicos.nombres,' ',datos_basicos.primer_apellido,' ',datos_basicos.segundo_apellido) AS nombre_completo"),

            'users.foto_perfil'
        )
        ->first();

        //Buscar configuración
        $configuracionPrueba = PruebaCompetenciaReq::where('req_id', $req_id)->get();

        if (!count($configuracionPrueba) > 0) {
            $requerimiento = Requerimiento::where('id', $req_id)->select('cargo_especifico_id')->first();
            $configuracionPrueba = PruebaCompetenciaCargo::where('cargo_id', $requerimiento->cargo_especifico_id)->get();
        }

        $configuracion_competencias_ids = [];

        foreach ($configuracionPrueba as $value) {
            array_push($configuracion_competencias_ids, $value->competencia_id);
        }

        /**
         * Buscar el historial de las respuestas
         */
        $historico_prueba_sola = PruebaCompetenciaSolaCandidatoHistorico::where('user_id', $user_id)->whereIn('competencia_id', $configuracion_competencias_ids)->orderByRaw('LENGTH(codigo_pregunta), codigo_pregunta asc')->get();

        $preguntas_codigos = [];
        $preguntas_opcion_valor = [];
        $competencias_ids = [];

        /**
         * Recorrer las preguntas respondidas del historial
         */
        foreach ($historico_prueba_sola as $key => $historico) {
            //Solo se tiene en cuenta las preguntas que son directas
            if (preg_match('/-D/', $historico->codigo_pregunta)) {
                array_push($preguntas_codigos, $historico->codigo_pregunta);
                array_push($preguntas_opcion_valor, $historico->valor);
            }
        }

        /**
         * Buscar las preguntas directas por el código y seleccionar solo el id de la competencia
         */
        $preguntas_dir_competencias = PruebaCompetenciaDirecta::whereIn('codigo', $preguntas_codigos)->select('competencia_id')->get();

        foreach ($preguntas_dir_competencias as $key => $pregunta) {
            //Insertar los ids en el arreglo
            array_push($competencias_ids, $pregunta->competencia_id);
        }

        //Sumar totales de las competencias
        $resultado_total_competencias = [];

        for ($i = 0; $i < count($preguntas_codigos); $i++) {
            /**
             * - Se usa el id de la competencia como indice de cada elemento
             * - Se busca el código de la pregunta en el arreglo
             */
            $resultado_total_competencias[$competencias_ids[$i]] = $preguntas_opcion_valor[$i] + $resultado_total_competencias[$competencias_ids[$i]];
        }

        //Buscar configuración
        $configuracion_prueba = PruebaCompetenciaReq::where('req_id', $req_id)->get();

        if (!count($configuracion_prueba) > 0) {
            $requerimiento = Requerimiento::where('id', $req_id)->select('cargo_especifico_id')->first();
            $configuracion_prueba = PruebaCompetenciaCargo::where('cargo_id', $requerimiento->cargo_especifico_id)->get();
        }

        //Calcular desfases de los totales
        $resultados_total_desfases = [];

        foreach ($configuracion_prueba as $key => $configuracion) {
            /**
             * - Se busca el resultado total de la competencia en los totales por el id de la competencia de la configuración
             * - Se le resta al total el nivel esperado de la configuración
             */

            $desfase = $resultado_total_competencias[$configuracion->competencia_id] - $configuracion->nivel_esperado;

            /**
             * - Se crea un elemento con la competencia como indice y se le asigna el desfase resultante
             */
            $resultados_total_desfases[$configuracion->competencia_id] = number_format($desfase, 1);
        }

        //Calcular desfases de los totales y convirtiendo a abs
        $resultado_total_desfases_absolutos = [];

        foreach ($configuracion_prueba as $key => $configuracion) {
            $desfaseAbs = abs($resultado_total_competencias[$configuracion->competencia_id] - $configuracion->nivel_esperado);

            $resultado_total_desfases_absolutos[$configuracion->competencia_id] = number_format($desfaseAbs, 1);
        }

        //Calcular ajuste al perfil por cada competencia
        $resultados_ajustes_perfiles = [];

        foreach ($configuracion_prueba as $key => $configuracion) {
            $ajustePerfil = 100 - $resultado_total_desfases_absolutos[$configuracion->competencia_id].'%';

            $resultados_ajustes_perfiles[$configuracion->competencia_id] = $ajustePerfil;
        }

        //Calcular factor y ajuste perfil global
        $ajuste_perfil_global = number_format(array_sum($resultados_ajustes_perfiles) / count($resultados_ajustes_perfiles), 1);
        $factor_global_desfase = number_format(array_sum($resultados_total_desfases) / count($resultados_total_desfases), 1);

        //Ordenar el arreglo
        ksort($resultado_total_competencias);

        $competencias_datos = PruebaCompetenciaCompetencia::whereIn('id', array_unique($competencias_ids))->get();
        $totales_prueba = [];

        foreach ($competencias_datos as $competencia) {
            $totales_prueba[] = (object) [
                'ajuste_perfil' => $resultados_ajustes_perfiles[$competencia->id],
                'descripcion' => $competencia->descripcion,
                'definicion' => $competencia->definicion,
                'competencia_id' => $competencia->id,
                'desfase' => $resultados_total_desfases[$competencia->id]
            ];
        }

        // $totales_prueba = PruebaCompetenciaSolaTotal::join('prueba_competencias_competencia', 'prueba_competencias_competencia.id', '=', 'prueba_competencias_sola_totales.competencia_id')
        // ->where('prueba_id', $candidato_prueba->id)
        // ->where('user_id', $candidato_prueba->user_id)
        // ->orderBy('prueba_competencias_sola_totales.competencia_id', 'ASC')
        // ->get();

        //Competencias ajustes
        $sobresalientes = [];
        $sobresalientesDesc = [];

        foreach ($totales_prueba as $total) {
            $sobresalientes[$total->ajuste_perfil] = $total->ajuste_perfil;
            $sobresalientesDesc[$total->ajuste_perfil] = $total->descripcion;
            $sobresalientesDefinicion[$total->ajuste_perfil] = $total->definicion;
        }

        //Más altos
            $sobresalienteA = array_keys($sobresalientes, max($sobresalientes));
            unset($sobresalientes[$sobresalienteA[0]]);

            $sobresalienteB = array_keys($sobresalientes, max($sobresalientes));
            unset($sobresalientes[$sobresalienteB[0]]);
        //

        //Más bajos
            $desarrollarA = array_keys($sobresalientes, min($sobresalientes));
            unset($sobresalientes[$desarrollarA[0]]);

            $desarrollarB = array_keys($sobresalientes, min($sobresalientes));
            unset($sobresalientes[$desarrollarB[0]]);
        //


        //Buscar configuración -
        $configuracionPrueba = PruebaCompetenciaReq::where('req_id', $req_id)->orderBy('competencia_id', 'ASC')->get();

        if (!count($configuracionPrueba) > 0) {
            $requerimiento = Requerimiento::where('id', $req_id)->select('cargo_especifico_id')->first();
            $configuracionPrueba = PruebaCompetenciaCargo::where('cargo_id', $requerimiento->cargo_especifico_id)->orderBy('competencia_id', 'ASC')->get();
        }

        $sitio_informacion = Sitio::first();

        //Convertir fecha de solicitud a letras
        $fecha_evaluacion = explode('-', date('Y-m-d'));
        $fecha_evaluacion_letra = "$fecha_evaluacion[2] de ".$this->meses[(int) $fecha_evaluacion[1]]." del $fecha_evaluacion[0]";

        //Convertir fecha de realización a letras
        $fecha_realizacion = explode('-', date('Y-m-d'));
        $fecha_realizacion_letra = "$fecha_realizacion[2] de ".$this->meses[(int) $fecha_realizacion[1]]." del $fecha_realizacion[0]";

        $candidato_edad = Carbon::parse($candidato_prueba->fecha_nacimiento)->age;

        $requerimiento_detalle = Requerimiento::where('requerimientos.id', $candidato_prueba->req_id)->first();

        $url = asset('assets/admin/tests/ps-skills').'/';

        return view('cv.pruebas.competencias-sola.pdf.informe_resultado_competencias_preview', [
            "candidato_prueba" => $candidato_prueba,
            "totales_prueba" => $totales_prueba,
            "sobresalientesDesc" => $sobresalientesDesc,
            "sobresalientesDefinicion" => $sobresalientesDefinicion,
            "sobresalienteA" => $sobresalienteA,
            "sobresalienteB" => $sobresalienteB,
            "desarrollarA" => $desarrollarA,
            "desarrollarB" => $desarrollarB,
            "configuracionPrueba" => $configuracionPrueba,
            "sitio_informacion" => $sitio_informacion,
            "candidato_edad" => $candidato_edad,
            "fecha_evaluacion_letra" => $fecha_evaluacion_letra,
            "fecha_realizacion_letra" => $fecha_realizacion_letra,
            "requerimiento_detalle" => $requerimiento_detalle,
            "url" => $url,
            "ajuste_perfil_global" => $ajuste_perfil_global,
            "factor_global_desfase" => $factor_global_desfase
        ]);
    }

    public function recalcular_resultados($user_id, $req_id, $cand_req_id)
    {
        $user_id = $user_id;
        $req_id = $req_id;
        $cand_req_id = $cand_req_id;

        //Buscar configuración
        $configuracionPrueba = PruebaCompetenciaReq::where('req_id', $req_id)->get();

        if (!count($configuracionPrueba) > 0) {
            $requerimiento = Requerimiento::where('id', $req_id)->select('cargo_especifico_id')->first();
            $configuracionPrueba = PruebaCompetenciaCargo::where('cargo_id', $requerimiento->cargo_especifico_id)->get();
        }

        $configuracion_competencias_ids = [];

        foreach ($configuracionPrueba as $value) {
            array_push($configuracion_competencias_ids, $value->competencia_id);
        }

        /**
         * Buscar el historial de las respuestas
         */
        $historico_prueba_sola = PruebaCompetenciaSolaCandidatoHistorico::where('user_id', $user_id)->whereIn('competencia_id', $configuracion_competencias_ids)->orderByRaw('LENGTH(codigo_pregunta), codigo_pregunta asc')->get();

        $preguntas_codigos = [];
        $preguntas_opcion_valor = [];
        $competencias_ids = [];

        /**
         * Recorrer las preguntas respondidas del historial
         */
        foreach ($historico_prueba_sola as $key => $historico) {
            //Solo se tiene en cuenta las preguntas que son directas
            if (preg_match('/-D/', $historico->codigo_pregunta)) {
                array_push($preguntas_codigos, $historico->codigo_pregunta);
                array_push($preguntas_opcion_valor, $historico->valor);
            }
        }

        /**
         * Buscar las preguntas directas por el código y seleccionar solo el id de la competencia
         */
        $preguntas_dir_competencias = PruebaCompetenciaDirecta::whereIn('codigo', $preguntas_codigos)->select('competencia_id')->get();

        foreach ($preguntas_dir_competencias as $key => $pregunta) {
            //Insertar los ids en el arreglo
            array_push($competencias_ids, $pregunta->competencia_id);
        }
        
        //Sumar totales de las competencias
        $resultado_total_competencias = [];

        for ($i = 0; $i < count($preguntas_codigos); $i++) {
            /**
             * - Se usa el id de la competencia como indice de cada elemento
             * - Se busca el código de la pregunta en el arreglo
             */
            $resultado_total_competencias[$competencias_ids[$i]] = $preguntas_opcion_valor[$i] + $resultado_total_competencias[$competencias_ids[$i]];
        }

        //Buscar configuración
        $configuracion_prueba = PruebaCompetenciaReq::where('req_id', $req_id)->get();

        if (!count($configuracion_prueba) > 0) {
            $requerimiento = Requerimiento::where('id', $req_id)->select('cargo_especifico_id')->first();
            $configuracion_prueba = PruebaCompetenciaCargo::where('cargo_id', $requerimiento->cargo_especifico_id)->get();
        }

        //Calcular desfases de los totales
        $resultados_total_desfases = [];

        foreach ($configuracion_prueba as $key => $configuracion) {
            /**
             * - Se busca el resultado total de la competencia en los totales por el id de la competencia de la configuración
             * - Se le resta al total el nivel esperado de la configuración
             */

            $desfase = $resultado_total_competencias[$configuracion->competencia_id] - $configuracion->nivel_esperado;

            /**
             * - Se crea un elemento con la competencia como indice y se le asigna el desfase resultante
             */
            $resultados_total_desfases[$configuracion->competencia_id] = number_format($desfase, 1);
        }

        //Calcular desfases de los totales y convirtiendo a abs
        $resultado_total_desfases_absolutos = [];

        foreach ($configuracion_prueba as $key => $configuracion) {
            $desfaseAbs = abs($resultado_total_competencias[$configuracion->competencia_id] - $configuracion->nivel_esperado);

            $resultado_total_desfases_absolutos[$configuracion->competencia_id] = number_format($desfaseAbs, 1);
        }

        //Calcular ajuste al perfil por cada competencia
        $resultados_ajustes_perfiles = [];

        foreach ($configuracion_prueba as $key => $configuracion) {
            $ajustePerfil = 100 - $resultado_total_desfases_absolutos[$configuracion->competencia_id].'%';

            $resultados_ajustes_perfiles[$configuracion->competencia_id] = $ajustePerfil;
        }

        //Calcular factor y ajuste perfil global
        $ajuste_perfil_global = number_format(array_sum($resultados_ajustes_perfiles) / count($resultados_ajustes_perfiles), 1);
        $factor_global_desfase = number_format(array_sum($resultados_total_desfases) / count($resultados_total_desfases), 1);

        //Ordenar el arreglo
        ksort($resultado_total_competencias);

        // Crear registro de la prueba
        $prueba_competencias = new PruebaCompetenciaResultado();

        $prueba_competencias->fill([
            'req_id' => $req_id,
            'user_id' => $user_id,
            'gestion_id' => $this->user->id,
            'ajuste_global' => $ajuste_perfil_global,
            'factor_desfase_global' => $factor_global_desfase,
            'estado' => 1,
            'fecha_realizacion' => date('Y-m-d')
        ]);
        $prueba_competencias->save();

        //Guardar resultados totales de todas las competencias
        foreach($resultado_total_competencias as $key => $total) {
            $competencia_total = new PruebaCompetenciaTotal();

            $competencia_total->fill([
                'prueba_id' => $prueba_competencias->id,
                'req_id' => $req_id,
                'user_id' => $user_id,
                'competencia_id' => $key,
                'calificacion_obtenida' => $total,
                'desfase' => $resultados_total_desfases[$key],
                'desfase_absoluto' => $resultado_total_desfases_absolutos[$key],
                'ajuste_perfil' => $resultados_ajustes_perfiles[$key]
            ]);
            $competencia_total->save();
        }

        // Crear proceso para la trazabilidad
        $campos_proceso = [
            'requerimiento_candidato_id' => $cand_req_id,
            'usuario_envio' => $this->user->id,
            "fecha_inicio" => date("Y-m-d H:i:s"),
            'proceso' => "ENVIO_PRUEBA_COMPETENCIA",
            "apto" => 3
        ];

        $registrar_proceso = new ReclutamientoController();

        $registrar_proceso->RegistroProceso($campos_proceso, config('conf_aplicacion.C_EN_PROCESO_SELECCION'), $cand_req_id);
    }
}
