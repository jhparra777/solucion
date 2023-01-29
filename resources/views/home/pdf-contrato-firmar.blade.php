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
            font-size: 9pt;
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
                @else
                    <img alt="Logo T3RS" class="izquierda" src="{{url('img/logo.png')}}" width="150">
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
            </th>
        </tr>
    </table>

    <div style="">
        <table class="tabla1">
            <tr>
                <td width="40%"> <strong> E.S.T Empleadora: </strong> <br> SOLUCIONES INMEDIATAS S.A. </td>
                <td width="40%"> <strong> Domicilio del Empleador: </strong> <br> 
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
                <td width="40%"> <strong> Representada por: </strong> <br> GERMAN FELIPE VALENCIA BERNAL </td>
                <td width="40%"> <strong> Cargo: </strong> <br> REPRESENTANTE LEGAL</td>
            </tr>

            <tr>
                <td width="40%"> <strong> Número de identificación del trabajador en misión: </strong> <br> {{ $candidato->numero_id }} </td>
                <td width="40%"> <strong> Apellidos y Nombres del trabajador en misión : </strong> <br> {{ $candidato->primer_apellido }} {{ $candidato->segundo_apellido }} {{ $candidato->nombres }} </td>
            </tr>

            <tr>
                <td width="40%"> <strong> Lugar y fecha de nacimiento: </strong> <br> {{ (($lugarnacimiento != null) ? ucwords(mb_strtolower($lugarnacimiento->value)) : "") }} {{ date('d/m/Y',strtotime($candidato->fecha_nacimiento)) }}</td>
                <td width="40%"> <strong> Dirección de residencia trabajador </strong> : <br> 
                    @if($lugarresidencia != null)
                        {{ ucwords(mb_strtolower($lugarresidencia->value)) }}
                    @endif  {{ ucwords(mb_strtolower($candidato->direccion)) }}
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
                    {{ ($requerimiento->motivo_requerimiento_id) ? $requerimiento->getMotivoRequerimiento()->descripcion : '' }}
                </td>
            </tr>

            <tr>
                <td width="40%"> <strong> Labor u obra determinada para la que se le contrata: </strong> <br> <p style="text-align:justify; width:85%;"> 
                    @if(isset($reqcandidato->funciones))
                        {{ $reqcandidato->funciones }}
                    @else
                        {{-- Para previsualización del contrato --}}
                        @if(isset($requerimiento_informacion->funciones))
                            {{ $requerimiento_informacion->funciones }}
                        @endif
                    @endif
                </p></td>
                <td width="40%"> <strong> Lugar donde desempeña las labores: </strong> <br> {{ $requerimiento->getUbicacion() }}</td>
            </tr>

            <tr>
                <td width="40%"> <strong> Ciudad donde ha sido contratado: </strong> <br>
                    {{ $requerimiento->agencia_req() }}
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
                <td colspan="2"> <strong> Salario mensual: </strong> <br> 
                    @if(isset($reqcandidato->salario))
                        $ {{ number_format($reqcandidato->salario) }} @if($requerimiento->tipo_nomina == 2)&nbsp;&nbsp;Salario integral @endif
                    @else
                        {{-- Para previsualización del contrato --}}
                        @if(isset($requerimiento_informacion->salario))
                            $ {{ number_format($requerimiento_informacion->salario) }} @if($requerimiento->tipo_nomina == 2)&nbsp;&nbsp;Salario integral @endif
                        @endif
                    @endif
                </td>
            </tr>

            <tr>
                <td width="40%"> <strong> Pagadero por: </strong> <br>  {{ $requerimiento->getTipoLiquidacion()->descripcion }} </td>
                <td width="40%"> <strong> Fecha de inicio de labores: </strong> <br> {{ ($fechasContrato != null) ? $fechasContrato->fecha_ingreso : '' }}</td>
            </tr>

            <tr>
                <td width="40%"> <strong> EPS: </strong> <br> {{ ($fechasContrato->entidad_eps != '' ? $fechasContrato->entidad_eps : $candidato->entidades_eps_des) }}</td>
                <td width="40%"> <strong> AFP: </strong> <br> {{ ($fechasContrato->entidad_afp != '' ? $fechasContrato->entidad_afp : $candidato->entidades_afp_des) }}</td>
            </tr>
        </table>
    </div>
      
    <div class="center table justify mt-2" width="95%">          
        <p> Entre la E.S.T. empleadora y el trabajador en misión, de las condiciones civiles anotadas, identificados como se anotara al pie de nuestras firmas, se ha celebrado el presente contrato de trabajo regido además de las disposiciones legales, por las siguientes cláusulas:</p>

        <strong> PRIMERA: </strong>
        <strong>  El trabajador se obliga: </strong>
        <ul>
            <li>
                1. A poner al servicio de la E.S.T. empleadora o de la usuaria a la cual se remite, toda su capacidad normal de trabajo y actuar de buena fe, en el desempeño de las funciones propias del cargo u oficio contratado atendiendo el motivo que le dio origen a la obra o labor determinada de conformidad con las ordenes o instrucciones que le impartan la E.S.T. empleadora o las personas o la usuaria autorizadas por esta. Ejecutando las tareas diarias, anexas y complementarias del mismo de conformidad con las leyes, las cuales declara conocer y acatar, las cuales hacen parte del presente contrato para los efectos legales.
            </li>

            <li>
                2. A cumplir el contrato de manera cuidadosa y diligente en el lugar, tiempo y condiciones que la E.S.T. empleadora le señale, pero se compromete a prestar sus servicios en cualquier otra ciudad o lugar que la E.S.T empleadora o la usuaria en su facultad de subordinación delegada requiera, siempre que el cambio no implique desmejora en sus condiciones laborales o remuneración.
            </li>

            <li>
                3. A observar rigurosamente la disciplina establecida por la E.S.T. empleadora o por la empresa usuaria donde se remite al trabajador en misión, expresada en el Regalmento Interno de Trabajo y la normatividad establecida.
            </li>

            <li>
                4. A aceptar los cambios en el desempeño del cargo u oficio convenido en el lugar de trabajo, siempre que no implique desmejora en sus condiciones de trabajo, y no modifique la obra o labor contratada. En caso que dicho cambio deba realizarse por recomendación de preservar su integridad, desde ahora declara conocer y acatar.
            </li>
            
            <li>
                5. A guardar estricta reserva de todo lo que llegue a su conocimiento, por razón de su oficio y cuya comunicación pueda causar perjuicio al empleador o a las personas o entidades en cuyos establecimientos trabaja. Así como reconoce que cualquier elaboración de cualquier obra realizada al serivicio de la E.S.T empleadora o la usuaria será propiedad de ellas.
            </li>

            <li>     
                6. A no atender durante las horas de trabajo, asuntos u ocupaciones distintas de las que le encomiende la E.S.T. empleadora o las personas o las usuarias autorizadas por esta.
            </li>

            <li>
                7. A cuidar y manejar con esmero y atención las herramientas, utensilios, materias primas, productos en proceso o terminados, instalaciones y demás bienes del establecimiento donde preste sus servicios y evitar todo daño o perdida que cause perjuicios a sus propietarios.
            </li>

            <li>
                8. Acatar las normas sobre seguridad y salud en el trabajo, las cuales reconoce han sido previamente informadas y capacitado en las mismas.
            </li>

            <li>
                9. Acatar los reglamentos de la usuaria a la cual se remite y a la E.S.T. empleadora.
            </li>

            <li>
                10. El trabajador se obliga con la E.S.T enviar copia de la incapacidad en un plazo de 48 horas después ser emitidas por el médico. Sin embargo, reconoce y acepta que deberá informar a primera hora de su jornada laboral, los inconvenientes por los cuales no puede cumplir con su jornada laboral.
            </li>

            <li>
                11. El trabajador reconoce desde ahora, que en caso de no presentar las incapacidades dentro del periodo que sean generadas, se presentará afectación en su IBC, lo cual afecta el pago de la cuota moderadora de la EPS.
            </li>

            <li>
                12. A informar por escrito a la E.S.T. el cambio de domicilio, número telefónico y/o correo electrónico, en la brevedad posible. Por lo cual, reconoce desde ahora que en caso de no notificar a la E.S.T cambio alguno de sus datos, serán a ellos donde sea notificado por parte del empleador.
            </li>

            <li>
                13. Ingresar a la cuenta electrónica que el empleador ha creado para el trabajador en la página web, donde podrá acceder al reglamento interno, desprendibles de pago, pagos de seguridad social y a las políticas de la compañía.
            </li>
        </ul>

        <br>
        <strong> SEGUNDA: </strong>
        <br>

        EL TRABAJADOR y EL EMPLEADOR, acuerdan expresamente que no constituyen salario, ni en dinero, ni en especie, los pagos o reconocimientos que se le hagan al primero por concepto de beneficios o auxilios habituales u ocasionales acordados convencional o contractualmente u otorgados en forma extralegal por EL EMPLEADOR, tales como bonificaciones o gratificaciones, y lo que reciba EL EMPLEADO en dinero o en especie no para su beneficio, ni para enriquecer su patrimonio, sino para desempeñar a cabalidad sus funciones como gastos de representación, alimentación, habitación o vestuario, primas o bonificaciones extralegales de vacaciones, de servicio o de navidad, de antigüedad, aguinaldos, auxilios o becas para estudio, auxilios por muerte de familiares o por calamidad doméstica, auxilios o reconocimientos por drogas o consultas médicas u odontológicas, medios de transporte, elementos de trabajo u otros semejantes y los beneficios y prestaciones extralegales que por causa del contrato reconozca EL EMPLEADOR. <br><br>

        <strong> TERCERA: </strong>
        <br>

        Todo trabajo complementario o de horas extras y en día domingo o festivo en los que legalmente debe conceder descanso, mientras no sea labor que según la ley deba ejecutarse así, será autorizado por una de las personas que dirijan el establecimiento donde el trabajador presta sus servicios, mediante inclusión en el respectivo reporte de tiempo. El patrono, en consecuencia no reconocerá ningún trabajo suplementario o en días de descanso legalmente obligatorio que no se encuentre incluido en el reporte semanal de tiempo trabajado o autorizado por las personas o usuarias facultadas para ello en el respectivo establecimiento.
        <br><br>

        <strong> CUARTA: </strong><br>

        El trabajador en misión se obliga a laborar la jornada legal en los turnos y dentro de las horas señaladas por el patrono, o las personas, o la usuaria autorizadas pudiendo hacer estas los ajustes o cambios de horario cuando así lo estime conveniente. Podrán igualmente repartirse las horas de la jornada ordinaria en la forma prevista en el artículo 164 del CST, teniendo en cuenta que los tiempos de descanso entre secciones de la jornada que se computan dentro de la misma, según el artículo 167 del C.S.T.
        <br><br>

        <strong> QUINTA: </strong>
        <br>

        El presente contrato durara por el tiempo que dure la realización de la obra o labor solicitada al patrono por la empresa usuaria o beneficiaria de los servicios personales del trabajador y en consecuencia, terminara en el momento en que la empresa cliente comunique a la E.S.T. empleadora que ha dejado de requerir los servicios del trabajador en misión, por haber terminado la labor contratada, sin que el patrono tenga que reconocer indemnización alguna. Lo anterior de conformidad con el artículo 61 del C.S.T., modificado por el artículo 6, numeral, literal d) del d.l. 2351 de 1.965.
        <br><br>

        <strong>SEXTA: PERIODO DE PRUEBA: </strong><br>
            
        Las partes acogiéndose a lo previsto en el artículo 7 de la ley 50/90 acuerdan que los dos(2) primeros meses de duración son en periodo de prueba, lapso durante el cual cualquiera de ellas podrá terminarlo unilateralmente en cualquier momento, sin indemnización alguna.
        <br><br>

        <strong> SÉPTIMA: </strong><br>

        Son justas causas para dar por terminado el presente contrato, unilateralmente además de las enumeradas en los artículos 7 del d.l. 2351 de 1965 y 450, numeral 2 del C.S.T., las consagradas como tales en reglamentos de la E.S.T. empleadora debidamente notificados al trabajador en misión al momento de su contratación y que el TRABAJADOR desde ahora acepta conocer.
        <br><br>

        <strong>OCTAVA: </strong><br>

        El empleador y el trabajador acuerdan de manera libre y voluntaria, que no constituyen salario ninguno de los elementos enunciados en el art. 128 del C.S.T., subrogado por el artículo 15 de la ley 50 de 1990 y además establecen de común acuerdo que las sumas que ocasionalmente y por mera liberalidad reciba el trabajador del empleador, como bonificaciones, bonos, prima de navidad, auxilio de maternidad, auxilio de defunción, auxilio de alimentación, auxilio de escolaridad, primas extralegales, auxilio de teléfono, compensación flexible y auxilio extralegal de transporte. Además de lo anterior tampoco constituye salario, todo lo que recibe en dinero o en especie para desempeñar a cabalidad sus funciones como gastos de representación, medios de transporte, elementos de trabajo y otros semejantes que en el futuro la compañía otorgue, no constituyen salario ni factor de salario para liquidar prestaciones sociales.
        <br><br>

        <strong> NOVENA: LIQUIDACIÓN FINAL DE PRESTACIONES SOCIALES:</strong> <br>
        
        El TRABAJADOR autoriza al EMPLEADOR para que consigne directamente o utilice cualquier medio electrónico de transferencia de dinero a la cuenta personal de ahorros o corriente, suministrado previamente por el TRABAJADOR, el valor correspondiente a su liquidación final de prestaciones sociales y/o pagos salariales.
        <br><br>
        
        <strong> DECIMA: REPORTE DE LICENCIAS E INCAPACIDADES </strong> <br>

        Le damos la bienvenida a nuestra organización y queremos informarle que a partir de este momento, si usted llega a tener alguna incapacidad o licencia, es necesario que usted haga el reporte a más tardar 2 días calendario después de haber sido incapacitado y presentar la siguiente documentación:
        <br>

        •	Transcripción de su incapacidad o licencia.<br>
        •	Original de la incapacidad o licencia y copia de la atención médica.
        <br><br>

        Recuerda, la no entrega de documentos del grupo familiar es responsabilidad del empleado.
        <br><br>

        En señal de aceptación y de conformidad, las partes suscriben este contrato el <?php setlocale(LC_TIME, 'es_ES.UTF-8'); echo strftime(" %d de %B de %Y") ?>.
        <br><br>

        {{-- Contrato firmado --}}
        @if($firmaContrato != null || (isset($mostrar_firma) && $mostrar_firma === 'SI'))
            <table class="table" width="80%" style="border:none !important;">
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
                            {{ mb_strtoupper($candidato->nombres) }} {{ mb_strtoupper($candidato->primer_apellido)}} {{ mb_strtoupper($candidato->segundo_apellido)}}
                            <br>
                            {{ ucwords(mb_strtolower($candidato->dec_tipo_doc))}} : {{ $candidato->numero_id }}
                        </div>
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
                    "lugarexpedicion" => $lugarexpedicion_medica
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

                    @if(isset($empresa_contrata))
                        @if ($empresa_contrata != null || $empresa_contrata != '')
                            @include('admin.clausulas.template.layout', ["nuevo_cuerpo" => $nuevo_cuerpo, "empresa_contrata" => $empresa_contrata->logo, "firma" => $firma, 'opcion_firma' => $clausula->opcion_firma])
                        @endif
                    @else
                        @include('admin.clausulas.template.layout', ["nuevo_cuerpo" => $nuevo_cuerpo, 'opcion_firma' => $clausula->opcion_firma])
                    @endif

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

    @if(isset($contrato_fotos))
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
    @endif
</body>
</html>