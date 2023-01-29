<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $configuracion_sst->titulo_pdf }}</title>
        <script type="text/javascript" src="{{ asset('js/no-back-button.js') }}"></script>
    </head>

    <style>

        body{
            font-family: Verdana, arial, sans-serif;
            font-size: 11px;
        }

        .otra tr td{
            font-size: 12px;
            padding-left: 50px;
            padding-top: 13px;
        }

        .tabla1, .tabla3{
            border-collapse: collapse;
            width: 100%;
        }

        .tabla2{
            border-collapse: collapse;
            width: 100%;
        }
      
        .tabla1, .tabla1 th, .tabla1 td,.tabla3 th, .tabla3 td {
            border: none;
            padding: 0;
            margin: 0;
        }

        .tabla2 td {
            padding: 0;
            margin: 0;
        }

        .tabla2 th {
            background-color: #fdf099;
            font-size: 14px;
            font-weight: bold;
            padding: 0;
            margin: 0;
            text-align: center;
            /*text-transform: capitalize;*/
        }

        @page { margin: 50px 50px; }

        .page-break {
            page-break-after: always;
        }

        .imagen{
            height: 150px
        }

        .titulo{
            background-color: #333131;
            padding: 10px 0px;
            color: #FFFFFF;
            text-align: center;
            font-size: 16px;
        }

        .tabla1 tr th{
            background-color: #fdf099;
            font-weight: bold;
            padding: 5px 10px;
            text-align: left;
            width: 180px;
            font-size: 14px;
        }

        .tabla2 tr th{
            background-color: #fdf099;
            font-weight: bold;
            padding: 5px 10px;
            text-align: left;
            font-size: 14px;
        }

        .tabla1 tr td{
            padding: 5px 10px;
            font-size: 14px;
            width: 100%;
        }

        .tabla2 tr td{
            padding: 5px 10px;
            font-size: 14px;
        }

        span{
            width: 72% !important;
            padding: 5px 0px 5px 0px;
        }

        span .td {
            border: none !important;
            background: White !important;
            padding-left: 10px;
            font-size: 16px;
            margin-bottom: 30px;
            border:none !important;
        }

        span .tr {
            /* display: table-row;*/
            border: 1px solid Black;
            padding: 2px 2px 2px 5px;
            background-color: #f5f5f5;
        }
            
        span .th {
            text-align: left;
            font-weight: bold;
        }

        .col-center{
            float: none;
            margin-left: auto;
            margin-right: auto;
        }

        .logo_derecha{      
            position: absolute;
            right: 0;
        }

        .correcto {
            background-color: #fdf099;
        }

        .seleccion {
            background-color: #fdf099;
        }

        .color-blue{ color: #2E2D66; }

        .divider{ width: 44.5%; background-color: #2E2D66; color: #2E2D66; border: 0; height: 1px; }
        .divider-th{ width: 90%; background-color: #2E2D66; color: #2E2D66; border: 0; height: 1px; }

        .text-center{ text-align: center; }
        .text-left{ text-align: left; }

        .fs-14 {
            font-size: 14px;
        }

        .m-0{ margin: 0; }
        .m-1{ margin: 1rem; }
        .m-2{ margin: 2rem; }
        .m-3{ margin: 3rem; }
        .m-4{ margin: 4rem; }

        .mt-1{ margin-top: 1rem; }

        .ml-2{ margin-left: 2rem !important; }
    </style>

    <body onload="nobackbutton();">
        <table width="100%">
          <tr>
            <td class="text-justify">
              <img alt="encabezado_sst" height="102" src="{{public_path('encabezado_sst.jpg')}}" width="650">
            </td>
          </tr>
        </table>
        <br><br>

        <table>
            <tr>
                <td><h3>{{ $configuracion_sst->titulo_pdf }}</h3></td>
            </tr>
        </table>

        {{-- Datos del requerimiento --}}
        <section>
            <div class="mt-1">
                <table width="100%" class="fs-14">
                    <tr>
                        <th class="text-left" width="50%">
                            <span class="color-blue m-0">
                                Cliente:</span> {{ ucfirst(mb_strtolower($respuesta_user->requerimiento->nombre_cliente_req())) }}
                        </th>
                    </tr>
                    <tr>
                        <th class="text-left" width="50%">
                            <span class="color-blue m-0">
                                Cargo:</span> {{ ucfirst(mb_strtolower($respuesta_user->requerimiento->cargo_req())) }}
                        </th>
                    </tr>
                </table>
            </div>
        </section>

        <table class="tabla1 mt-1" style="width:100%;">
            <?php
                $respuestas = json_decode($respuesta_user->respuestas);
                $nro_preg = 0;
            ?>

            @foreach ($respuestas as $preg_id_text => $opcion_candidato)
                <?php
                    $pregunta_id = str_replace('preg_id_', '', $preg_id_text);

                    $pregunta = $preguntasAll->find($pregunta_id);

                    $options = $pregunta->allOptions;

                    $nro_opcion = 0;

                    $nro_preg++;
                ?>
                <tr>
                    <td style="text-align: left; width:90%; font-weight:bold;">{{ $nro_preg }}) {{ $pregunta->descripcion }}</td>
                </tr>
                @if ($pregunta != null && $pregunta->tipo == 'seleccion_simple')
                    @foreach ($options as $op)
                        <?php
                            $class_adicional = '';
                            if ($op->id == $opcion_candidato) {
                                $class_adicional = 'seleccion';
                            }
                        ?>
                        <tr>
                            <td class="{{ $class_adicional }}" style="width:100%;">
                                {{ $letras[$nro_opcion] }} {!! $op->descripcion !!}
                            </td>
                        </tr>
                        <?php $nro_opcion++; ?>
                    @endforeach
                @elseif ($pregunta != null && $pregunta->tipo == 'seleccion_multiple')
                    @foreach ($options as $op)
                        <?php
                            $class_adicional = '';

                            if (in_array($op->id, $opcion_candidato)) {
                                $class_adicional = 'seleccion';
                            }
                        ?>
                        <tr>
                            <td class="{{ $class_adicional }}" style="width:100%;">
                                {{ $letras[$nro_opcion] }} {!! $op->descripcion !!}
                            </td>
                        </tr>
                        <?php $nro_opcion++; ?>
                    @endforeach
                @elseif ($pregunta != null && $pregunta->tipo == 'respuesta_abierta')
                    <tr>
                        <td style="width: 100%">{{ $opcion_candidato }}</td>
                    </tr>
                @endif
            @endforeach
            <tr>
              <td style="text-align:justify;">
                <br/><br/>
                Yo {{$respuesta_user->nombres.' '.$respuesta_user->primer_apellido.' '.$respuesta_user->segundo_apellido}},
                  identificado con {{$respuesta_user->tipo_id_desc}} N° {{$respuesta_user->numero_id}},
                  dejo constancia de que recibí inducción en Seguridad y Salud en el Trabajo;
                  me permito informar que se me dieron a conocer Políticas del SGSST y
                  normas de seguridad. Entiendo que el objetivo de estas normas de
                  seguridad es el de evitar la ocurrencia de accidentes de trabajo y/o
                  enfermedades laborales.<br><br>
                  Me comprometo a cumplir las normas de seguridad estipuladas y las que
                  estén definidas en la empresa usuaria donde labore, con el único propósito
                  de evitar que me ocurran accidentes a mí o a mis compañeros de trabajo; a
                  informar los accidentes de trabajo inmediatamente ocurran al supervisor,
                  jefe inmediato o encargado de SST de la empresa usuaria; a notificar
                  cualquier condición insegura que se presente en mi lugar de trabajo y a no
                  cometer actos inseguros que pongan en riesgo mi salud y mi vida.
              </td>
          </tr>
        </table>

        <table class="tabla2 m-1">
            <tr>
                <td style="width: 55%;">
                    <p><img src="{{ $respuesta_user->firma }}" width="180" style="margin:0; padding:0;"> <br>___________________________________</p>
                    <p>Nombre: {{ $respuesta_user->nombres.' '.$respuesta_user->primer_apellido.' '.$respuesta_user->segundo_apellido }} </p>
                    <p>
                        {{ $respuesta_user->tipo_id_desc }}: {{ $respuesta_user->numero_id }}
                    </p>
                    <p>Fecha: {{ dar_formato_fecha($respuesta_user->updated_at) }}</p>
                </td>

                <td style="width: 45%">
                    <p style="font-size: 19px;">
                        Respuestas correctas <span style="text-align: right; margin-left:8px;">{{ $respuesta_user->respuestas_correctas }}/{{ $respuesta_user->total_preguntas }}</span>
                        <br><br>
                        Puntuación <span style="text-align: right; margin-left:20px;">{{ $respuesta_user->puntuacion }}%</span>
                    </p>
                </td>
            </tr>
        </table>

        <?php
            $fotos = $respuesta_user->getFotosArray();
            $ruta = 'recursos_evaluacion_induccion/evaluacion_induccion_'.$respuesta_user->candidato_id.'_'.$respuesta_user->req_id.'_'.$respuesta_user->id_eva;
        ?>
        <div class="page-break"></div>

        <section>
            <div class="text-center">
                <h4>Fotos tomadas durante el proceso de la evaluación</h4>

                @forelse($fotos as $foto)
                    @if(!triRoute::validateOR('local') && $foto != null && $foto != '')
                        <img 
                            class="m-1" 
                            src="{{ asset("$ruta/$foto") }}" 
                            alt="Foto candidato prueba"
                            width="220">
                    @elseif(!triRoute::validateOR('local'))
                        <img class="m-1" src="https://picsum.photos/640/420" alt="T3RS" width="220">
                    @endif
                @empty
                    <br>
                    <p>
                        No se presenta evidencia fotográfica debido a que el candidato no autorizó el uso de cámara durante la presentación de la evaluación.
                    </p>
                @endforelse
            </div>
        </section>
    </body>
</html>
