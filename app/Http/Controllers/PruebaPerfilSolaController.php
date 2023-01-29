<?php

namespace App\Http\Controllers;

use PDF;

use File;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Sitio;
use App\Http\Requests;
use App\Models\DatosBasicos;
use Illuminate\Http\Request;
use App\Models\GestionPrueba;
use App\Models\Requerimiento;
use App\Helpers\triPostmaster;
use App\Models\PruebaBrygFoto;
use App\Models\RegistroProceso;
use App\Models\PruebaBrigConcepto;

use App\Models\PruebaBrigPregunta;
use App\Models\PruebaBrygSolaFoto;
use Illuminate\Support\Facades\DB;


use App\Models\PruebaBrigResultado;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use App\Models\PruebaBrigSolaConfig;
use Illuminate\Support\Facades\Mail;
use App\Models\PruebaBrigConfigCargo;
use App\Models\PruebaBrigSolaResultado;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\PruebaBrigConfigRequerimiento;

class PruebaPerfilSolaController extends Controller
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

    //Inicio de la prueba CV
    public function index()
    {
        if(empty($this->user->id)){
            session(["url_deseada_redireccion_candidato" => url($_SERVER['REQUEST_URI'])]);
            return redirect()->route('login');
        }

        //Verificar si fue enviado a prueba
        $check_test = PruebaBrigSolaResultado::where('user_id', $this->user->id)->first();

        if(!empty($check_test)) {
            return redirect()->route('dashboard')->with('no_prueba', 'Actualmente no tienes pruebas a realizar.');
        }

        $name_user = DatosBasicos::where('user_id', $this->user->id)
        ->select(DB::raw("CONCAT(datos_basicos.nombres,' ',datos_basicos.primer_apellido) AS nombre_candidato"))
        ->first();

        $sitio = Sitio::first();
        $user = User::find($this->user->id);

        return view('cv.pruebas.bryg-sola.prueba_perfil_index', compact('sitio', 'user', 'name_user'));
    }

    //Muestra la vista con preguntas CV
    public function start(Request $data)
    {
        if(empty($this->user->id)){
            session(["url_deseada_redireccion_candidato" => url($_SERVER['REQUEST_URI'])]);
            return redirect()->route('login');
        }

        //Verificar si fue enviado a prueba
        $check_test = PruebaBrigSolaResultado::where('user_id', $this->user->id)->first();

        if(!empty($check_test)){
            return redirect()->route('dashboard')->with('no_prueba', 'Actualmente no tienes pruebas a realizar.');
        }

        $sitio = Sitio::first();
        $user = User::find($this->user->id);

        $brig_questions = PruebaBrigPregunta::orderByRaw('RAND()')->get();

        $ids = array();
        foreach($brig_questions as $question){ $ids[] = (int)$question->id; }

        //Reload
        $reloadPage = $data->session()->get('reloadPage');

        if ($reloadPage === 'yes') {
            $data->session()->forget('reloadPage');
        }else {
            session(['reloadPage' => 'not']);
        }

        return view('cv.pruebas.bryg-sola.prueba_brig', compact('brig_questions', 'sitio', 'user', 'ids'));
    }

    //Devuelve las preguntas siguientes CV
    public function set_content(Request $data)
    {
        $ids = array_map('intval', explode(',', $data->ids));

        //$brig_questions = PruebaBrigPregunta::whereNotIn('id', $ids)->orderBy('id', 'RAND')->paginate(4);
        $brig_questions = PruebaBrigPregunta::orderByRaw('RAND()')->paginate(10);

        foreach($brig_questions as $question){ $ids[] = (int)$question->id; }

        $ids = json_encode($ids);

        return response()->json([
            'view' => view('cv.pruebas.bryg-sola.paginacion_contenido', compact('brig_questions', 'ids'))->render(),
            'ids' => $ids
        ]);
    }

    //Guarda resultados prueba CV
    public function save_result(Request $data)
    {
        $user_id = $data->userId;
        // $requerimientoId = $data->requerimientoId;
        $sitio = Sitio::first();

        // $result_test = PruebaBrigSolaResultado::where('user_id', $userId)
        // ->orderBy('created_at', 'DESC')
        // ->first();

        //Crea registro para guardar los resultados
        $result_test = new PruebaBrigSolaResultado();

        $result_test->fill([
            'user_id' => $user_id,
            'gestion_id' => $user_id,
            'estilo_radical' => $data->estilo_radical,
            'estilo_genuino' => $data->estilo_genuino,
            'estilo_garante' => $data->estilo_garante,
            'estilo_basico' => $data->estilo_basico,
            'aumented_a' => $data->aumented_a,
            'aumented_p' => $data->aumented_p,
            'aumented_d' => $data->aumented_d,
            'aumented_r' => $data->aumented_r,
            'estado' => 1,
            'fecha_realizacion' => date('Y-m-d')
        ]);        
        $result_test->save();

        //Calcular ajuste al perfil
        $respuestasBryg = [
            'radical' => $result_test->estilo_radical,
            'genuino' => $result_test->estilo_genuino,
            'garante' => $result_test->estilo_garante,
            'basico' => $result_test->estilo_basico
        ];

        $ajustePerfil = $this->calcularAjustePerfil($respuestasBryg);

        $result_test->ajuste_perfil = $ajustePerfil;
        $result_test->save();

        //Crear variables en la sesión para marcar el final de la prueba
        $data->session()->put('finalBryg', true);

        return response()->json([
            'success' => true
        ]);
    }

    public function guardar_fotos(Request $data)
    {
        //Buscar prueba
        $pruebaBryg = PruebaBrigSolaResultado::where('user_id', $data->userId)
        ->select('id', 'created_at')
        ->orderBy('created_at', 'DESC')
        ->first();

        $user_id = $data->userId;
        // $req_id = $data->requerimientoId;

        //Fotos
        $brygImagenes = json_decode($data->brygImagenes, true);

        //Borrar primera foto del arreglo, porque no tiene información
        unset($brygImagenes[0]);

        for($i = 1; $i <= count($brygImagenes); $i++) {
            //Se verifica que la imagen tenga datos
            if ($brygImagenes[$i]['picture'] != null && $brygImagenes[$i]['picture'] != '' && $brygImagenes[$i]['picture'] != 'data:,') {
                //Convertir base64 a PNG
                $image_parts = explode(";base64,", $brygImagenes[$i]['picture']);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $fotoNombre = "candidato-foto-$i-$user_id-$pruebaBryg->id.png";

                Storage::disk('public')->put("recursos_prueba_bryg_sola/prueba_bryg_sola$user_id"."_"."$pruebaBryg->id/$fotoNombre", $image_base64);

                //Guardar referencia foto en la tabla
                $brygFoto = new PruebaBrygSolaFoto();

                $brygFoto->fill([
                    'prueba_id' => $pruebaBryg->id,
                    'user_id' => $user_id,
                    'descripcion' => $fotoNombre
                ]);
                $brygFoto->save();
            }
        }
    }

    //Generar informe de la prueba
    public function informe_prueba_bryg($bryg_id, $download=0)
    {
        $candidato_bryg = PruebaBrigSolaResultado::join('datos_basicos', 'datos_basicos.user_id', '=', 'prueba_brig_sola_candidato_resultado.user_id')
        ->join('users', 'users.id', '=', 'datos_basicos.user_id')
        ->where('prueba_brig_sola_candidato_resultado.id', $bryg_id)
        ->select(
            'prueba_brig_sola_candidato_resultado.*',

            'datos_basicos.nombres',
            'datos_basicos.numero_id as cedula',
            'datos_basicos.fecha_nacimiento',
            'datos_basicos.telefono_movil as celular',
            'datos_basicos.email as correo',
            DB::raw("CONCAT(datos_basicos.nombres,' ',datos_basicos.primer_apellido,' ',datos_basicos.segundo_apellido) AS nombre_completo"),

            'users.foto_perfil'
        )
        ->first();

        $bryg_fotos = PruebaBrygSolaFoto::where('prueba_id', $bryg_id)
        ->where('user_id', $candidato_bryg->user_id)
        ->get();

        $sitio_informacion = Sitio::first();

        $aumented_array = [
            "analizador" => $candidato_bryg->aumented_a,
            "prospectivo" => $candidato_bryg->aumented_p,
            "defensivo" => $candidato_bryg->aumented_d,
            "reactivo" => $candidato_bryg->aumented_r
        ];

        $bryg_array = [
            "radical" => $candidato_bryg->estilo_radical,
            "genuino" => $candidato_bryg->estilo_genuino,
            "garante" => $candidato_bryg->estilo_garante,
            "basico" => $candidato_bryg->estilo_basico
        ];

        //Valor definitivo para aumented (Buscar el valor más alto)
        $aumented_definitive = array_keys($aumented_array, max($aumented_array));

        //Primer valor definitivo para bryg
        $bryg_definitive_first = array_keys($bryg_array, max($bryg_array));
        unset($bryg_array[$bryg_definitive_first[0]]); //Quita del arreglo primer item encontrado

        //Segundo valor definitivo para bryg
        $bryg_definitive_second = array_keys($bryg_array, max($bryg_array));
        unset($bryg_array[$bryg_definitive_second[0]]); //Quita del arreglo el segundo item encontrado

        /**
         * @todo la validación de los cuadrantes más altos deberían ser funciones independientes
         */

        //Validar cuadrante más alto BRYG para asignar color
        $radarBrygColor = '0, 169, 84';
        switch ($bryg_definitive_first[0]) {
            case 'radical':
                $radarBrygColor = '46, 45, 102';
                break;
            case 'genuino':
                $radarBrygColor = '217, 36, 40';
                break;
            case 'garante':
                $radarBrygColor = '228, 228, 42';
                break;
            case 'basico':
                $radarBrygColor = '0, 169, 84';
                break;
            default:
                $radarBrygColor = '0, 169, 84';
                break;
        }

        //Validar cuadrante más alto AUMENTED para asignar color
        $radarAumentedColor = '0, 169, 84';
        switch ($aumented_definitive[0]) {
            case 'analizador':
                $radarAumentedColor = '2, 136, 209';
                break;
            case 'prospectivo':
                $radarAumentedColor = '253, 216, 53';
                break;
            case 'defensivo':
                $radarAumentedColor = '244, 67, 54';
                break;
            case 'reactivo':
                $radarAumentedColor = '124, 179, 66';
                break;
            default:
                $radarAumentedColor = '124, 179, 66';
                break;
        }

        //Convertir fecha de solicitud a letras
        $fecha_evaluacion = explode('-', date('Y-m-d', strtotime($candidato_bryg->created_at)));
        $fecha_evaluacion_letra = "$fecha_evaluacion[2] de ".$this->meses[(int) $fecha_evaluacion[1]]." del $fecha_evaluacion[0]";

        //Convertir fecha de realización a letras
        $fecha_realizacion = explode('-', date('Y-m-d', strtotime($candidato_bryg->fecha_realizacion)));
        $fecha_realizacion_letra = "$fecha_realizacion[2] de ".$this->meses[(int) $fecha_realizacion[1]]." del $fecha_realizacion[0]";

        $candidato_edad = Carbon::parse($candidato_bryg->fecha_nacimiento)->age;

        $requerimiento_detalle = Requerimiento::where('requerimientos.id', $candidato_bryg->req_id)->first();

        //Generar gráfico radar BRYG
        $grafico_radar_bryg = $this->generarGraficoRadar(
            ['RADICAL', 'GENUINO', 'GARANTE', 'BÁSICO'],
            [$candidato_bryg->estilo_radical, $candidato_bryg->estilo_genuino, $candidato_bryg->estilo_garante, $candidato_bryg->estilo_basico],
            ['background' => "rgba($radarBrygColor, 0.7)", 'border' => "rgba($radarBrygColor, 1)"],
            'BRYG Gráfico de radar'
        );

        //Generar gráfico barra BRYG
        $grafico_barra_bryg = $this->generarGraficoBarra(
            ['RADICAL', 'GENUINO', 'GARANTE', 'BÁSICO'],
            [$candidato_bryg->estilo_radical, $candidato_bryg->estilo_genuino, $candidato_bryg->estilo_garante, $candidato_bryg->estilo_basico],
            [
                'background' => [
                    'rgba(46, 45, 102, 0.7)',
                    'rgba(217, 36, 40, 0.7)',
                    'rgba(228, 228, 42, 0.7)',
                    'rgba(0, 169, 84, 0.7)'
                ],
                'border' => [
                    'rgba(46, 45, 102, 1)',
                    'rgba(217, 36, 40, 1)',
                    'rgba(228, 228, 42, 1)',
                    'rgba(0, 169, 84, 1)'
                ]
            ],
            'BRYG Gráfico de barra'
        );

        //Generar gráfico radar AUMENTED
        $grafico_radar_aumented = $this->generarGraficoRadar(
            ['ANALIZADOR', 'PROSPECTIVO', 'DEFENSIVO', 'REACTIVO'],
            [$candidato_bryg->aumented_a, $candidato_bryg->aumented_p, $candidato_bryg->aumented_d, $candidato_bryg->aumented_r],
            ['background' => "rgba($radarAumentedColor, 0.7)", 'border' => "rgba($radarAumentedColor, 1)"],
            'BRYG-A Gráfico de radar'
        );

        //Generar gráfico barra AUMENTED
        $grafico_barra_aumented = $this->generarGraficoBarra(
            ['ANALIZADOR', 'PROSPECTIVO', 'DEFENSIVO', 'REACTIVO'],
            [$candidato_bryg->aumented_a, $candidato_bryg->aumented_p, $candidato_bryg->aumented_d, $candidato_bryg->aumented_r],
            [
                'background' => [
                    'rgba(2, 136, 209, 0.7)',
                    'rgba(253, 216, 53, 0.7)',
                    'rgba(244, 67, 54, 0.7)',
                    'rgba(124, 179, 66, 0.7)'
                ],
                'border' => [
                    'rgba(2, 136, 209, 1)',
                    'rgba(253, 216, 53, 1)',
                    'rgba(244, 67, 54, 1)',
                    'rgba(124, 179, 66, 1)'
                ]
            ],
            'BRYG Gráfico de barra'
        );

        if(!$download){
            return view('cv.pruebas.bryg-sola.pdf.informe_resultado_bryg_new', [
                "candidato_bryg" => $candidato_bryg,
                "bryg_fotos" => $bryg_fotos,
                "sitio_informacion" => $sitio_informacion,
                "aumented_definitive" => $aumented_definitive,
                "bryg_definitive_first" => $bryg_definitive_first,
                "bryg_definitive_second" => $bryg_definitive_second,
                "candidato_edad" => $candidato_edad,
                "fecha_evaluacion_letra" => $fecha_evaluacion_letra,
                "fecha_realizacion_letra" => $fecha_realizacion_letra,
                "requerimiento_detalle" => $requerimiento_detalle,
                "grafico_radar_bryg" => $grafico_radar_bryg,
                "grafico_radar_aumented" => $grafico_radar_aumented,
                "grafico_barra_bryg" => $grafico_barra_bryg,
                "grafico_barra_aumented" => $grafico_barra_aumented
            ]);
        }else {
            return \SnappyPDF::loadView('cv.pruebas.bryg-sola.pdf.informe_resultado_bryg', [
                "candidato_bryg" => $candidato_bryg,
                "bryg_fotos" => $bryg_fotos,
                "sitio_informacion" => $sitio_informacion,
                "aumented_definitive" => $aumented_definitive,
                "bryg_definitive_first" => $bryg_definitive_first,
                "bryg_definitive_second" => $bryg_definitive_second,
                "candidato_edad" => $candidato_edad,
                "fecha_evaluacion_letra" => $fecha_evaluacion_letra,
                "fecha_realizacion_letra" => $fecha_realizacion_letra,
                "requerimiento_detalle" => $requerimiento_detalle,
                "grafico_radar_bryg" => $grafico_radar_bryg,
                "grafico_radar_aumented" => $grafico_radar_aumented,
                "grafico_barra_bryg" => $grafico_barra_bryg,
                "grafico_barra_aumented" => $grafico_barra_aumented
            ])->output();
        }
    }

    public function informe_prueba_bryg_preview($bryg_id, $req_id, $user_id)
    {
        $candidato_bryg = PruebaBrigSolaResultado::join('datos_basicos', 'datos_basicos.user_id', '=', 'prueba_brig_sola_candidato_resultado.user_id')
        ->join('users', 'users.id', '=', 'datos_basicos.user_id')
        ->where('prueba_brig_sola_candidato_resultado.id', $bryg_id)
        ->select(
            'prueba_brig_sola_candidato_resultado.*',

            'datos_basicos.nombres',
            'datos_basicos.numero_id as cedula',
            'datos_basicos.fecha_nacimiento',
            'datos_basicos.telefono_movil as celular',
            'datos_basicos.email as correo',
            DB::raw("CONCAT(datos_basicos.nombres,' ',datos_basicos.primer_apellido,' ',datos_basicos.segundo_apellido) AS nombre_completo"),

            'users.foto_perfil'
        )
        ->first();

        $sitio_informacion = Sitio::first();

        $aumented_array = [
            "analizador" => $candidato_bryg->aumented_a,
            "prospectivo" => $candidato_bryg->aumented_p,
            "defensivo" => $candidato_bryg->aumented_d,
            "reactivo" => $candidato_bryg->aumented_r
        ];

        $bryg_array = [
            "radical" => $candidato_bryg->estilo_radical,
            "genuino" => $candidato_bryg->estilo_genuino,
            "garante" => $candidato_bryg->estilo_garante,
            "basico" => $candidato_bryg->estilo_basico
        ];

        //Valor definitivo para aumented (Buscar el valor más alto)
        $aumented_definitive = array_keys($aumented_array, max($aumented_array));

        //Primer valor definitivo para bryg
        $bryg_definitive_first = array_keys($bryg_array, max($bryg_array));
        unset($bryg_array[$bryg_definitive_first[0]]); //Quita del arreglo primer item encontrado

        //Segundo valor definitivo para bryg
        $bryg_definitive_second = array_keys($bryg_array, max($bryg_array));
        unset($bryg_array[$bryg_definitive_second[0]]); //Quita del arreglo el segundo item encontrado

        /**
         * @todo la validación de los cuadrantes más altos deberían ser funciones independientes
         */

        //Validar cuadrante más alto BRYG para asignar color
        $radarBrygColor = '0, 169, 84';
        switch ($bryg_definitive_first[0]) {
            case 'radical':
                $radarBrygColor = '46, 45, 102';
                break;
            case 'genuino':
                $radarBrygColor = '217, 36, 40';
                break;
            case 'garante':
                $radarBrygColor = '228, 228, 42';
                break;
            case 'basico':
                $radarBrygColor = '0, 169, 84';
                break;
            default:
                $radarBrygColor = '0, 169, 84';
                break;
        }

        //Validar cuadrante más alto AUMENTED para asignar color
        $radarAumentedColor = '0, 169, 84';
        switch ($aumented_definitive[0]) {
            case 'analizador':
                $radarAumentedColor = '2, 136, 209';
                break;
            case 'prospectivo':
                $radarAumentedColor = '253, 216, 53';
                break;
            case 'defensivo':
                $radarAumentedColor = '244, 67, 54';
                break;
            case 'reactivo':
                $radarAumentedColor = '124, 179, 66';
                break;
            default:
                $radarAumentedColor = '124, 179, 66';
                break;
        }

        //Convertir fecha de solicitud a letras
        $fecha_evaluacion = explode('-', date('Y-m-d', strtotime($candidato_bryg->created_at)));
        $fecha_evaluacion_letra = "$fecha_evaluacion[2] de ".$this->meses[(int) $fecha_evaluacion[1]]." del $fecha_evaluacion[0]";

        //Convertir fecha de realización a letras
        $fecha_realizacion = explode('-', date('Y-m-d', strtotime($candidato_bryg->fecha_realizacion)));
        $fecha_realizacion_letra = "$fecha_realizacion[2] de ".$this->meses[(int) $fecha_realizacion[1]]." del $fecha_realizacion[0]";

        $candidato_edad = Carbon::parse($candidato_bryg->fecha_nacimiento)->age;

        $requerimiento_detalle = Requerimiento::where('requerimientos.id', $candidato_bryg->req_id)->first();

        //Generar gráfico radar BRYG
        $grafico_radar_bryg = $this->generarGraficoRadar(
            ['RADICAL', 'GENUINO', 'GARANTE', 'BÁSICO'],
            [$candidato_bryg->estilo_radical, $candidato_bryg->estilo_genuino, $candidato_bryg->estilo_garante, $candidato_bryg->estilo_basico],
            ['background' => "rgba($radarBrygColor, 0.7)", 'border' => "rgba($radarBrygColor, 1)"],
            'BRYG Gráfico de radar'
        );

        //Generar gráfico barra BRYG
        $grafico_barra_bryg = $this->generarGraficoBarra(
            ['RADICAL', 'GENUINO', 'GARANTE', 'BÁSICO'],
            [$candidato_bryg->estilo_radical, $candidato_bryg->estilo_genuino, $candidato_bryg->estilo_garante, $candidato_bryg->estilo_basico],
            [
                'background' => [
                    'rgba(46, 45, 102, 0.7)',
                    'rgba(217, 36, 40, 0.7)',
                    'rgba(228, 228, 42, 0.7)',
                    'rgba(0, 169, 84, 0.7)'
                ],
                'border' => [
                    'rgba(46, 45, 102, 1)',
                    'rgba(217, 36, 40, 1)',
                    'rgba(228, 228, 42, 1)',
                    'rgba(0, 169, 84, 1)'
                ]
            ],
            'BRYG Gráfico de barra'
        );

        //Generar gráfico radar AUMENTED
        $grafico_radar_aumented = $this->generarGraficoRadar(
            ['ANALIZADOR', 'PROSPECTIVO', 'DEFENSIVO', 'REACTIVO'],
            [$candidato_bryg->aumented_a, $candidato_bryg->aumented_p, $candidato_bryg->aumented_d, $candidato_bryg->aumented_r],
            ['background' => "rgba($radarAumentedColor, 0.7)", 'border' => "rgba($radarAumentedColor, 1)"],
            'BRYG-A Gráfico de radar'
        );

        //Generar gráfico barra AUMENTED
        $grafico_barra_aumented = $this->generarGraficoBarra(
            ['ANALIZADOR', 'PROSPECTIVO', 'DEFENSIVO', 'REACTIVO'],
            [$candidato_bryg->aumented_a, $candidato_bryg->aumented_p, $candidato_bryg->aumented_d, $candidato_bryg->aumented_r],
            [
                'background' => [
                    'rgba(2, 136, 209, 0.7)',
                    'rgba(253, 216, 53, 0.7)',
                    'rgba(244, 67, 54, 0.7)',
                    'rgba(124, 179, 66, 0.7)'
                ],
                'border' => [
                    'rgba(2, 136, 209, 1)',
                    'rgba(253, 216, 53, 1)',
                    'rgba(244, 67, 54, 1)',
                    'rgba(124, 179, 66, 1)'
                ]
            ],
            'BRYG Gráfico de barra'
        );

        return view('cv.pruebas.bryg-sola.pdf.informe_resultado_bryg_preview', [
            "candidato_bryg" => $candidato_bryg,
            "sitio_informacion" => $sitio_informacion,
            "aumented_definitive" => $aumented_definitive,
            "bryg_definitive_first" => $bryg_definitive_first,
            "bryg_definitive_second" => $bryg_definitive_second,
            "candidato_edad" => $candidato_edad,
            "fecha_evaluacion_letra" => $fecha_evaluacion_letra,
            "fecha_realizacion_letra" => $fecha_realizacion_letra,
            "requerimiento_detalle" => $requerimiento_detalle,
            "grafico_radar_bryg" => $grafico_radar_bryg,
            "grafico_radar_aumented" => $grafico_radar_aumented,
            "grafico_barra_bryg" => $grafico_barra_bryg,
            "grafico_barra_aumented" => $grafico_barra_aumented
        ]);
    }

    //Crear arreglo para generar gráfico de radar (BRYG - AUMENTED)
    public function generarGraficoRadar(array $arrayLabels, array $arrayData, array $arrayColors, string $titleText):array
    {
        //Arreglo para generar gráfico
        $grafico_radar = [
            'type' => 'radar',
            'data' => [
                'labels' => [$arrayLabels[0], $arrayLabels[1], $arrayLabels[2], $arrayLabels[3]],
                'datasets' => [
                    [
                        'label' => 'Resultados',
                        'backgroundColor' => [
                            $arrayColors['background']
                        ],
                        'borderColor' => [
                            $arrayColors['border']
                        ],
                        'data' => [
                            $arrayData[0],
                            $arrayData[1],
                            $arrayData[2],
                            $arrayData[3]
                        ],
                        'borderWidth' => 1
                    ]
                ]
            ],
            'options' => [
                'legend' => ['display' => false],
                'title' => [
                    'display' => true,
                    'text' => $titleText
                ]
            ]
        ];

        return $grafico_radar;
    }

    //Crear arreglo para generar gráfico de barra (BRYG - AUMENTED)
    public function generarGraficoBarra(array $arrayLabels, array $arrayData, array $arrayColors, string $titleText):array
    {
        $grafico_barra = [
            'type' => 'bar',
            'data' => [
                'labels' => $arrayLabels,
                'datasets' => [
                    [
                        'label' => 'Resultados',
                        'backgroundColor' => [
                            $arrayColors['background'][0],
                            $arrayColors['background'][1],
                            $arrayColors['background'][2],
                            $arrayColors['background'][3],
                        ],
                        'borderColor' => [
                            $arrayColors['border'][0],
                            $arrayColors['border'][1],
                            $arrayColors['border'][2],
                            $arrayColors['border'][3],
                        ],
                        'data' => [
                            $arrayData[0],
                            $arrayData[1],
                            $arrayData[2],
                            $arrayData[3]
                        ],
                        'borderWidth' => 1
                    ]
                ]
            ],
            'options' => [
                'legend' => ['display' => false ],
                'title' => [
                    'display' => true,
                    'text' => $titleText
                ]
            ]
        ];

        return $grafico_barra;
    }

    /*
     *
     * Calcular ajuste al perfil
     *
    */
    private function calcularAjustePerfil(array $respuestasBryg)
    {
        //Primero busca si el requerimiento tiene configuración BRYG
        $configuracion = PruebaBrigSolaConfig::all();

        Log::debug($configuracion);

        $cuadranteRadical = 0;
        $cuadranteGenuino = 0;
        $cuadranteGarante = 0;
        $cuadranteBasico = 0;

        $ajustePerfil = 0;

        if ($configuracion->radical > $respuestasBryg['radical']) {
            $cuadranteRadical = $respuestasBryg['radical'] / $configuracion->radical;
        }else {
            $cuadranteRadical = $configuracion->radical / $respuestasBryg['radical'];
        }

        if ($configuracion->genuino > $respuestasBryg['genuino']) {
            $cuadranteGenuino = $respuestasBryg['genuino'] / $configuracion->genuino;
        }else {
            $cuadranteGenuino = $configuracion->genuino / $respuestasBryg['genuino'];
        }

        if ($configuracion->garante > $respuestasBryg['garante']) {
            $cuadranteGarante = $respuestasBryg['garante'] / $configuracion->garante;
        }else {
            $cuadranteGarante = $configuracion->garante / $respuestasBryg['garante'];
        }

        if ($configuracion->basico > $respuestasBryg['basico']) {
            $cuadranteBasico = $respuestasBryg['basico'] / $configuracion->basico;
        }else {
            $cuadranteBasico = $configuracion->basico / $respuestasBryg['basico'];
        }

        // Log::info($cuadranteRadical);
        // Log::info($cuadranteGenuino);
        // Log::info($cuadranteGarante);
        // Log::info($cuadranteBasico);

        $ajustePerfil = ($cuadranteRadical + $cuadranteGenuino + $cuadranteGarante + $cuadranteBasico) / 4;

        return $ajustePerfil;
    }
}
