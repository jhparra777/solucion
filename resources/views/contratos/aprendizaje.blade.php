<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="{{csrf_token()}}" name="token">
    {{-- <title>
        @if(isset($sitio->nombre))
                @if($sitio->nombre != "")
                    {{ $sitio->nombre }} - Firma contrato
                @else
                    Desarrollo | Firma contrato
                @endif
        @else
                Desarrollo | Firma-contrato
        @endif
    </title>

     @if($sitio->favicon)
            @if($sitio->favicon != "")
                <link href="{{ url('configuracion_sitio')}}/{{$sitio->favicon }}" rel="shortcut icon">
            @else
                <link href="{{ url('img/favicon.png') }}" rel="shortcut icon">
            @endif
    @else
            <link href="{{ url('img/favicon.png') }}" rel="shortcut icon">
    @endif  --}}

    {{-- drawingboard CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('js/drawingboard/drawingboard.min.css') }}">

    <script src="https://code.jquery.com/jquery-3.4.1.js" type="text/javascript"></script>

    {{-- drawingboard JS --}}
    <script src="{{ asset('js/drawingboard/drawingboard.min.js') }}" type="text/javascript"></script>

    <style>
        html{
            font-family: 'Arial';
        }

        body{
            /*font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            font-size: 14px;
            line-height: 1.42857143;
            color: #333;
            background-color: #fff;*/
        }

        /*.btn{
            text-decoration: none;
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
                border-top-color: transparent;
                border-right-color: transparent;
                border-bottom-color: transparent;
                border-left-color: transparent;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        .btn-success{
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-secondary{
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-warning{
            color: #fff;
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-danger{
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-secondary:hover{
            color: #fff;
            background-color: #5a6268;
            border-color: #545b62;
        }

        .btn-success:hover{
            color: #fff;
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn:not(:disabled):not(.disabled){
            cursor: pointer;
        }

        .btn:focus, .btn:hover{
            text-decoration: none;
        }*/

        .text-center{ text-align: center;  }
        .text-left{ text-align: left;  }
        .text-right{ text-align: right;  }
        .text-light{ font-weight: lighter; }

        .mt-1{ margin-top: 1rem; }
        .mt-2{ margin-top: 2rem; }
        .mt-3{ margin-top: 3rem; }
        .mt-4{ margin-top: 4rem; }

        .pd-1{ padding: 1rem; }

        .center{ margin: auto; }

        /*.table{
            border-collapse:separate; 
            border-spacing: 0 1em;
        }*/

        .mb-2{
            margin-bottom: 2rem;
        }

        .justify{ text-align: justify; }

        .list{ list-style: none; }
        /*.space{ line-height: 22px; }*/
    </style>
