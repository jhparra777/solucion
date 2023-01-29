<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\CargoEspecifico;
use App\Models\DatosBasicos;
use App\Models\PruebaExcelSoloConfiguracion;
use App\Models\PruebaExcelSoloOpciones;
use App\Models\PruebaExcelSoloPreguntas;
use App\Models\PruebaExcelSoloRespuestaBasico;
use App\Models\PruebaExcelSoloRespuestaIntermedio;
use App\Models\PruebaExcelSoloRespuestaUser;
use App\Models\RegistroProceso;
use App\Models\Requerimiento;
use App\Models\Sitio;
use App\Models\User;
use DB;
use triPostmaster;

use Storage;
use File;


class PruebaExcelSoloController extends Controller
{
    public function index_basico(Request $data)
    {
        if(empty($this->user->id)){
            session(["url_deseada_redireccion_candidato" => url($_SERVER['REQUEST_URI'])]);
            return redirect()->route('login');
        }

        $check_test = PruebaExcelSoloRespuestaUser::where('user_id', $this->user->id)
            ->where('tipo', 'basico')
            ->orderBy('created_at', 'DESC')
        ->first();

        if(!empty($check_test)){
            return redirect()->route('dashboard')->with('no_prueba', 'Ya has respondido esta prueba.');
        }

        $name_user = DatosBasicos::where('user_id', $this->user->id)
            ->select(DB::raw("CONCAT(datos_basicos.nombres,' ',datos_basicos.primer_apellido) AS nombre_candidato"))
        ->first();

        $sitio = Sitio::first();
        $user = User::find($this->user->id);
        $nombre_prueba = 'Excel Básico';
        $req_id = (int)"-1";

        $configuracion = PruebaExcelSoloConfiguracion::select('tiempo_excel_basico as tiempo_maximo', 'aprobacion_excel_basico as minimo_aprobacion')->first();

        $excel_questions = PruebaExcelSoloPreguntas::where('tipo', 'basico')->where('active', 1)->orderByRaw('RAND()')->get();

        $total_preguntas = count($excel_questions);

        $ids = array();
        foreach($excel_questions as $question){ $ids[] = (int)$question->id; }

        //Reload
        $reloadPage = $data->session()->get('reloadPage');

        $ruta_save = route('cv.prueba_excel_solo_basico_save');

        if ($reloadPage === 'yes') {
            $data->session()->forget('reloadPage');
        }else {
            session(['reloadPage' => 'not']);
        }

        return view('cv.pruebas.excel.prueba_excel', compact('sitio', 'user', 'name_user', 'nombre_prueba', 'total_preguntas', 'excel_questions', 'ids', 'reloadPage', 'req_id', 'configuracion', 'ruta_save'));
    }

    public function save_result_basico(Request $request)
    {
        $user_id = $this->user->id;

        $excelImagenes = json_decode($request->fotosExcel, true);

        $nombres_fotos = '';

        $total_imagenes = count($excelImagenes);

        for($i = 0; $i < $total_imagenes; $i++) {
            //Se verifica que la imagen tenga datos
            if ($excelImagenes[$i]['picture'] != null && $excelImagenes[$i]['picture'] != '') {
                //Convertir base64 a PNG
                $image_parts = explode(";base64,", $excelImagenes[$i]['picture']);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $fotoNombre = "candidato-foto-$i-$user_id.png";

                if ($i == $total_imagenes-1) {
                    $nombres_fotos = $nombres_fotos . $fotoNombre;
                } else {
                    $nombres_fotos = $nombres_fotos . "$fotoNombre,";
                }

                Storage::disk('public')->put("recursos_prueba_excel_solo/prueba_excel_basico_".$user_id."/$fotoNombre", $image_base64);
            }
        }

        $preguntas = PruebaExcelSoloPreguntas::where('tipo', 'basico')->where('active', 1)->select('id')->get()->pluck('id')->toArray();
        //Se obtienen todas las opciones de todas las preguntas, que servira para verificar si respondio correctamente.
        $opcionesPrueba = PruebaExcelSoloOpciones::whereIn('id_pregunta', $preguntas)->get();
        $correctas = 0;

        $respuesta_user = PruebaExcelSoloRespuestaUser::where('user_id', $this->user->id)->where('tipo', 'basico')->first();
        if ($respuesta_user == null) {
            $respuesta_user = new PruebaExcelSoloRespuestaUser();
        }
        $respuesta_user->user_id    = $this->user->id;
        $respuesta_user->tipo       = 'basico';
        $respuesta_user->fotos      = $nombres_fotos;
        $respuesta_user->fecha_respuesta = date('Y-m-d');
        $respuesta_user->total_preguntas = count($preguntas);

        $respuesta_user->save();

        $preg_resp = $request->except('req_id', 'userId', '_token', 'fotosExcel');
        foreach ($preg_resp as $preg_id_text => $opcion) {
            $pregunta_id = str_replace('preg_id_', '', $preg_id_text);

            $respuestas_basico = new PruebaExcelSoloRespuestaBasico();

            $respuestas_basico->user_id     = $this->user->id;
            $respuestas_basico->opcion_id   = $opcion;
            $respuestas_basico->pregunta_id = $pregunta_id;
            $respuestas_basico->respuesta_user_id = $respuesta_user->id;

            $verificar = $opcionesPrueba->find($opcion);
            //Se verifica si la seleccion del usuario era la respuesta correcta
            if ($verificar->correcta) {
                $correctas++;
            }

            $respuestas_basico->save();
        }

        $respuesta_user->respuestas_correctas = $correctas;
        $respuesta_user->save();

        return response()->json(['success' => true]);
    }

