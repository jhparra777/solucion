<?php

namespace App\Http\Controllers;

use App\Models\Sitio;
use App\Http\Requests;
use App\Models\DatosBasicos;
use Illuminate\Http\Request;

use App\Helpers\triPostmaster;

use App\Models\RegistroProceso;
use Illuminate\Support\Facades\DB;

use App\Models\PruebaBrigResultado;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\PruebaBrigSolaResultado;
use App\Models\PruebaValoresRespuestas;
use App\Models\PruebaCompetenciaResultado;
use App\Models\PruebaValoresConfigEstandar;
use App\Models\CargoEspecificoConfigPruebas;
use App\Models\PruebaValoresRespuestasGeneral;
use App\Models\PruebaValoresConfigRequerimiento;

use Storage;

class ReusarPruebasController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function confirmar_reusar(Request $request)
    {
        $sitio = Sitio::first();

        $datos_candidato = DatosBasicos::where('user_id', $request->user_id)
        ->select(
            'datos_basicos.telefono_movil',
            'datos_basicos.email as email',
            DB::raw("CONCAT(datos_basicos.nombres,' ',datos_basicos.primer_apellido,' ',datos_basicos.segundo_apellido) AS nombre_completo")
        )
        ->first();

        if ($request->has('valores')) {
            $valores = $request->valores;
            if ($request->valores != 0) {
                $pvalores = explode("-", $valores);
                $this->reusar_evalues($request->user_id, $request->req_id, $request->cand_req_id, $pvalores[0], $pvalores[1]);
            } else {
                $this->crear_evalues($request->user_id, $request->req_id, $request->cand_req_id, $sitio, $datos_candidato);
            }
        }

        if ($request->has('competencias')) {
            if ($request->competencias != 'nueva') {
                $this->reusar_pskills($request->user_id, $request->req_id, $request->cand_req_id);
            }else {
                $this->crear_pskills($request->user_id, $request->req_id, $request->cand_req_id, $sitio, $datos_candidato);
            }
        }

        if ($request->has('bryg')) {
            if ($request->bryg != 'nueva') {
                $this->reusar_bryg($request->user_id, $request->req_id, $request->cand_req_id);
            }else {
                $this->crear_bryg($request->user_id, $request->req_id, $request->cand_req_id, $sitio, $datos_candidato);
            }
        }

        return response()->json(['success' => true]);
    }

    private function reusar_evalues($user_id, $req_id, $cand_req_id, $id_valores, $tabla_respuesta)
    {
        if ($tabla_respuesta == 'general') {
            $respEthicalValues = PruebaValoresRespuestasGeneral::find($id_valores);
            $ruta_vieja = 'recursos_prueba_valores_1/prueba_valores_1_'.$user_id;
        } else {
            $respEthicalValues = PruebaValoresRespuestas::find($id_valores);
            $ruta_vieja = 'recursos_prueba_valores_1/prueba_valores_1_'.$user_id.'_'.$respEthicalValues->req_id;
        }

        //Se verifica si el candidato ya respondio la prueba ethical values general (solo)
        if (!empty($respEthicalValues)) {
            $configuracionPruebaValores1 = PruebaValoresConfigRequerimiento::where('req_id', $req_id)->first();
            if (empty($configuracionPruebaValores1)) {
                $requerimiento = Requerimiento::find($req_id);
                //Se verifica si el sitio configura la prueba de valores 1
                $cargoConfigPruebas = CargoEspecificoConfigPruebas::where('cargo_especifico_id', $requerimiento->cargo_especifico_id)->orderBy('created_at', 'DESC')->first();

                //Si el cargo tiene configurada la prueba de valores, se agrega la configuracion al requerimiento
                if ($cargoConfigPruebas != null) {
                    $configuracionPruebaValores1 = new PruebaValoresConfigRequerimiento();
                    $configuracionPruebaValores1->gestiono            = $this->user->id;
                    $configuracionPruebaValores1->req_id              = $req_id;
                    $configuracionPruebaValores1->prueba_valores_1    = 'enabled';
                    $configuracionPruebaValores1->valor_verdad        = $cargoConfigPruebas->valor_verdad;
                    $configuracionPruebaValores1->valor_rectitud      = $cargoConfigPruebas->valor_rectitud;
                    $configuracionPruebaValores1->valor_paz           = $cargoConfigPruebas->valor_paz;
                    $configuracionPruebaValores1->valor_amor          = $cargoConfigPruebas->valor_amor;
                    $configuracionPruebaValores1->valor_no_violencia  = $cargoConfigPruebas->valor_no_violencia;

                    $configuracionPruebaValores1->save();
                } else {
                    $configEstandarGeneral = PruebaValoresConfigEstandar::where('active', 1)->orderBy('id', 'desc')->first();

                    $configuracionPruebaValores1 = new PruebaValoresConfigRequerimiento();
                    $configuracionPruebaValores1->gestiono            = $this->user->id;
                    $configuracionPruebaValores1->req_id              = $req_id;
                    $configuracionPruebaValores1->prueba_valores_1    = 'enabled';
                    $configuracionPruebaValores1->valor_verdad        = $configEstandarGeneral->valor_verdad;
                    $configuracionPruebaValores1->valor_rectitud      = $configEstandarGeneral->valor_rectitud;
                    $configuracionPruebaValores1->valor_paz           = $configEstandarGeneral->valor_paz;
                    $configuracionPruebaValores1->valor_amor          = $configEstandarGeneral->valor_amor;
                    $configuracionPruebaValores1->valor_no_violencia  = $configEstandarGeneral->valor_no_violencia;

                    $configuracionPruebaValores1->save();
                }
            }

            $campos = [
                'requerimiento_candidato_id'    => $cand_req_id,
                'usuario_envio'                 => $this->user->id,
                "fecha_inicio"                  => date("Y-m-d H:i:s"),
                'proceso'                       => "ENVIO_PRUEBA_ETHICAL_VALUES",
                'observaciones'                 => "Se asocia la prueba Ethical Values porque el candidato ya la ha respondido de forma individual o en otro requerimiento en la plataforma"
            ];

            $registrar_proceso = new ReclutamientoController();

            $id_proceso_ev = $registrar_proceso->RegistroProceso($campos, config('conf_aplicacion.C_EN_PROCESO_SELECCION'), $cand_req_id);

            $proceso_ev_general = RegistroProceso::find($id_proceso_ev);
            $proceso_ev_general->apto = 3;
            $proceso_ev_general->save();

            $respEthicalValuesReusar = collect($respEthicalValues)->only(
                'user_id',
                'fecha_respuesta',
                'valor_amor',
                'valor_no_violencia',
                'valor_paz',
                'valor_rectitud',
                'valor_verdad',
                'item_amor',
                'item_no_violencia',
                'item_paz',
                'item_rectitud',
                'item_verdad',
                'respuestas',
                'fotos'
            );

            $respuestasPrueba = new PruebaValoresRespuestas();

            //Se almacenan las mismas respuestas del candidato cuando respondio la prueba Ethical Values General (Solo) 
            $respuestasPrueba->fill(
                $respEthicalValuesReusar->all()
            );

            $respuestasPrueba->req_id           = $req_id;
            $respuestasPrueba->config_req_id    = $configuracionPruebaValores1->id;

            $respuestasPrueba->save();

            //Se copian las fotos para el candidato para el requerimiento
            $fotos = $respEthicalValues->getFotosArray();
            if (count($fotos)) {
                $ruta_req = 'recursos_prueba_valores_1/prueba_valores_1_'.$user_id.'_'.$req_id;
                $i = 0;
                foreach($fotos as $foto) {
                    if($foto != null && $foto != '') {
                        $fotoNombre = "candidato-foto-$i-$user_id-$req_id.png";
                        if (file_exists("$ruta_vieja/$foto")) {
                            //Si existe el archivo se copia
                            Storage::copy("$ruta_vieja/$foto", "$ruta_req/$fotoNombre");
                        }
                    }
                    $i++;
                }
            }
        }
    }

    private function crear_evalues($user_id, $req_id, $cand_req_id, Sitio $sitio, $datos_candidato) {
        $proceso = "ENVIO_PRUEBA_ETHICAL_VALUES";
        $titulo  = "Prueba Ethical Values";
        $ruta    = "cv.prueba_valores_1";

        $campos = [
            'requerimiento_candidato_id' => $cand_req_id,
            'usuario_envio'              => $this->user->id,
            "fecha_inicio"               => date("Y-m-d H:i:s"),
            'proceso'                    => "$proceso",
        ];

        $registrar_proceso = new ReclutamientoController();

        $registrar_proceso->RegistroProceso($campos, config('conf_aplicacion.C_EN_PROCESO_SELECCION'), $cand_req_id);

        $mensaje_wpp = $sitio->mensajePruebasWhatsapp($datos_candidato->nombre_completo, $titulo, route($ruta, ['req_id' => $req_id]));

        event(new \App\Events\NotificationWhatsappEvent("message",[
            "phone"=>"57".$datos_candidato->telefono_movil,
            "body"=> $mensaje_wpp
        ]));
        /**
         *
         * Usar administrador de correos
         *
        */
        $mailTemplate = 2; //Plantilla con botón e imagen de fondo
        $mailConfiguration = 1; //Id de la configuración
        $mailTitle = "$titulo"; //Titulo o tema del correo

        //Cuerpo con html y comillas dobles para las variables
        $mailBody = "
            Hola $datos_candidato->nombre_completo, has sido enviado/a en tu proceso de selección a realizar nuestra $titulo. <br>
            Por favor haz clic en botón <b>Realizar prueba</b> y sigue las instrucciones que te brindará la plataforma. <br><br>
            <i>¡Muchos éxitos!</i>
        ";

        //Arreglo para el botón
        $mailButton = ['buttonText' => 'Realizar prueba', 'buttonRoute' => route($ruta, ['req_id' => $datos_candidato->req_id])];

        $mailUser = $datos_candidato->user_id; //Id del usuario al que se le envía el correo

        $triEmail = triPostmaster::makeEmail($mailTemplate, $mailConfiguration, $mailTitle, $mailBody, $mailButton, $mailUser);

        //Enviar correo generado
        Mail::send($triEmail->view, ['data' => $triEmail->data], function ($message) use ($datos_candidato, $sitio, $titulo) {
            $message->to([$datos_candidato->email], 'T3RS')
            ->bcc($sitio->email_replica)
            ->subject("$titulo")
            ->getHeaders()
            ->addTextHeader('X-SES-CONFIGURATION-SET', 'watch_emails_t3rs');
        });
        /**
         * Fin administrador correos
        */
    }

    /**
     * Pskills
     */

    private function reusar_pskills($user_id, $req_id, $cand_req_id)
    {
        $pskills_sola = new PruebaCompetenciasSolaController();

        $pskills_sola->recalcular_resultados($user_id, $req_id, $cand_req_id);
    }

    private function crear_pskills($user_id, $req_id, $cand_req_id, Sitio $sitio, $datos_candidato)
    {
        //Crea registro para guardar los resultados
        $result_test = new PruebaCompetenciaResultado();

        $result_test->fill([
            'req_id'         => $req_id,
            'user_id'        => $user_id,
            'gestion_id'     => $this->user->id
        ]);
        $result_test->save();

        $campos = [
            'requerimiento_candidato_id' => $cand_req_id,
            'usuario_envio'              => $this->user->id,
            "fecha_inicio"               => date("Y-m-d H:i:s"),
            'proceso'                    => "ENVIO_PRUEBA_COMPETENCIA",
        ];

        $registrar_proceso = new ReclutamientoController();

        $registrar_proceso->RegistroProceso($campos, config('conf_aplicacion.C_EN_PROCESO_SELECCION'), $cand_req_id);

        $mensaje_wpp = $sitio->mensajePruebasWhatsapp($datos_candidato->nombre_completo, 'prueba de competencias', route('cv.competencias_inicio'));

        event(new \App\Events\NotificationWhatsappEvent("message",[
            "phone"=>"57".$datos_candidato->telefono_movil,
            "body"=> $mensaje_wpp
        ]));

        /**
         * Usar administrador de correos
        */
            $mailTemplate = 2; //Plantilla con botón e imagen de fondo
            $mailConfiguration = 1; //Id de la configuración
            $mailTitle = "Prueba Competencias"; //Titulo o tema del correo

            //Cuerpo con html y comillas dobles para las variables
            $mailBody = "
                Hola $datos_candidato->nombre_completo, has sido enviad@ en tu proceso de selección a realizar nuestra prueba de competencias. <br>
                Por favor haz clic en botón <b>Realizar prueba</b> y sigue las instrucciones que te brindará la plataforma. <br><br>
                <i>¡Muchos éxitos!</i>
            ";

            //Arreglo para el botón
            $mailButton = ['buttonText' => 'Realizar prueba', 'buttonRoute' => route('cv.competencias_inicio')];

            $mailUser = $user_id; //Id del usuario al que se le envía el correo

            $triEmail = triPostmaster::makeEmail($mailTemplate, $mailConfiguration, $mailTitle, $mailBody, $mailButton, $mailUser);

            //Enviar correo generado
            Mail::send($triEmail->view, ['data' => $triEmail->data], function ($message) use ($datos_candidato, $sitio) {
                $message->to([$datos_candidato->email], 'T3RS')
                ->bcc($sitio->email_replica)
                ->subject("Prueba Competencias")
                ->getHeaders()
                ->addTextHeader('X-SES-CONFIGURATION-SET', 'watch_emails_t3rs');
            });
        /**
         * Fin administrador correos
        */
    }

    /**
     * Bryg
     */

    private function reusar_bryg($user_id, $req_id, $cand_req_id)
    {
        //Reusar prueba
        $pruebaBrygCandidato = PruebaBrigSolaResultado::where('user_id', $user_id)
        ->where('estado', 1)
        ->orderBy('created_at', 'DESC')
        ->first();

        //Crea registro para guardar los resultados
        $result_test = new PruebaBrigResultado();
        $result_test->fill([
            'req_id'         => $req_id,
            'user_id'        => $user_id,
            'gestion_id'     => $this->user->id,
            'estilo_radical' => $pruebaBrygCandidato->estilo_radical,
            'estilo_genuino' => $pruebaBrygCandidato->estilo_genuino,
            'estilo_garante' => $pruebaBrygCandidato->estilo_garante,
            'estilo_basico' => $pruebaBrygCandidato->estilo_basico,
            'aumented_a' => $pruebaBrygCandidato->aumented_a,
            'aumented_p' => $pruebaBrygCandidato->aumented_p,
            'aumented_d' => $pruebaBrygCandidato->aumented_d,
            'aumented_r' => $pruebaBrygCandidato->aumented_r,
            'ajuste_perfil' => $pruebaBrygCandidato->ajuste_perfil,
            'estado' => 1,
            'fecha_realizacion' => $pruebaBrygCandidato->fecha_realizacion
        ]);
        $result_test->save();

        $campos = [
            'requerimiento_candidato_id' => $cand_req_id,
            'usuario_envio'              => $this->user->id,
            "fecha_inicio"               => date("Y-m-d H:i:s"),
            'proceso'                    => "ENVIO_PRUEBA_BRYG",
            'observaciones'              => "Prueba BRYG-A reusada de una anteriormente realizada por el candidato."
        ];

        $registrar_proceso = new ReclutamientoController();

        $registrar_proceso->RegistroProceso($campos, config('conf_aplicacion.C_EN_PROCESO_SELECCION'), $cand_req_id);
    }

    private function crear_bryg($user_id, $req_id, $cand_req_id, Sitio $sitio, $datos_candidato)
    {
        //Crea registro para guardar los resultados
        $result_test = new PruebaBrigResultado();
        $result_test->fill([
            'req_id'         => $req_id,
            'user_id'        => $user_id,
            'gestion_id'     => $this->user->id
        ]);
        $result_test->save();

        $campos = [
            'requerimiento_candidato_id' => $cand_req_id,
            'usuario_envio'              => $this->user->id,
            "fecha_inicio"               => date("Y-m-d H:i:s"),
            'proceso'                    => "ENVIO_PRUEBA_BRYG",
        ];

        $registrar_proceso = new ReclutamientoController();

        $registrar_proceso->RegistroProceso($campos, config('conf_aplicacion.C_EN_PROCESO_SELECCION'), $cand_req_id);

        $mensaje_wpp = $sitio->mensajePruebasWhatsapp($datos_candidato->nombre_completo, 'prueba BRYG-A', route('cv.prueba_inicio'));

        event(new \App\Events\NotificationWhatsappEvent("message",[
            "phone"=>"57".$datos_candidato->telefono_movil,
            "body"=> $mensaje_wpp
        ]));

        /**
         * Usar administrador de correos
        */
            $mailTemplate = 2; //Plantilla con botón e imagen de fondo
            $mailConfiguration = 1; //Id de la configuración
            $mailTitle = "Prueba BRYG-A"; //Titulo o tema del correo

            //Cuerpo con html y comillas dobles para las variables
            $mailBody = "
                Hola $datos_candidato->nombre_completo, has sido enviad@ en tu proceso de selección a realizar nuestra prueba BRYG-A. <br>
                Por favor haz clic en botón <b>Realizar prueba</b> y sigue las instrucciones que te brindará la plataforma. <br><br>
                <i>¡Muchos éxitos!</i>
            ";

            //Arreglo para el botón
            $mailButton = ['buttonText' => 'Realizar prueba', 'buttonRoute' => route('cv.prueba_inicio')];

            $mailUser = $datos_candidato->user_id; //Id del usuario al que se le envía el correo

            $triEmail = triPostmaster::makeEmail($mailTemplate, $mailConfiguration, $mailTitle, $mailBody, $mailButton, $mailUser);

            //Enviar correo generado
            Mail::send($triEmail->view, ['data' => $triEmail->data], function ($message) use ($datos_candidato, $sitio) {
                $message->to([$datos_candidato->email], 'T3RS')
                ->bcc($sitio->email_replica)
                ->subject("Prueba BRYG-A")
                ->getHeaders()
                ->addTextHeader('X-SES-CONFIGURATION-SET', 'watch_emails_t3rs');
            });
        /**
         * Fin administrador correos
        */
    }
}