</head>
<body>

    <table width="100%" class="mt-4">
        <tr>
            <th width="10%"></th>

            <th class="text-left">
                @if (isset($empresa_contrata))
                    @if ($empresa_contrata != null || $empresa_contrata != '')
                        <img src="{{ asset('configuracion_sitio/'.$empresa_contrata->logo) }}" width="100" >
                    @endif
                @endif
            </th>

            <th class="text-right text-light">
                Fecha: <strong>{{$fecha}}</strong>
            </th>

            <th width="10%"></th>
        </tr>
    </table>

    <table width="100%" class="mt-4">
        <tr>
            <th class="text-center">
                <p>Firma de contrato</p>
            </th>
        </tr>

        <tr>
            <td class="text-center mt-1">
                {{$candidato->nombres}} {{$candidato->primer_apellido}} {{$candidato->segundo_apellido}}
            </td>
        </tr>
    </table>

    <table class="mt-4 mb-2" width="100%">
        <tr>
            <th class="text-center">
                <p>CONTRATO DE APRENDIZAJE</p>
            </th>
        </tr>
    </table>

    <table class="center table-contract justify" width="95%">
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
              {{ ucwords(mb_strtolower($candidato->dec_tipo_doc))}}
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
                {{ $fechasContrato->fecha_ingreso }}    
            </td>
        </tr>

        <tr>
            <th class="text-left">
                FECHA TERMINACIÓN CONTRATO
            </th>

            <td colspan="4">
                {{ $fechasContrato->fecha_fin_contrato }}
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

        {{--<tr>
            <td>
                <br/><br/>
                <strong>PRIMERA.- Objeto</strong>. El presente contrato tiene como objeto garantizar al APRENDIZ la formación profesional integral en la especialidad de mencionada en el encabezado de este contrato Grupo , la cual se impartirá en su etapa lectiva por el (Centro de Formación Profesional SENA (o por la Institución Educativa donde el aprendiz adelanta sus estudios) mientras su etapa práctica se desarrollará en la EMPRESA; para el caso de los aprendices que pertenecen a Instituciones distintas al SENA se debe tener en cuenta su fase de patrocinio. 

            </td>
        </tr>

        <tr>
            <td>
                <br/><br/> 
                <strong>SEGUNDA</strong>. El contrato tiene un término de duración de 6 meses, comprendidos entre la fecha de iniciación del Contrato; y el fecha de terminación del mismo mencionadas en el encabezado de este contrato. (No podrá excederse el término máximo de dos años contenido en el Artículo 30 de la Ley 789/02) y previa revisión de la normatividad para cada una de las modalidades de patrocinio.
            </td>
        </tr>

        <tr>
            <td>
                <br/><br/>
                <strong>TERCERA.- Obligaciones</strong>. 
            </td>
        </tr>

        <tr>
            <td>
                <br/><br/>
                1) <strong>POR PARTE DE LA EMPRESA</strong>.- En virtud del presente contrato la EMPRESA deberá: 
            </td>
        </tr>

        <tr>
            <td>
                <br/><br/>
                a) Facilitar al APRENDIZ los medios para que tanto en las fases Lectiva y Práctica, reciba Formación Profesional Integral, metódica y completa en la ocupación u oficio materia del presente contrato. 
            </td>
        </tr>

        <tr>
            <td>
                <br/><br/>
                b) Diligenciar y reportar al respectivo Centro de Formación Profesional Integral del SENA (o por la Institución Educativa donde el aprendiz adelanta sus estudios) las evaluaciones y certificaciones del APRENDIZ en su fase práctica del aprendizaje.
            </td>
        </tr>

        <tr>
            <td>
                <br/><br/>
                c) Reconocer mensualmente al APRENDIZ, por concepto de apoyo económico para el aprendizaje, durante la etapa lectiva, en el SENA el equivalente al 50% de 1 s.m.l.v. y durante la etapa práctica de su formación el equivalente al 75% de 1 s.m.l.v. y/o al 100% cuando la tasa de desempleo promedio del año inmediatamente anterior sea de un solo digito, para la vigencia 2016 este apoyo será del 100%. (Artículo 30 de la Ley 789 de 2002 y Decreto 451 de 2008) PARAGRAFO.- Este apoyo de sostenimiento no constituye salario en forma alguna, ni podrá ser regulado a través de convenios o contratos colectivos o fallos arbítrales que recaigan sobre estos últimos. 
            </td>
        </tr>

        <tr>
            <td>
                <br/><br/>
                d) Afiliar al APRENDIZ, durante la etapa práctica de su formación, a la Aseguradora de Riesgos Laborales ARP SURA (ARL manejada por la empresa para su planta de personal), de conformidad con lo dispuesto por el artículo 30 de la Ley 789 de 2002. 
            </td>
        </tr>

        <tr>
            <td>
                <br/><br/>
                e) Afiliar al APRENDIZ y efectuar, durante las fases lectiva y práctica de la formación, el pago mensual del aporte al régimen de Seguridad Social correspondiente al APRENDIZ en la EPS mencionadA en el encabezado de este contrato, conforme al régimen de trabajadores independientes, tal y como lo establece el Artículo 30 de la Ley 789 de 2002. Los pagos a la seguridad social (A.R.L. y E.P.S.) están a cargo en su totalidad por el empleador f) Dar al aprendiz la dotación de seguridad industrial, cuando el desarrollo de la etapa práctica así lo requiera, para la protección contra accidentes y enfermedades profesionales.

            </td>
        </tr>

        <tr>
            <td>
                <br/><br/>
                2) <strong>POR PARTE DEL APRENDIZ</strong>.- Por su parte se compromete en virtud del presente contrato a:
            </td>
        </tr>

        <tr>
            <td>
                <br/><br/>
                a) Concurrir puntualmente a las clases durante los periodos de enseñanza para así recibir la Formación Profesional Integral a que se refiere el presente Contrato, someterse a los reglamentos y normas establecidas por el respectivo Centro de Formación del SENA ( o de la Institución Educativa donde el aprendiz adelante sus estudios), y poner toda diligencia y aplicación para lograr el mayor rendimiento en su Formación. 
            </td>
        </tr>

        <tr>
            <td>
                <br/><br/>
                b) Concurrir puntualmente al lugar asignado por la Empresa para desarrollar su formación en la fase práctica, durante el periodo establecido para el mismo, en las actividades que se le encomiende y que guarde relación con la Formación, cumpliendo con las indicaciones que le señale la EMPRESA. En todo caso la intensidad horaria que debe cumplir el APRENDIZ durante la etapa práctica en la EMPRESA, no podrá exceder de 8 horas diarias y 48 horas Semanales.(según el acuerdo 000023 de 2.005).
            </td>
        </tr>

        <tr>
            <td>
                <br/><br/>
                c) Proporcionar la información necesaria para que el Empleador lo afilie como trabajador aprendiz al sistema de seguridad social en salud en la E.P.S., que elija. 
            </td>
        </tr>

        <tr>
            <td>
                <br/><br/>
                <strong>CUARTA.- Supervisión</strong>. La EMPRESA podrá supervisar al APRENDIZ en el respectivo Centro de Formación del SENA (o en el Centro Educativo donde estuviere adelantando los estudios el aprendiz), la asistencia, como el rendimiento académico, a efectos de verificar y asegurar la real y efectiva utilización del tiempo en la etapa lectiva por parte de este. El SENA supervisará al APRENDIZ en la EMPRESA para que sus actividades en cada periodo práctico correspondan al programa de la especialidad para la cual se está formando. 
            </td>
        </tr>

        <tr>
            <td>
                <br/><br/>
                <strong>QUINTA.- Suspensión</strong>. El presente contrato se podrá suspender temporalmente en los siguientes casos: a) Licencia de maternidad. b) Incapacidades debidamente certificadas. c) Caso fortuito o fuerza mayor debidamente certificado o constatado d) Vacaciones por parte del empleador, siempre y cuando el aprendiz se encuentre desarrollando la etapa práctica. Parágrafo 1º. Esta suspensión debe constar por escrito. Parágrafo 2º Durante la suspensión el contrato se encuentra vigente, por lo tanto, la relación de aprendizaje está vigente para las partes (Empresa y Aprendiz).
            </td>
        </tr>

        <tr>
            <td>
                <br/><br/>
                <strong>SEXTA.- Terminación</strong>. El presente contrato podrá darse por terminado en los siguientes casos: a) Por mutuo acuerdo entre las partes. B) Por el vencimiento del termino de duración del presente Contrato. C) La cancelación de la matrícula por parte del SENA de acuerdo con el reglamento previsto para los alumnos. D) El bajo rendimiento o las faltas disciplinarias cometidas en los periodos de Formación Profesional Integral en el SENA o en la EMPRESA, cuando a pesar de los requerimientos de la Empresa o del SENA, no se corrijan en un plazo razonable. Cuando la decisión la tome la Empresa, esta deberá obtener previo concepto favorable del SENA. E) El incumplimiento de las obligaciones previstas para cada una de las partes. 
            </td>
        </tr>

        <tr>
            <td>
                <br/><br/>
                <strong>SEPTIMA.- Relación Laboral</strong>. El presente Contrato no implica relación laboral alguna entre las partes, y se regirá en todas sus partes por el artículo 30 y s.s. de la ley 789 de 2002. Declaración Juramentada. El APRENDIZ declara bajo la gravedad de juramento que no se encuentra ni ha estado vinculado con la EMPRESA o con otras EMPRESAS en una relación de aprendizaje. Así mismo, declara que no se encuentra ni ha estado vinculado mediante una relación laboral con la EMPRESA. 

            </td>
        </tr>

        <tr>
            <td>
                <br/><br/>
                <strong>OCTAVA</strong>.- El presente contrato de aprendizaje rige durante las fechas previstas como etapa productiva que se describen en la cláusula segunda de este contrato. 

            </td>
        </tr>--}}

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
    @if($firmaContrato != null || $firmaContrato != '')
        @if($firmaContrato->firma != null || $firmaContrato->firma != '')
            <table class="center table-contract" width="80%">
                <tr>
                    <td width="40%">
                        <div style="width: 100%; margin: 4em;">
                            <img src="{{ asset('contratos/default.jpg') }}" width="200" {{--style="width: 60%;"--}}>
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
                            <img src="{{ $firmaContrato->firma }}" width="200" {{--style="width: 60%;"--}}>
                            <p>________________________________</p>
                            El trabajador:<br>
                            {{ mb_strtoupper($candidato->nombres) }} {{ mb_strtoupper($candidato->primer_apellido)}} {{ mb_strtoupper($candidato->segundo_apellido)}}
                            <br>
                            {{ucwords(mb_strtolower($candidato->dec_tipo_doc))}}: {{ $candidato->numero_id }}
                        </div>
                    </td>
                </tr>
            </table>
        @endif
    @endif

    {{-- Tablero de firmar contrato --}}
    @if(count($firmaContrato) <= 0)
        <table class="center table-contract" width="80%" bgcolor="#f1f1f1">
            <tr>
                <td width="30%"></td>
                <td>
                    <div>
                        <div>
                            <div id="firmBoard" style="width: 400px; height: 160px; margin: 1rem;"></div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <table class="center table-contract" width="80%" bgcolor="#f1f1f1">
            <tr>
                <td class="text-center">
                    <button type="button" class="btn btn-success guardarFirma" disabled>Firmar</button>
                    <p>Por favor dibuja tu firma en el panel blanco, no podemos guardar el contrato sin tu firma.</p>
                </td>
            </tr>
        </table>
    @elseif($firmaContrato->firma == null || $firmaContrato->firma == '')
        <table class="center table-contract" width="80%" bgcolor="#f1f1f1">
            <tr>
                <td width="30%"></td>
                <td>
                    <div>
                        <div>
                            <div id="firmBoard" style="width: 400px; height: 160px; margin: 1rem;"></div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <table class="center table-contract" width="80%" bgcolor="#f1f1f1">
            <tr>
                <td class="text-center">
                    <button type="button" class="btn btn-success guardarFirma" disabled>Firmar</button>
                    <p>Por favor dibuja tu firma en el panel blanco, no podemos guardar el contrato sin tu firma.</p>
                </td>
            </tr>
        </table>
    @endif

    {{-- Siguiente paso despues de haber firmado 
    @if($firmaContrato != null || $firmaContrato != '')
        @if($firmaContrato->firma != null || $firmaContrato->firma != '')
            @if($firmaContrato->video == null)
                <table class="center table" width="80%" bgcolor="#f1f1f1">
                    <tr>
                        <td class="text-center">
                            <a
                                type="button"
                                class="btn btn-warning pull-right"
                                href="{{ route('home.confirmar-documentos-adicionales', [$userIdHash, $firmaContratoHash]) }}"
                                style="color: white;"
                            >
                                Siguiente paso 
                            </a>
                        </td>
                    </tr>
                </table>
            @endif
        @endif
    @endif --}}

    {{-- <div class="text-center mt-4 mb-2">
        <button type="button" class="btn btn-danger" id="btnCancelarContrato">Cancelar contratación</button>
    </div> --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        $(function (){
            //Define the swal toast
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });

            var firmBoard = new DrawingBoard.Board('firmBoard', {
                controls: [
                    { DrawingMode: { filler: false, eraser: false,  } },
                    { Navigation: { forward: false, back: false } }
                    //'Download'
                ],
                size: 2,
                webStorage: 'session',
                enlargeYourContainer: true
            });

            //listen draw event
            firmBoard.ev.bind('board:stopDrawing', getStopDraw);
            firmBoard.ev.bind('board:reset', getResetDraw);

            function getStopDraw() {
                $(".guardarFirma").attr("disabled", false);
            }

            function getResetDraw() {
                $(".guardarFirma").attr("disabled", true);
            }

            $(".guardarFirma").on("click", function() {
                $('.drawing-board-canvas').attr('id', 'canvas');

                var firmBefore = document.getElementById('canvas');
                var firmShow = firmBefore.toDataURL();

                Swal.fire({
                    imageUrl: firmShow,
                    imageWidth: 200,
                    imageHeight: 100,
                    title: '¿Tu firma es correcta?',
                    text: "Asegurate de que tu firma sea correcta y legible.",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, firmar',
                    cancelButtonText: 'Revisar'
                }).then((result) => {
                    if (result.value) {
                        $('.drawing-board-canvas').attr('id', 'canvas');

                        var canvas1 = document.getElementById('canvas');
                        var canvas = canvas1.toDataURL();
                
                        user_id = '{{$user_id}}';
                        req_id = '{{$req_id}}';
                        estado = 1;

                        var token = ('_token','{{ csrf_token() }}');
                        
                        $.ajax({
                            type: 'POST',
                            data: {
                                user_id : user_id,
                                estado : estado,
                                req_id : req_id,
                                _token : token,
                                firma : canvas
                            },
                            url: "{{ route('home.guardar-firma') }}",
                            beforeSend: function(response) {
                                Toast.fire({
                                    icon: 'info',
                                    title: 'Validando y guardando ...'
                                });
                            },
                            success: function(response) {
                                if(response.success == true){
                                    /*Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Contrato firmado.',
                                        showConfirmButton: false
                                    });*/

                                    takePicture(webcam)

                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: `¡Contrato firmado! <br>
                                                <p style="font-size: 2rem;">Por favor haz clic en el botón <i>"siguiente paso"</i> para continuar con la firma de los documentos adicionales.</p>`,
                                        showConfirmButton: false
                                    });

                                    setTimeout(function() {
                                        localStorage.setItem('reloadTab', false)
                                        localStorage.setItem('nextStep', true)
                                        location.reload();
                                    }, 5000);
                                }

                                if(response.success == false){
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'info',
                                        title: 'Ya se encuentra creada la firma.',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            }
                        });
                    }
                });
            });

            //Cancelar contrato
            const $btnCancelarContrato = document.querySelector('#btnCancelarContrato');
            var tokenvalue = $('meta[name="token"]').attr('content');

            let dashboardRedir = '{{ route('dashboard') }}';
            let routeCancel = '{{ route('cancelar_contratacion_candidato') }}';
            let contratoId  = '{{ $firmaContrato->id }}';
            let userId  = '{{ $userId }}';
            let reqId  = '{{ $ReqId }}';

            const ToastNoTime = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timerProgressBar: true
            });

            const cancelContract = () => {
                Swal.fire({
                    title: '¿Estas seguro/a?',
                    text: "Esta acción es irreversible.",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Si, cancelar',
                    cancelButtonText: 'No, continuar'
                }).then((result) => {
                    if (result.value) {
                        //$('#observeModal').modal('show');
                        Swal.fire({
                            title: 'Cancelación de contrato',
                            input: 'textarea',
                            inputPlaceholder: 'Describe la razón por la que quieres cancelar el contrato',
                            inputAttributes: {
                                'aria-label': 'Describe la razón por la que quieres cancelar el contrato'
                            },
                            inputValidator: (field) => {
                                if (!field) {
                                    return 'Debes completar el campo'
                                }
                            },
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Enviar y cancelar',
                            cancelButtonText: 'Cancelar'
                        }).then((cancelation) => {
                            $.ajax({
                                type: 'POST',
                                data: {
                                    _token : tokenvalue,
                                    user_id : userId,
                                    req_id : reqId,
                                    contrato_id : contratoId,
                                    observacion : cancelation.value
                                },
                                url: routeCancel,
                                beforeSend: function() {
                                    ToastNoTime.fire({
                                        icon: 'info',
                                        title: 'Validando y guardando ...'
                                    });
                                },
                                success: function(response) {
                                    if(response.success == true){
                                        Swal.fire({
                                            position: 'top-end',
                                            icon: 'success',
                                            title: 'Contrato cancelado.',
                                            showConfirmButton: false
                                        });

                                        setTimeout(() => {
                                            localStorage.setItem('reloadTab', false)
                                            window.location.href = dashboardRedir
                                        }, 1000)
                                    }
                                }
                            });
                        })
                    }
                });
            }

            $btnCancelarContrato.addEventListener('click', () => {
                cancelContract()
            });
        });
    </script>
</body>
</html>