    public function index_intermedio(Request $data)
    {
        if(empty($this->user->id)){
            session(["url_deseada_redireccion_candidato" => url($_SERVER['REQUEST_URI'])]);
            return redirect()->route('login');
        }

        $check_test = PruebaExcelSoloRespuestaUser::where('user_id', $this->user->id)
            ->where('tipo', 'intermedio')
            ->orderBy('created_at', 'DESC')
        ->first();

        if(!empty($check_test)){
            return redirect()->route('dashboard')->with('no_prueba', 'Ya has respondido esta prueba.');
        }

        $name_user = DatosBasicos::where('user_id', $this->user->id)
        ->select(DB::raw("CONCAT(datos_basicos.nombres,' ',datos_basicos.primer_apellido) AS nombre_candidato"))
        ->first();

        $sitio = Sitio::first();
        $user = User::find($this->user->id);
        $nombre_prueba = 'Excel Intermedio';
        $req_id = (int)"-1";

        $configuracion = PruebaExcelSoloConfiguracion::select('tiempo_excel_intermedio as tiempo_maximo', 'aprobacion_excel_intermedio as minimo_aprobacion')->first();

        $excel_questions = PruebaExcelSoloPreguntas::where('tipo', 'intermedio')->where('active', 1)->orderByRaw('RAND()')->get();

        $total_preguntas = count($excel_questions);

        $ids = array();
        foreach($excel_questions as $question){ $ids[] = (int)$question->id; }

        //Reload
        $reloadPage = $data->session()->get('reloadPage');

        if ($reloadPage === 'yes') {
            $data->session()->forget('reloadPage');
        }else {
            session(['reloadPage' => 'not']);
        }

        $ruta_save = route('cv.prueba_excel_solo_intermedio_save');

        return view('cv.pruebas.excel.prueba_excel', compact('sitio', 'user', 'name_user', 'nombre_prueba', 'total_preguntas', 'excel_questions', 'ids', 'reloadPage', 'req_id', 'configuracion', 'ruta_save'));
    }

    public function save_result_intermedio(Request $request)
    {
        $user_id = $this->user->id;

        $excelImagenes = json_decode($request->fotosExcel, true);

        $nombres_fotos = '';

        $total_imagenes = count($excelImagenes);

        for($i = 0; $i < $total_imagenes; $i++) {
            //Se verifica que la imagen tenga datos
            if ($excelImagenes[$i]['picture'] != null && $excelImagenes[$i]['picture'] != '') {
                //Convertir base64 a PNG
                $image_parts = explode(";base64,", $excelImagenes[$i]['picture']);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $fotoNombre = "candidato-foto-$i-$user_id.png";

                if ($i == $total_imagenes-1) {
                    $nombres_fotos = $nombres_fotos . $fotoNombre;
                } else {
                    $nombres_fotos = $nombres_fotos . "$fotoNombre,";
                }

                Storage::disk('public')->put("recursos_prueba_excel_solo/prueba_excel_intermedio_".$user_id."/$fotoNombre", $image_base64);
            }
        }

        $preguntas = PruebaExcelSoloPreguntas::where('tipo', 'intermedio')->where('active', 1)->select('id')->get()->pluck('id')->toArray();
        //Se obtienen todas las opciones de todas las preguntas, que servira para verificar si respondio correctamente.
        $opcionesPrueba = PruebaExcelSoloOpciones::whereIn('id_pregunta', $preguntas)->get();
        $correctas = 0;

        $respuesta_user = PruebaExcelSoloRespuestaUser::where('user_id', $this->user->id)->where('tipo', 'intermedio')->first();
        if ($respuesta_user == null) {
            $respuesta_user = new PruebaExcelSoloRespuestaUser();
        }
        $respuesta_user->user_id    = $this->user->id;
        $respuesta_user->tipo       = 'intermedio';
        $respuesta_user->fotos      = $nombres_fotos;
        $respuesta_user->fecha_respuesta = date('Y-m-d');
        $respuesta_user->total_preguntas = count($preguntas);

        $respuesta_user->save();

        $preg_resp = $request->except('req_id', 'userId', '_token', 'fotosExcel');
        foreach ($preg_resp as $preg_id_text => $opcion) {
            $pregunta_id = str_replace('preg_id_', '', $preg_id_text);

            $respuestas_intermedio = new PruebaExcelSoloRespuestaIntermedio();

            $respuestas_intermedio->user_id     = $this->user->id;
            $respuestas_intermedio->opcion_id   = $opcion;
            $respuestas_intermedio->pregunta_id = $pregunta_id;
            $respuestas_intermedio->respuesta_user_id = $respuesta_user->id;

            $verificar = $opcionesPrueba->find($opcion);
            //Se verifica si la seleccion del usuario era la respuesta correcta
            if ($verificar->correcta) {
                $correctas++;
            }

            $respuestas_intermedio->save();
        }

        $respuesta_user->respuestas_correctas = $correctas;
        $respuesta_user->save();

        return response()->json(['success' => true]);
    }

