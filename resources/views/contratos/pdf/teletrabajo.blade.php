<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Firma de contrato</title>

    <style>
        html{
            font-family: 'Arial';
        }

        body{
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            font-size: 12px;
            line-height: 1.2;
            color: black;
            background-color: #fff;
        }

        .text-center{ text-align: center;  }
        .text-left{ text-align: left;  }
        .text-right{ text-align: right;  }
        .text-light{ font-weight: lighter; }

        .m-1{ margin: 1rem; }
        .mt-1{ margin-top: 1rem; }
        .mt-2{ margin-top: 2rem; }
        .mt-3{ margin-top: 3rem; }
        .mt-4{ margin-top: 4rem; }

        .pd-1{ padding: 1rem; }

        .center{ margin: auto; }

        .table{
            border-collapse:separate; 
            /*border-spacing: 6px;*/
        }

        .titulo{
            background-color: #333131;
            padding: 10px 0px;
            color: #FFFFFF;
            text-align: center;
            font-size: 16px;
        }

        .tabla1, .tabla3{
            border-collapse: collapse;
            width: 100%;
        }

        .tabla1, .tabla1 th, .tabla1 td,.tabla3 th, .tabla3 td {
            border: 1px solid black;
            padding: 0;
            margin: 0;
            text-align: left !important;
        }

        .justify{ text-align: justify; }

        .list{ list-style: none; }

        .space{ line-height: 18px; }

        hr{
            page-break-after: always;
            border: none;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <table width="100%" class="mt-1">
        <tr>
            <th width="10%"></th>
            <th class="text-left">
                @if(isset($sitio->logo))
                    @if($sitio->logo != "")
                        <img src="{{ asset('configuracion_sitio/'.$sitio->logo) }}" alt="Logo T3RS" class="izquierda" width="150">
                    @else
                        <img src="{{ asset('img/logo.png')}}" alt="Logo T3RS" class="izquierda" width="150">
                    @endif
                @else
                    <img src="{{url('img/logo.png')}}" alt="Logo T3RS" class="izquierda" width="150">
                @endif
            </th>

            <th class="text-right text-light">
                Fecha: <strong>{{ $fecha }}</strong>
            </th>

            <th width="10%"></th>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <th class="text-center">
                <p></p>
                @if (isset($anulado))
                    <h4 style="color:red; margin:0; padding:0; font-size: 24px;">CONTRATO ANULADO</h4>
                @endif
            </th>
        </tr>

        {{-- @if($foto != null)
           <tr>
                <td class="text-center">
                  <img src="{{ asset('recursos_datosbasicos/'.$foto) }}" width="80" height="80" style="border-radius: 10px;">
                </td>
            </tr>
        @else--}}
    </table>

    <table width="100%">
        <tr>
            <th class="text-center">
                <p>CONTRATO DE TRABAJO POR DURACIÓN DE OBRA O LABOR DETERMINADA</p>
                <p>EN MODALIDAD TELETRABAJO</p>
            </th>
        </tr>
    </table>

    <div style="">
        <table class="tabla1">
            <tr>
                <td width="40%"> <strong> E.S.T Empleadora: </strong> <br> SOLUCIONES INMEDIATAS S.A. </td>
                <td width="40%">
                    <strong> Domicilio del Empleador: </strong> <br> 
                    @if(isset($reqcandidato->agencia_direccion))
                        {{ $reqcandidato->agencia_direccion }}
                    @else
                        {{-- Para previsualización del contrato --}}
                        @if(isset($requerimiento_informacion->agencia_direccion))
                            {{ $requerimiento_informacion->agencia_direccion }}
                        @endif
                    @endif
                </td>
            </tr>

            <tr>
                <td width="40%"> <strong> Representada por: </strong> <br> GERMAN FELIPE VALENCIA BERNAL</td>
                <td width="40%"> <strong> Cargo: </strong> <br> REPRESENTANTE LEGAL</td>
            </tr>

            <tr>
                <td width="40%"> <strong> Número de identificación del trabajador en misión: </strong> <br> {{ $candidato->numero_id }}</td>
                <td width="40%"> <strong> Apellidos y Nombres del trabajador en misión : </strong> <br> {{ $candidato->primer_apellido }} {{ $candidato->segundo_apellido }} {{ $candidato->nombres }}</td>
            </tr>

            <tr>
                <td width="40%"> <strong> Lugar y fecha de nacimiento: </strong> <br> {{ (($lugarnacimiento != null) ? ucwords(mb_strtolower($lugarnacimiento->value)) : "") }} {{ date('d/m/Y',strtotime($candidato->fecha_nacimiento)) }}</td>
                <td width="40%"> <strong> Dirección de residencia trabajador </strong> : <br> 
                    @if($lugarresidencia != null)
                        {{ ucwords(mb_strtolower($lugarresidencia->value)) }}
                    @endif  
                    {{ ucwords(mb_strtolower($candidato->direccion)) }}
                </td>
            </tr>

            <tr>
                <td width="40%"> <strong> Empresa usuaria donde se remite: </strong> <br> 
                    @if(isset($reqcandidato->cliente_nombre))
                        {{ $reqcandidato->cliente_nombre }}
                    @else
                        {{-- Para previsualización del contrato --}}
                        @if(isset($requerimiento_informacion->cliente_nombre))
                            {{ $requerimiento_informacion->cliente_nombre }}
                        @endif
                    @endif
                </td>

                <td width="40%"> <strong> Objeto comercial que da origen a la presentación del servicio: </strong> <br> 
                    @if(isset($reqcandidato->codigo_sercon))
                        {{ $reqcandidato->codigo_sercon }}
                    @else
                        {{-- Para previsualización del contrato --}}
                        @if(isset($requerimiento_informacion->codigo_sercon))
                            {{ $requerimiento_informacion->codigo_sercon }}
                        @endif
                    @endif
                </td>
            </tr>

            <tr>
                <td width="40%"> <strong> Labor u obra determinada para la que se le contrata: </strong> <br> 
                    @if(isset($reqcandidato->funciones))
                        <p style="text-align:justify; width:85%;">{{ $reqcandidato->descripcion_sercon }}</p>
                    @else
                        {{-- Para previsualización del contrato --}}
                        @if(isset($requerimiento_informacion->descripcion_sercon))
                            <p style="text-align:justify; width:85%;">{{ $requerimiento_informacion->descripcion_sercon }}</p>
                        @endif
                    @endif
                </td>
                <td width="40%"> <strong> Lugar donde desempeña las labores: </strong> <br> {{ $requerimiento->getUbicacion() }}</td>
            </tr>

            <tr>
                <td width="40%"> <strong> Ciudad donde ha sido contratado: </strong> <br>
                    {{ $requerimiento->agencia_req() }}
                </td>

                <td width="40%"> <strong> Tipo trabajo: </strong> <br>
                @if(isset($reqcandidato->tipo_trabajo))
                        {{ $reqcandidato->tipo_trabajo }}
                    @else
                        {{-- Para previsualización del contrato --}}
                        @if(isset($requerimiento_informacion->tipo_trabajo))
                            {{$requerimiento_informacion->tipo_trabajo}}
                        @endif
                    @endif
                </td>
            </tr>

            <tr>
                <td width="40%"> <strong> 
                @if($requerimiento->tipo_salario == 3)
                  Salario por día laborado con base al SMLV 908526:
                @elseif($requerimiento->tipo_salario == 4)
                  Salario por hora laborada:
                @else
                  Salario mensual:
                @endif
                 </strong> <br> 
                    @if(isset($reqcandidato->salario))
                        $ {{ number_format($reqcandidato->salario) }} @if($requerimiento->tipo_nomina == 2)&nbsp;&nbsp;Salario integral @endif
                        
                        @if( $requerimiento->tipo_salario == 3 || $requerimiento->tipo_salario == 4 )
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>NOTA:</b> Se garantiza el pago de seguridad social sobre el SMLV
                        @endif
                    @else
                        {{-- Para previsualización del contrato --}}
                        @if(isset($requerimiento_informacion->salario))
                            $ {{ number_format($requerimiento_informacion->salario) }} @if($requerimiento->tipo_nomina == 2)&nbsp;&nbsp;Salario integral @endif
                            @if( $requerimiento->tipo_salario == 3 || $requerimiento->tipo_salario == 4 ) 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <b>NOTA:</b> Se garantiza el pago de seguridad social sobre el SMLV
                            @endif
                        @endif
                    @endif
                </td>

                <td width="40%"> <strong> Cargo para el cual a sido contratado: </strong> <br>
                    @if(isset($reqcandidato->nombre_cargo_especifico))
                        {{ $reqcandidato->nombre_cargo_especifico }}
                    @else
                        {{-- Para previsualización del contrato --}}
                        @if(isset($requerimiento_informacion->nombre_cargo_especifico))
                            {{ $requerimiento_informacion->nombre_cargo_especifico }}
                        @endif
                    @endif
                </td>
            </tr>
            
            <tr>
                <td width="40%"> <strong> Pagadero por: </strong> <br> {{ ($requerimiento->tipo_liquidacion) ? $requerimiento->getTipoLiquidacion()->descripcion : '' }}</td>
                <td width="40%"> <strong> Fecha de inicio de labores: </strong> <br> {{ ($fechasContrato != null) ? $fechasContrato->fecha_ingreso : '' }}</td>
            </tr>
            
            <tr>
                <td width="40%">
                    <strong> EPS: </strong> <br> {{ ( isset($fechasContrato->entidad_eps) && $fechasContrato->entidad_eps != '' ? $fechasContrato->entidad_eps : $candidato->entidades_eps_des) }}
                </td>

                <td width="40%"> 
                    <strong> AFP: </strong> <br> {{ ( isset($fechasContrato->entidad_afp) && $fechasContrato->entidad_afp != '' ? $fechasContrato->entidad_afp : $candidato->entidades_afp_des) }}
                </td>
            </tr>

            <tr>
                <td width="40%">
                    <strong> Día de la Semana </strong> 
                    <br>
                    @if(isset($reqcandidato->dia_semana))
                        {{ $reqcandidato->dia_semana }}
                    @else
                        {{-- Para previsualización del contrato --}}
                        @if(isset($requerimiento_informacion->dia_semana))
                            {{ $requerimiento_informacion->dia_semana }}
                        @endif
                    @endif
                </td>
            
                <td width="40%">
                        <strong>Horario</strong>
                        <br>
                        <strong>Mañana:</strong>
                        @if(isset($reqcandidato->horario_dia))
                        {{ $reqcandidato->horario_dia }}
                        @else
                            {{-- Para previsualización del contrato --}}
                            @if(isset($requerimiento_informacion->horario_dia))
                                {{ $requerimiento_informacion->horario_dia }}
                            @endif
                        @endif
                        <br>
                        <strong>Tarde:</strong>
                        @if(isset($reqcandidato->horario_tarde))
                        {{ $reqcandidato->horario_tarde }}
                        @else
                            {{-- Para previsualización del contrato --}}
                            @if(isset($requerimiento_informacion->horario_tarde))
                                {{ $requerimiento_informacion->horario_tarde }}
                            @endif
                        @endif
                </td>
            </tr>

            <tr>
                <td width="40%">
                    <strong>Tipo Teletrabajador</strong>
                    <br>
                    @if(isset($reqcandidato->tipo_teletrabajador))
                        {{ $reqcandidato->tipo_teletrabajador }}
                    @else
                        {{-- Para previsualización del contrato --}}
                        @if(isset($requerimiento_informacion->tipo_teletrabajador))
                            {{ $requerimiento_informacion->tipo_teletrabajador }}
                        @endif
                    @endif
                </td>
            
                <td width="40%">
                    <strong>Descanso</strong>
                    <br>
                    @if(isset($reqcandidato->descanso_teletrabajador))
                        {{ $reqcandidato->descanso_teletrabajador }}
                    @else
                        {{-- Para previsualización del contrato --}}
                        @if(isset($requerimiento_informacion->descanso_teletrabajador))
                            {{ $requerimiento_informacion->descanso_teletrabajador }}
                        @endif
                    @endif
                </td>
            </tr>
            <tr>
                <td width="40%">
                    <strong>Días de teletrabajo asignado</strong>
                    <br>
                    @if(isset($reqcandidato->dias_teletrabajar))
                        {{ $reqcandidato->dias_teletrabajar }}
                    @else
                        {{-- Para previsualización del contrato --}}
                        @if(isset($requerimiento_informacion->dias_teletrabajar))
                            {{ $requerimiento_informacion->dias_teletrabajar }}
                        @endif
                    @endif
                </td>
            
                <td width="40%">
                    <strong>Días de trabajo oficina</strong>
                    <br>
                    @if(isset($reqcandidato->dias_trabajar_oficina))
                        {{ $reqcandidato->dias_trabajar_oficina }}
                    @else
                        {{-- Para previsualización del contrato --}}
                        @if(isset($requerimiento_informacion->dias_trabajar_oficina))
                            {{ $requerimiento_informacion->dias_trabajar_oficina }}
                        @endif
                    @endif
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <strong>Ubicación del lugar de trabajo</strong>
                    <br>
                    {{$candidato->direccion}}
                </td>
            </tr>
        </table>
    {{-- </div> --}}

        <table class="center table justify mt-2" width="95%">
            <tr>
                <td>
                Entre la E.S.T. empleadora y el trabajador en misión, de las condiciones civiles anotadas, 
                identificados como se anotara al pie de nuestras firmas, se ha celebrado el presente contrato de trabajo 
                de obra o labor en la modalidad de teletrabajo regido además de las disposiciones legales para tal fin, 
                por las siguientes cláusulas:
                <br/><br/>
                {!! isset($cuerpo_contrato) ? $cuerpo_contrato->cuerpo_contrato : "" !!}
                </td>
            </tr>
            <tr>
                <td>
                    En señal de aceptación y de conformidad, las partes suscriben este contrato en 
                    @if(isset($reqcandidato->nombre_ciudad))
                        {{ $reqcandidato->nombre_ciudad }}
                    @else
                        {{-- Para previsualización del contrato --}}
                        @if(isset($requerimiento_informacion->nombre_ciudad))
                            {{ $requerimiento_informacion->nombre_ciudad }}
                        @endif
                    @endif
                     el <?php setlocale(LC_TIME, 'es_ES.UTF-8'); echo strftime(" %d de %B de %Y") ?>.
                    <br><br>
                </td>
            </tr>
        </table>

        {{-- Contrato firmado --}}
        @if($firmaContrato != null || (isset($mostrar_firma) && $mostrar_firma === 'SI'))
            <table class="tabla1" width="80%" style="border:none !important;">
                <tr>
                    <td width="40%">
                    <div style="width: 100%; margin: 4em;">
                        <p><img src="{{ asset('contratos/default.jpg') }}" width="180" style="margin:0;padding:0;"></p>
                        <p>________________________________</p>
                            Por el patrono:
                        <p> Andrea del Pilar Ramirez </p>
                        <p> Gerente de Gestión Humana </p>
                        <br>
                        </div>
                    </td>
                    <td width="40%">
                        <div style="width: 100%; margin: 4em;">
                            @if ($firmaContrato != null)
                                <img src="{{ $firmaContrato->firma }}" width="180">
                            @endif
                            <p>________________________________</p>
                            El trabajador:<br>
                            {{ mb_strtoupper($candidato->nombres) }} {{ mb_strtoupper($candidato->primer_apellido)}} {{ mb_strtoupper($candidato->segundo_apellido) }}
                            <br>
                            {{ ucwords(mb_strtolower($candidato->dec_tipo_doc)) }} : {{ $candidato->numero_id }}
                        </div>
                    </td>
                </tr>
            </table>
        @endif
   </div>

    @if(!isset($anulado) || (isset($mostrar_adicionales) && $mostrar_adicionales === 'SI'))
        @if(isset($adicionales))
            @if($adicionales->count() > 0)
                @foreach($adicionales as $ad)
                    <?php $firma = ""; ?>
                    <hr>
                    
                    <?php
                        $firma = null;
                        $documento_mostrar = "home.include.adicionales.documento_".$ad->adicional_id;
                        if($ad->firma != null && $ad->firma != ""){
                            $firma=$ad->firma;
                        }
                    ?>
                    
                    @include($documento_mostrar, array('firma' => $firma))
                @endforeach
            @endif
        @endif
    
        @if(isset($adicional_externo))
            @if($adicional_externo->count() > 0)
                <div style="page-break-after:always;"></div>
                @include("home.include.adicionales.documento_medico_recomendaciones", [
                    "recomendaciones" => $requerimiento_candidato_orden_pdf->especificacion,
                    "firma" => isset($adicional_externo->firma) ? $adicional_externo->firma : null,
                    "lugarexpedicion" => $lugarexpedicion_medica,
                    "isPDF" => true
                ])
            @endif
        @endif
        
        {{-- cláusulas creadas --}}
        @if(isset($adicionales_creadas))
            @if($adicionales_creadas->count() > 0)
                @foreach($adicionales_creadas as $clausula)
                    <hr>
                    
                    <?php
                        $firma = null;
                        if($clausula->firma != null && $clausula->firma != ""){
                            $firma = $clausula->firma;
                        }

                        $nuevo_cuerpo = App\Jobs\FuncionesGlobales::search_and_replace(
                            $replace, 
                            $clausula->contenido_clausula, 
                            ['adicional_id' => $clausula->adicional_id, 'req_id' => $req_id, 'cargo_id' => $clausula->cargo_id, 'user_id' => $userId]
                        );
                    ?>

                    {{-- 
                        @if (isset($empresa_contrata))
                            @if ($empresa_contrata != null || $empresa_contrata != '')
                                @include('admin.clausulas.template.layout', ["nuevo_cuerpo" => $nuevo_cuerpo, "empresa_contrata" => $empresa_contrata->logo, "firma" => $firma])
                            @endif
                        @else
                            @include('admin.clausulas.template.layout', ["nuevo_cuerpo" => $nuevo_cuerpo])
                        @endif
                    --}}

                    @include('admin.clausulas.template.layout', ["nuevo_cuerpo" => $nuevo_cuerpo, 'opcion_firma' => $clausula->opcion_firma])

                    <?php
                        if(isset($firma)){
                            unset($firma);
                        }
                    ?>
                @endforeach
            @endif
        @endif

        @if (isset($mostrar_adicionales) && $mostrar_adicionales === 'SI')
            <div style="page-break-after:always;"></div>
            @include("home.confirmacion_manual", array('firma' => '-1'))
        @endif
    @endif

    @if($firmaContrato != null)
        <div style="page-break-after:always;"></div>

        <table class="center table justify" width="80%">
            <tr>
                <td>
                    <p>Información especial del contrato</p>
                    <ul class="list">
                        <li>IP: {{ $firmaContrato->ip }}</li>
                        <li>Fecha y hora de firma: {{ date("Y-m-d H:i:s") }}</li>
                        <li>Token de acceso: {{ $reqcandidato->token_acceso }}</li>
                        {{--<li>{!!QrCode::size(200)->generate("www.t3rsc.com") !!}</li>--}}
                    </ul>
                </td>
            </tr>
        </table>
    @endif

    @if(count($contrato_fotos) > 0)
        <div style="page-break-after:always;"></div>

        <section>
            <p class="text-center">
                <b>
                    Fotos tomadas durante la firma de los documentos
                </b>
            </p>
        </section>

        <section>
			<div class="text-center">
				@foreach($contrato_fotos as $key => $foto)
                    <img 
                        class="m-1" 
                        src="{{ url("recursos_firma_contrato_fotos/contrato_foto_"."$userId"."_"."$req_id"."_"."$firmaContrato->id/$foto->descripcion") }}" 
                        alt="Foto candidato"
                        width="220"
                        style="padding: .25rem; width: 220px; background-color: #fff; border: 1px solid #dee2e6; border-radius: .25rem; max-width: 100%;">
                    <div style="margin-top: -1rem; font-size: 8pt; color: gray;">{{ $foto->created_at }}</div>

                    <?php
						if ($key === 7) {
							break;
						}
					?>
	            @endforeach
			</div>
		</section>
    @endif
</body>
</html>