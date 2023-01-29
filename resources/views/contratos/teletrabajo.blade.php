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
    @endif --}}

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
       /*.space{ line-height: 22px; }*/
    </style>
</head>
<body>
  <table width="100%" class="mt-1">
        <tr>
          <th width="10%"></th>
          <th class="text-left">
            @if(isset(FuncionesGlobales::sitio()->logo))

             @if(FuncionesGlobales::sitio()->logo != "")
              <img alt="Logo T3RS" class="izquierda" height="auto" src="{{ asset('configuracion_sitio/'.((FuncionesGlobales::sitio()->logo))) }}" width="150">
             @else
              <img alt="Logo T3RS" class="izquierda" height="auto" src="{{ asset('img/logo.png')}}" width="150">
             @endif
            
            @else
             <img alt="Logo T3RS" class="izquierda" height="auto" src="{{url('img/logo.png')}}" width="150">
            @endif
          </th>

            <th class="text-right text-light">
              Fecha: <strong>{{$fecha}}</strong>
            </th>

            <th width="10%"></th>
        </tr>
    </table>

    <table class="mt-4 mb-2" width="100%">
       <tr>
        <th class="text-center">
         <p>CONTRATO DE TRABAJO POR DURACIÓN DE OBRA O LABOR DETERMINADA</p>
         <p>EN MODALIDAD TELETRABAJO</p>
        </th>
       </tr>
    </table>

    <div style="">
     <table class="center table-contract justify" width="95%" class="tabla1">
      <tr>
       <td width="40%"> <strong> E.S.T Empleadora: </strong> <br> SOLUCIONES INMEDIATAS S.A. </td>
       <td width="40%"> <strong> Domicilio del Empleador: </strong> <br> {{($reqcandidato->agencia_direccion)?$reqcandidato->agencia_direccion:''}} </td>
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
       <td width="40%"> <strong> Lugar y fecha de nacimiento: </strong> <br> {{(($lugarnacimiento!=null)?ucwords(mb_strtolower($lugarnacimiento->value)):"")}} {{date('d/m/Y',strtotime($candidato->fecha_nacimiento))}} </td>
       <td width="40%"> <strong> Dirección de residencia trabajador </strong> : <br> @if($lugarresidencia != null)
             {{ucwords(mb_strtolower($lugarresidencia->value))}}
            @endif  {{ucwords(mb_strtolower($candidato->direccion))}} </td>
      </tr>

      <tr>
       <td width="40%"> <strong> Empresa usuaria donde se remite: </strong> <br> {{(!empty($reqcandidato->cliente_nombre)) ? $reqcandidato->cliente_nombre : '' }} </td>
       <td width="40%"> <strong> Objeto comercial que da origen a la presentación del servicio: </strong> <br> {{ $reqcandidato->codigo_sercon }} </td>
      </tr>

      <tr>
       <td width="40%"> <strong> Labor u obra determinada para la que se le contrata: </strong> <br> <p style="text-align:justify; width:85%;"> {{ $reqcandidato->descripcion_sercon }} </p> </td>
       <td width="40%"> <strong> Lugar donde desempeña las labores: </strong> <br> {{$requerimiento->getUbicacion()}}
       </td>

      </tr>

      <tr>
       <td width="40%"> <strong> Ciudad donde ha sido contratado: </strong> <br>
          {{$requerimiento->agencia_req()}}
       </td>

       <td width="40%"> <strong> Tipo trabajo: </strong> <br>
            {{ $reqcandidato->tipo_trabajo }}
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
        </strong> <br> $ {{ number_format($reqcandidato->salario) }} @if($requerimiento->tipo_nomina == 2)&nbsp;&nbsp;Salario integral @endif

        @if( $requerimiento->tipo_salario == 3 || $requerimiento->tipo_salario == 4 ) 
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <b>NOTA:</b> Se garantiza el pago de seguridad social sobre el SMLV
        @endif
       </td>

        <td width="40%"> <strong> Cargo para el cual a sido contratado: </strong> <br>
                            {{ $reqcandidato->nombre_cargo_especifico }}
        </td>
      </tr>

      <tr>
       <td width="40%"> <strong> Pagadero por: </strong> <br><!-- tipo liquidacion --> {{ $requerimiento->getTipoLiquidacion()->descripcion }} </td>
       <td width="40%"> <strong> Fecha de inicio de labores: </strong> <br> {{($fechasContrato != null)?$fechasContrato->fecha_ingreso:'' }} </td>
      </tr>

      <tr>
       <td width="40%"> <strong> EPS: </strong> <br> {{ ( isset($fechasContrato->entidad_eps) && $fechasContrato->entidad_eps != '' ? $fechasContrato->entidad_eps : $candidato->entidades_eps_des) }} </td>
       <td width="40%"> <strong> AFP: </strong> <br> {{ ( isset($fechasContrato->entidad_afp) && $fechasContrato->entidad_afp != '' ? $fechasContrato->entidad_afp : $candidato->entidades_afp_des) }} </td>
      </tr>

      <tr>
          <td width="40%">
            <strong> Día de la Semana </strong> 
            <br>
            {{$reqcandidato->dia_semana}}
          </td>

          <td width="40%">
                <strong>Horario</strong>
                <br>
                <strong>Mañana:</strong> {{$reqcandidato->horario_dia}}
                <br>
                <strong>Tarde:</strong> {{$reqcandidato->horario_tarde}}
          </td>
      </tr>

      <tr>
          <td width="40%">
            <strong>Tipo Teletrabajador</strong>
            <br>
            {{$reqcandidato->tipo_teletrabajador}}
          </td>
      
            <td width="40%">
                <strong>Descanso</strong>
                <br>
                {{$reqcandidato->descanso_teletrabajador}}
            </td>
      </tr>
      <tr>
          <td width="40%">
              <strong>Días de teletrabajo asignado</strong>
                <br>
                {{$reqcandidato->dias_teletrabajar}}
          </td>
      
          <td width="40%">
                <strong>Días de trabajo oficina</strong>
                <br>
                {{$reqcandidato->dias_trabajar_oficina}}
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
  
  </div>

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
                En señal de aceptación y de conformidad, las partes suscriben este contrato en {{ ($reqcandidato->nombre_ciudad != null) ? $reqcandidato->nombre_ciudad : ""}} el <?php setlocale(LC_TIME, 'es_ES.UTF-8'); echo strftime(" %d de %B de %Y") ?>.
            </td>
        </tr>
    </table>
         
    @if($firmaContrato != null && $firmaContrato->firma != '')
        <table class="tabla1 center table-contract" width="50%">
            <tr>
                <td width="40%">
                    <div style="width: 25%; padding: 6%; margin-left: 14%; padding-top: 15%;">
                        {{--style="width: 60%;"--}}
                        <img src="{{ asset('contratos/default.jpg') }}" width="180" style="margin-top: -51px;position: absolute;">

                        <p>________________________________</p>
                        Por el patrono: <!--- nombre y el cargo -->
                        <p> Andrea del Pilar Ramirez </p>
                        <p> Gerente de Gestión Humana </p>
                        <br>
                    </div>
                </td>            

                <td width="40%">
                    <div style="width: 75%; padding: 10%;margin-left: 9%;">
                        <img src="{{ $firmaContrato->firma }}" width="200" style="margin-top: -4px;position: absolute;"> {{--style="width: 60%;"--}}
                        <p style="margin-top: 12%;">________________________________</p>
                        Por trabajador:
                        <p> {{ mb_strtoupper($candidato->nombres) }} {{ mb_strtoupper($candidato->primer_apellido)}} {{ mb_strtoupper($candidato->segundo_apellido)}} </p>
                        <p> {{ucwords(mb_strtolower($candidato->dec_tipo_doc))}}: {{ $candidato->numero_id }} </p> 
                        <br>
                    </div>
                </td>
            </tr>
        </table>
    @endif

    {{-- Tablero de firmar contrato --}}
    @if($firmaContrato->firma == '')
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
    </div>  --}}

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
                    { DrawingMode: { filler: false } },
                    'Navigation'
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