    public function pdf_prueba_excel($id_respuesta_user,$download=0) {
        $respuesta_user = PruebaExcelSoloRespuestaUser::join('datos_basicos','datos_basicos.user_id','=','prueba_excel_solo_respuestas_user.user_id')
            ->join('users', 'users.id', '=', 'datos_basicos.user_id')
            ->leftjoin("tipo_identificacion", "tipo_identificacion.id", "=", "datos_basicos.tipo_id")
            ->select(
                'datos_basicos.*',
                'prueba_excel_solo_respuestas_user.*',
                'prueba_excel_solo_respuestas_user.id as id_resp_user',
                'tipo_identificacion.descripcion as tipo_id_desc',
                'users.foto_perfil'
            )
        ->find($id_respuesta_user);

        if ($respuesta_user->tipo == 'basico') {
            $titulo_prueba = 'Prueba Excel Básico';
        } else if ($respuesta_user->tipo == 'intermedio') {
            $titulo_prueba = 'Prueba Excel Intermedio';
        }

        if ($respuesta_user == null) {
            return redirect()->back();
        }

        /*
        if (!Sentinel::inRole("admin") || !Sentinel::inRole("req")) {
            if ($this->user->id != $respuesta_user->user_id) {
                \Log::info('Intento de ver una prueba Excel modulo CV, que no corresponde al usuario logueado. User ID: ' . $this->user->id . ' Prueba ID: ' . $id_respuesta_user);
                return redirect()->back();
            }
        }
        */

        $sitio_informacion = Sitio::first();

        //vista para pruebas

        if(!$download){
            return view("admin.excel.pdf_prueba_excel_solo", compact('respuesta_user', 'titulo_prueba', 'sitio_informacion'));
        }
        else{

            return \SnappyPDF::loadView("admin.excel.pdf_prueba_excel_solo",[
                'respuesta_user'=>$respuesta_user,
                'titulo_prueba'=>$titulo_prueba,
                'sitio_informacion'=>$sitio_informacion
            ])->setPaper("A4")->output();

        }
    }

    public function pdf_prueba_excel_candidato($id_respuesta_user) {
        $respuesta_user = PruebaExcelSoloRespuestaUser::join('datos_basicos','datos_basicos.user_id','=','prueba_excel_solo_respuestas_user.user_id')
            ->join('users', 'users.id', '=', 'datos_basicos.user_id')
            ->leftjoin("tipo_identificacion", "tipo_identificacion.id", "=", "datos_basicos.tipo_id")
            ->select(
                'datos_basicos.*',
                'prueba_excel_solo_respuestas_user.*',
                'prueba_excel_solo_respuestas_user.id as id_resp_user',
                'tipo_identificacion.descripcion as tipo_id_desc',
                'users.foto_perfil'
            )
        ->find($id_respuesta_user);

        if ($respuesta_user->tipo == 'basico') {
            $titulo_prueba = 'Prueba Excel Básico';
        } else if ($respuesta_user->tipo == 'intermedio') {
            $titulo_prueba = 'Prueba Excel Intermedio';
        }

        if ($respuesta_user == null) {
            return redirect()->back();
        }

        if (!Sentinel::inRole("admin") || !Sentinel::inRole("req")) {
            if ($this->user->id != $respuesta_user->user_id) {
                \Log::info('Intento de ver una prueba Excel modulo CV, que no corresponde al usuario logueado. User ID: ' . $this->user->id . ' Prueba ID: ' . $id_respuesta_user);
                return redirect()->back();
            }
        }

        $sitio_informacion = Sitio::first();

        //vista para pruebas

        return view("admin.excel.pdf_prueba_excel_solo_candidato", compact('respuesta_user', 'titulo_prueba', 'sitio_informacion'));
    }
}
