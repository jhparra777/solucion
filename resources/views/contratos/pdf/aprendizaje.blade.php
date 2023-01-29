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

        .justify{ text-align: justify; }

        .list{ list-style: none; }

        .space{ line-height: 18px; }

        hr{
            page-break-after: always;
            border: none;
            margin: 0;
            padding: 0;
        }

        footer{
            position: fixed; 
            bottom: -20px; 
            font-size: 7pt;
        }
    </style>
</head>
<body>
    @include('contratos.includes._section_footer_marca_agua')
    <table width="100%" class="mt-1">
        <tr>
            <th width="10%"></th>

            <th class="text-left">
                @if (isset($empresa_contrata))
                    @if ($empresa_contrata != null || $empresa_contrata != '')
                      <img src="{{ asset('configuracion_sitio/'.$empresa_contrata->logo) }}" width="80" >
                    @endif
                @endif
            </th>

            <th class="text-right text-light">
                Fecha: <strong>{{$fecha}}</strong>
            </th>

            <th width="10%"></th>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <th class="text-center">
                <p>Firma de contrato</p>
                @if (isset($anulado))
                    <h4 style="color:red; margin:0; padding:0; font-size: 24px;">CONTRATO ANULADO</h4>
                @endif
            </th>
        </tr>

        @if($foto != null)
            <tr>
                <td class="text-center">
                    <img src="{{ asset('recursos_datosbasicos/'.$foto) }}" width="80" height="80" style="border-radius: 10px;">
                </td>
            </tr>
        @else
        @endif

        <tr>
            <td class="text-center mt-1">
                {{ $candidato->nombres }} {{ $candidato->primer_apellido }} {{ $candidato->segundo_apellido }}
            </td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <th>
                <p>CONTRATO DE APRENDIZAJE</p>
            </th>
        </tr>
    </table>

   <table class="center table justify" width="95%">
        <tr class="pd-1">
            <th class="text-left">
                EMPRESA:
            </th>
            
            <td colspan="4">
                SOLUCIONES INMEDIATAS S.A
            </td>
        </tr>

        <tr>
            <th class="text-left">
                NIT:
            </th>
            
            <td colspan="4">
                800199453
            </td>
        </tr>

        <tr>
            <th class="text-left">
                DIRECCION:
            </th>
            
            <td colspan="4">
                Transversal 6 No. 27 - 10 Oficina 601 Edificio Antares
            </td>
        </tr>

        <tr>
            <th class="text-left">
                TELEFONO:
            </th>
            
            <td colspan="4">
                7420777
            </td>
        </tr>

        <tr>
            <th class="text-left">
                REPRESENTANTE LEGAL:
            </th>

            <td colspan="4">
                VALENCIA BERNAL GERMAN FELIPE
            </td>
        </tr>

        <tr>

            <th class="text-left">
                CARGO:
            </th>

            <td colspan="4">
                REPRESENTANTE LEGAL
            </td>
        </tr>

        <tr>
            <th class="text-left">
                CEDULA NO.
            </th>

            <td colspan="4">
              79756755
            </td>
        </tr>

        <tr>
            <th class="text-left">
                NOMBRE APRENDIZ:
            </th>
            
            <td colspan="4">
                {{ $candidato->nombres }} {{ $candidato->primer_apellido }} {{ $candidato->segundo_apellido }}
            </td>
        </tr>

        <tr>
            <th class="text-left">
                CEDULA O TARJETA IDENTIDAD:
            </th>

            <td colspan="4">
              {{ ucwords(mb_strtolower($candidato->dec_tipo_doc)) }}
                {{ $candidato->numero_id }}
            </td>
        </tr>

        <tr>
            <th class="text-left">
                FECHA NACIMIENTO:
            </th>
            
            <td colspan="4">
                {{ $candidato->fecha_nacimiento }}
            </td>
        </tr>


        <tr>
            <th class="text-left">
                DIRECCION:
            </th>
            
            <td colspan="4">
                {{ $candidato->direccion }}
            </td>

        </tr>

        <tr>
            <th class="text-left">
                TELEFONO:
            </th>
            
            <td colspan="4">
                {{ $candidato->telefono_movil }}
            </td>

        </tr>

        <tr>
            <th class="text-left">
                CORREO ELECTRONICO: 
            </th>

            <td colspan="4">
                {{ $candidato->email }}
            </td>
        </tr>

       {{-- <tr>
            <th class="text-left">
                ESTRATO
            </th>

            <td colspan="4">
                1
            </td>
        </tr>--}}

        <tr>
            <th class="text-left">
                FECHA INICIACIÓN CONTRATO
            </th>

            <td>
                @if(isset($fechasContrato->fecha_ingreso))
                    {{ $fechasContrato->fecha_ingreso }}
                @endif
            </td>
        </tr>

        <tr>
            <th class="text-left">
                FECHA TERMINACIÓN CONTRATO
            </th>

            <td colspan="4">
                @if(isset($fechasContrato->fecha_fin_contrato))
                    {{ $fechasContrato->fecha_fin_contrato }}
                @endif
            </td>
        </tr>

        <tr>
            <th class="text-left">
                ESPECIALIDAD O CURSO:
            </th>

            <td colspan="4">
                {{ $candidato->especialidad }}
            </td>
        </tr>

        <tr>
            <th class="text-left">
                No. DE GRUPO:
            </th>

            <td colspan="4">
                {{ $candidato->numero_grupo }}
            </td>
        </tr>

        <tr>
            <th class="text-left">
                EPS DEL APRENDIZ:
            </th>

            <td colspan="4">
                {{ $candidato->entidades_eps_des }}
            </td>
        </tr>

        <tr>
            <th class="text-left">
                ARL DEL APRENDIZ:
            </th>

            <td colspan="4">
                ARP SURA
            </td>
        </tr>

        <tr>
            <th class="text-left">
                INSTITUCIÓN DE FORMACIÓN:
            </th>

            <td colspan="4">
                {{ $candidato->institucion }}
            </td>
        </tr>

        <tr>
            <th class="text-left">
                SI ES SENA CENTRO DE FORMACIÓN
            </th>

            <td colspan="4">
                {{ $candidato->sena_centro_formacion }}
            </td>
        </tr>

    </table>

    <table class="center table justify mt-2" width="95%">
        
        <tr>
            <th class="text-center">
                CLÁUSULAS
            </th>
        </tr>

        <tr>
            <td>
                <br/><br/>
                Entre los suscritos a saber <strong>VALENCIA BERNAL GERMAN FELIPE</strong>, identificado con la cédula de ciudadanía No._79756755 de Bogotá, actuando como Representante Legal de la Empresa <strong>SOLUCIONES INMEDIATAS S.A.</strong> NIT <strong>800199453</strong> quien para los efectos del presente Contrato se denominará EMPRESA y <strong>{{ $candidato->nombres }} {{ $candidato->primer_apellido }} {{ $candidato->segundo_apellido }}</strong> identificado con {{$candidato->dec_tipo_doc}} No <strong>{{ $candidato->numero_id }}</strong> Expedida en Cota, quien para los efectos del presente contrato se denominará el APRENDIZ, se suscribe el presente Contrato de Aprendizaje, conforme a lo preceptuado por la Ley 789 de 2002 y de acuerdo a las siguientes cláusulas:
            </td>
        </tr>

        {!! isset($cuerpo_contrato) ? $cuerpo_contrato->cuerpo_contrato : "" !!}

        <tr>
            <td>
                <br/><br/>
                <strong>OCTAVA</strong>.- El presente contrato de aprendizaje rige durante las fechas previstas como etapa productiva que se describen en la cláusula segunda de este contrato.
            </td>
        </tr>

        <tr>
            <td>
                <br/><br/>
                 Para efectos de lo anterior, firman a los {{ date('d') }} de {{ $meses[date('n')] }} de {{ date('Y') }}. 

            </td>
        </tr>

        <tr>
            <td>
                <br/><br/>
                Señor empresario: Recuerde que todos los contratos de aprendizaje y pagos de monetización deben ser registrados por parte de la empresa patrocinadora; en el Aplicativo SISTEMA GESTION VIRTUAL DE APRENDICES; así como deben ser registradas todas las suspensiones y/o terminaciones de Contratos de Aprendizaje (Acuerdo 11 de Noviembre 2.008).
            </td>
        </tr>
    </table>

    {{-- Contrato firmado --}}
    @if($firmaContrato != null || (isset($mostrar_firma) && $mostrar_firma === 'SI'))
        <table class="center table" width="80%">
            <tr>
                <td width="40%">
                    <div style="width: 100%; margin: 4em;">
                        <img src="{{ asset('contratos/default.jpg') }}" width="180">
                        <p>________________________________</p>
                        Por el patrono: <br>
                        Andrea del Pilar Ramirez <br>
                        Gerente de Gestión Humana
                        <br>
                    </div>
                </td>
                <td width="30%"></td>
                <td width="40%">
                    <div style="width: 100%; margin: 4em;">
                        @if ($firmaContrato != null)
                            <img src="{{ $firmaContrato->firma }}" width="180">
                        @endif
                        <p>________________________________</p>
                        El trabajador:<br>
                        {{ mb_strtoupper($candidato->nombres) }} {{ mb_strtoupper($candidato->primer_apellido)}} {{ mb_strtoupper($candidato->segundo_apellido)}}
                        <br>
                        {{ ucwords(mb_strtolower($candidato->dec_tipo_doc))}} : {{ $candidato->numero_id }}
                    </div>
                </td>
            </tr>
        </table>
    @endif

    @if(!isset($anulado) || (isset($mostrar_adicionales) && $mostrar_adicionales === 'SI'))
        @if(isset($adicionales))
            @if($adicionales->count() > 0)
                @foreach($adicionales as $ad)
                    <hr>
                    
                    <?php
                        $firma = null;
                        $documento_mostrar = "home.include.adicionales.documento_".$ad->adicional_id;
                        if($ad->firma != null && $ad->firma != ""){
                            $firma=$ad->firma;
                        }
                    ?>
                    
                    @include($documento_mostrar)

                    <?php
                        if(isset($firma)){
                            unset($firma);
                        }
                    ?>
                @endforeach
            @endif
        @endif

        @if(isset($adicional_externo))
            @if($adicional_externo->count() > 0)
                <?php
                    $firma = null;
                ?>
                <div style="page-break-after:always;"></div>
                @include("home.include.adicionales.documento_medico_recomendaciones", [
                    "recomendaciones" => $requerimiento_candidato_orden_pdf->especificacion,
                    "firma" => $adicional_externo->firma,
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

                    @include('admin.clausulas.template.layout', ["nuevo_cuerpo" => $nuevo_cuerpo, "empresa_contrata" => $empresa_contrata, "firma" => $firma, 'opcion_firma' => $clausula->opcion_firma]) 
                        

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
                        <li>Fecha y hora de firma: {{ $firmaContrato->created_at }}</li>
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
                    @if (empty($foto->estado))
                        <img 
                            class="m-1" 
                            src="{{ url("recursos_firma_contrato_fotos/contrato_foto_"."$userId"."_"."$req_id"."_"."$firmaContrato->id/$foto->descripcion") }}" 
                            alt="Foto candidato"
                            width="220"
                            style="padding: .25rem; width: 220px; background-color: #fff; border: 1px solid #dee2e6; border-radius: .25rem; max-width: 100%;">
                        <div style="margin-top: -1rem; font-size: 8pt; color: gray;">{{ $foto->created_at }}</div>
                    @else
                        <div class="m-1" style="padding: .25rem; font-size: 8pt; color: rgb(95, 95, 95);">{{ $foto->estado }}</div>
                    @endif

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