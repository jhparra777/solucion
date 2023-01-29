<?php
  $sitio = FuncionesGlobales::sitio();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta content="T3RS" name="author">
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="{{csrf_token()}}" name="token">
        
        <title> Evaluacion sst   </title>
        
        @if($sitio->favicon)
            @if($sitio->favicon != "")
              <link href="{{ url('configuracion_sitio')}}/{{$sitio->favicon }}" rel="shortcut icon">
            @else
              <link href="{{ url('img/favicon.png') }}" rel="shortcut icon">
            @endif
        @else
            <link href="{{ url('img/favicon.png') }}" rel="shortcut icon">
        @endif
       
        <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js')}}"></script>
        <script src="{{ url('js/jquery-ui.js') }}" type="text/javascript"></script>
        
        <link href="{{asset('public/css/style.css')}}" rel="stylesheet"/>
        <link href="{{ url('css/jquery-ui.css') }}" rel="stylesheet"/>
        <script src="{{ asset('js/bootstrap-switch.min.js')}}" type="text/javascript"></script>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet"/>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        {{--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>--}}
          <link rel="stylesheet" type="text/css" href="{{ asset('js/drawingboard/drawingboard.min.css') }}">

          <script src="https://code.jquery.com/jquery-3.4.1.js" type="text/javascript"></script>

          {{-- drawingboard JS --}}
          <script src="{{ asset('js/drawingboard/drawingboard.min.js') }}" type="text/javascript"></script>
        
        <script>
            $(function () {
              
             @if(empty($candidatos))
               window.location.href= '{{route("datos_basicos")}}';
             @endif
                //SE UTILIZA ESTA VARIABLE PARA MENSAJES DE SOLO TEXTO
                @if (Session::has("mesaje_success"))
                    mensaje_success(" {{ Session::get('mesaje_success') }} ");
                @endif
                
                //SE UTILIZA ESTA VARIABLE PARA MENSAJES QUE RETORNAN UNA VIEW
                @if(Session::has("view_mesaje_success"))
                    $("#modal").modal("show");
                @endif
            });
        </script>

        <script>
            $(function () {
                $.ajaxSetup({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                    }
                });
            });
        </script>

        <link href="{{ url('public/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ url('public/css/animate.css') }}" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="{{ route('generar_css_cv') }}"/>
        <link href="{{ url('public/css/responsive_style.css') }}" rel="stylesheet" type="text/css"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700,800%7CMontserrat:400,700" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900" rel="stylesheet"/>

        <style>

            .form-check-input{
              float: left;
            }

          .tabla1 {
            border: 1px solid black;
            padding: 0;
            margin: 0;
          }

          .text-left {
           padding-left: 17px;
          }

          .form-check{
            text-align: left;
          }

                label{
                  font-size: 15px;
                  font-weight: 500;
                }
        </style>
    </head>
    <body>
     <style>
        body { font: 12px arial; }
        label { display: block; }
        textarea {
          box-sizing: border-box; font: 12px arial;
          height: 200px; margin: 5px 0 15px 0;
          padding: 5px 2px; width: 100%;  
        }
        
        .borderojo { outline: none; border: solid #f00 !important; }
        .bordegris { border: 1px solid #d4d4d; }

        .swal2-popup {
          font-size: 1.6rem !important;
        }

        .text-center {
          text-align: center;
        }

    </style>

    <div class="col-md-10 col-md-offset-1 col-right-item-container" style="text-align:justify !important;">
      <div class="container-fluid">
        @if(Session::has("mensaje_success"))
            <div class="col-md-12" id="mensaje-resultado">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{Session::get("mensaje_success")}}
                </div>
            </div>
        @endif 

       <table width="100%">
        <tr>
          <th class="text-center">
              <img alt="encabezado_sst" class="izquierda" height="auto" src="{{ asset('encabezado_sst.png')}}" width="100%">
          </th>
        </tr>
      </table>   
      <br><br>
      {!!Form::open(["id"=>"fr_evaluacion"])!!}
      
      {!! Form::hidden("candidato_req",$candidatos->req_can_id,["id"=>"candidato_req_fr"]) !!}
    
       <p style="font-size: 16px;"> Lea con detenimiento el folleto de inducción en Seguridad y Salud en el Trabajo que le adjuntamos en el correo anterior y responda las siguientes preguntas marcando la respuesta correcta. Tenga en cuenta que debe responder correctamente un mínimo de seis ( 6 ) preguntas para aprobar la evaluación. </p>
    
       <h3>1) ¿Qué se busca con la implementación de la Política de Gestión Integral? </h3>
       <div class="col-md-12 col-sm-12 col-xs-12 form-group">
        <div class="form-check">
         <input class="form-check-input" name="resp1" type="radio" value="a" id="opuno">
          <label class="form-check-label" for="opuno"> a. Obtener préstamos de entidades financieras para el crecimiento de la empresa. </label>
        </div>
      </div>


      <div class="col-md-12 col-sm-12 col-xs-12 form-group">
        <div class="form-check">
         <input class="form-check-input" type="radio" name="resp1" id="opdos" value="b">
           <label class="form-check-label" for="opdos"> b. Imponer sanciones al personal que incumpla las normas de la empresa. </label>
        </div>
      </div>

      <div class="col-md-12 col-sm-12 col-xs-12 form-group">
        <div class="form-check">
         <input class="form-check-input" type="radio" name="resp1" id="optres" value="c">
           <label class="form-check-label" for="optres"> c. Asegurar el bienestar laboral, la eficacia de las operaciones y
            la satisfacción de las empresas usuarias. </label>
        </div>
      </div>

      <div class="col-md-12 col-sm-12 col-xs-12 form-group">
        <div class="form-check">
         <input class="form-check-input" type="radio" name="resp1" id="opcuatro" value="d">
           <label class="form-check-label" for="opcuatro"> d. Reducir costos y aumentar la rentabilidad de la empresa. </label>
        </div>

        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("fuentes_publicidad_id",$errors) !!}</p>
      </div>

    <br>
       <h3> 2)¿Qué es un accidente de trabajo? </h3>
      
       <div class="col-md-12 col-sm-12 col-xs-12 form-group">
        <div class="form-check">
         <input class="form-check-input" name="resp2" type="radio" value="a" id="2opuno">
          <label class="form-check-label" for="2opuno"> a. Todo suceso repentino que sobrevenga por causa o con ocasión del trabajo, y que produzca en el trabajador una lesión orgánica, una perturbación funcional o psiquiátrica, una invalidez o la muerte. </label>
        </div>
       </div>

       <div class="col-md-12 col-sm-12 col-xs-12 form-group">
        <div class="form-check">
         <input class="form-check-input" type="radio" name="resp2" id="2opdos" value="b">
           <label class="form-check-label" for="2opdos"> b. Aquel que se produce cuando el trabajador se traslada del trabajo a su vivienda en transporte público. </label>
        </div>
       </div>

       <div class="col-md-12 col-sm-12 col-xs-12 form-group">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="resp2" id="2optres" value="c">
          <label class="form-check-label" for="2optres"> c. Aquel que se produce en cumplimiento de las tareas asignadas por mis amigos del trabajo. </label>
        </div>
       </div>

      <div class="col-md-12 col-sm-12 col-xs-12 form-group">
        <div class="form-check">
         <input class="form-check-input" type="radio" name="resp2" id="2opcuatro" value="d">
           <label class="form-check-label" for="2opcuatro"> d. Todas las anteriores. </label>
        </div>
       <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspecto_familiar",$errors) !!}</p>
      </div>
       
        <h3> 3)¿Qué es una enfermedad laboral? </h3>
        
        <div class="col-md-12 col-sm-12 col-xs-12 form-group">           
         <div class="form-check">
         <input class="form-check-input" name="resp3" type="radio" value="a" id="3opuno">
          <label class="form-check-label" for="3opuno"> a. Es un incidente que se presenta dentro y fuera del lugar de trabajo.</label>
         </div>
        </div>

       <div class="col-md-12 col-sm-12 col-xs-12 form-group">
        <div class="form-check">
         <input class="form-check-input" type="radio" name="resp3" id="3opdos" value="b">
           <label class="form-check-label" for="3opdos"> b. La contraída como resultado de la exposición a factores de riesgo inherentes a la actividad laboral o del medio en el que el trabajador se ha visto obligado a trabajar </label>
        </div>
       </div>
      
       <div class="col-md-12 col-sm-12 col-xs-12 form-group">
        <div class="form-check">
         <input class="form-check-input" type="radio" name="resp3" id="3optres" value="c">
           <label class="form-check-label" for="3optres"> c. Es una lesión que se presenta dentro del lugar de trabajo. </label>
        </div>
       </div>

        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
         <div class="form-check">
           <input class="form-check-input" type="radio" name="resp3" id="3opcuatro" value="d">
           <label class="form-check-label" for="3opcuatro"> d. Ninguna de las anteriores.. </label>
         </div>
         <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspecto_academico",$errors) !!}</p>
        </div>
      
    @if(route('home') != "https://temporizar.t3rs.co") 
  
         <h3> 4)¿Cuál es el procedimiento a seguir en caso de accidente de trabajo? </h3>
         <div class="col-md-12 col-sm-12 col-xs-12 form-group">
          <div class="form-check">
           <input class="form-check-input" name="resp4" type="radio" value="a" id="4opuno">
            <label class="form-check-label" for="4opuno"> a. Conservar la calma.</label>
          </div>
         </div>
        
        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
          <div class="form-check">
          <input class="form-check-input" type="radio" name="resp4" id="4opdos" value="b">
           <label class="form-check-label" for="4opdos"> b. Informar de manera inmediata al supervisor, jefe inmediato o encargado de seguridad y salud en el trabajo de la empresa usuaria </label>
          </div>
        </div>


        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
         <div class="form-check">
          <input class="form-check-input" type="radio" name="resp4" id="4optres" value="c">
            <label class="form-check-label" for="4optres"> c. Recibir los primeros auxilios, según se requiera.</label>
          </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
          <div class="form-check">
          <input class="form-check-input" type="radio" name="resp4" id="4opcuatro" value="d">
            <label class="form-check-label" for="4opcuatro"> d.La empresa usuaria, de acuerdo al evento, llamará a la línea de atención ARL SURA, con el fin de direccionar al accidentado al centro de atención médica en convenio con ARL SURA; usted deberá dirigirse al centro de atención designado por la línea de atención ARL SURA, en caso de requerirse. </label>
          </div>
            <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspectos_experiencia",$errors) !!}</p>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
          <div class="form-check">
          <input class="form-check-input" type="radio" name="resp4" id="4opcuatro" value="e">
            <label class="form-check-label" for="4opcuatro"> e. Todas las anteriores. </label>
          </div>
            <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspectos_experiencia",$errors) !!}</p>
        </div>
      <br>

         <h3> 5)¿Qué significa la sigla EPP? </h3>

         <div class="col-md-12 col-sm-12 col-xs-12 form-group">      
          <div class="form-check">
           <input class="form-check-input" name="resp5" type="radio" value="a" id="5opuno">
            <label class="form-check-label" for="5opuno"> a. Elementos de Protección Personal </label>
          </div>
         </div>

         <div class="col-md-12 col-sm-12 col-xs-12 form-group">
          <div class="form-check">
          <input class="form-check-input" type="radio" name="resp5" id="5opdos" value="b">
            <label class="form-check-label" for="5opdos"> b. Equipos de Producción de Plásticos. </label>
          </div>
         </div>

         <div class="col-md-12 col-sm-12 col-xs-12 form-group">
          <div class="form-check">
          <input class="form-check-input" type="radio" name="resp5" id="5optres" value="c">
            <label class="form-check-label" for="5optres"> c. Elementos de Protección Colectiva. </label>
          </div>
            
            <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspectos_personalidad",$errors) !!}</p>
        </div>

          <h3> 6)¿Cuál de los siguientes principios NO hace parte de la Política de Seguridad Vial? </h3>
          
          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
           <div class="form-check">
           <input class="form-check-input" name="resp6" type="radio" value="a" id="6opuno">
            <label class="form-check-label" for="6opuno"> a. Conducir más de 8 horas seguidas </label>
           </div>
          </div>

          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
           <div class="form-check">
            <input class="form-check-input" type="radio" name="resp6" id="6opdos" value="b">
            <label class="form-check-label" for="6opdos"> b. Se debe cumplir siempre con los límites de velocidad. </label>
           </div>
          </div>

          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
           <div class="form-check">
            <input class="form-check-input" type="radio" name="resp6" id="6optres" value="c">
            <label class="form-check-label" for="6optres"> c. Se debe verificar el buen funcionamiento del vehículo (carro o moto) antes de cada uso, y reportar novedades o fallas que presente el mismo. </label>
           </div>
          </div>

          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
           <div class="form-check">
            <input class="form-check-input" type="radio" name="resp6" id="6optres" value="d">
            <label class="form-check-label" for="6optres"> d. Está prohibido usar teléfono celular mientras se conduce </label>
           </div>

            <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("fortalezas_cargo",$errors) !!}</p>
        </div>
        
        <br>
          <h3> 7)¿Cuáles son las prohibiciones contenidas en la Política de prevención del consumo de alcohol, sustancias psicoactivas y tabaco? </h3>
          <div class="col-md-12 col-sm-12 col-xs-12 form-group">         
           <div class="form-check">
            <input class="form-check-input" name="resp7" type="radio" value="a" id="7opuno">
            <label class="form-check-label" for="7opuno"> a. Tener un amigo dedicado a la venta de cigarrillos. </label>
           </div>
          </div>

          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
           <div class="form-check">
            <input class="form-check-input" type="radio" name="resp7" id="7opdos" value="b">
            <label class="form-check-label" for="7opdos"> b. Está prohibido presentarse al sitio de trabajo bajo la influencia de bebidas alcohólicas, sustancias psicoactivas, o que generen dependencia o alteren el normal estado de conciencia, el estado de ánimo, la percepción, la capacidad de reacción o que pueda influenciar negativamente en su conducta. </label>
           </div>
          </div>

          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
           <div class="form-check">
            <input class="form-check-input" type="radio" name="resp7" id="7optres" value="c">
            <label class="form-check-label" for="7optres"> c. Está prohibida la indebida utilización de medicamentos formulados o el uso, posesión, distribución, transporte o comercialización, tanto de bebidas alcohólicas, como de sustancias psicoactivas, o que generen dependencia o alteren el normal estado de conciencia, el estado de ánimo, la percepción y la capacidad de reacción, en funciones del trabajo, en actividades de carácter deportivo, recreativo o cultural, así como dentro de las instalaciones de la compañía, instalaciones de sus empresas usuarias o vehículos que estén al servicio de Soluciones Inmediatas S.A. o de sus empresas usuarias. </label>
           </div>
          </div>

          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
           <div class="form-check">
            <input class="form-check-input" type="radio" name="resp7" id="7optres" value="d">
            <label class="form-check-label" for="7optres"> d. b y c son verdaderas </label>
           </div>
          </div>

           <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("oportunidad_cargo",$errors) !!}</p>
      
    @endif
     <br>
    
      <h3> 8)¿Cuál de las siguientes NO es una responsabilidad de los trabajadores frente al Sistema de Gestión de la Seguridad y Salud en el Trabajo? </h3>
       
       <div class="col-md-12 col-sm-12 col-xs-12 form-group">
          <div class="form-check">
           <input class="form-check-input" name="resp8" type="radio" value="a" id="8opuno">
            <label class="form-check-label" for="8opuno"> a. Suministrar información clara, veraz y completa de su estado de salud. </label>
          </div>
       </div>

       <div class="col-md-12 col-sm-12 col-xs-12 form-group">
         <div class="form-check">
           <input class="form-check-input" type="radio" name="resp8" id="8opdos" value="b">
            <label class="form-check-label" for="8opdos"> b. Comprar o arrendar vivienda cerca a la sede de la empresa usuaria. </label>
          </div>
       </div>

        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
          <div class="form-check">
           <input class="form-check-input" type="radio" name="resp8" id="8optres" value="c">
            <label class="form-check-label" for="8optres"> c. Participar en las actividades y capacitaciones del Sistema de Gestión de la Seguridad y Salud en el Trabajo. </label>
          </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
          <div class="form-check">
           <input class="form-check-input" type="radio" name="resp8" id="8optres" value="d">
            <label class="form-check-label" for="8optres"> d. Reportar inmediatamente cualquier incidente o accidente de trabajo que me ocurra. </label>
          </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
          <div class="form-check">
           <input class="form-check-input" type="radio" name="resp8" id="8optres" value="e">
            <label class="form-check-label" for="8optres"> e. Utilizar y mantener adecuadamente las instalaciones de la Empresa, los elementos de protección personal y los equipos de trabajo.</label>
          </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
          <div class="form-check">
           <input class="form-check-input" type="radio" name="resp8" id="8optres" value="f">
            <label class="form-check-label" for="8optres"> f.Procurar el cuidado integral de su salud</label>
          </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
          <div class="form-check">
           <input class="form-check-input" type="radio" name="resp8" id="8optres" value="g">
            <label class="form-check-label" for="8optres"> g. Cumplir con las normas, reglamentos e instrucciones del Sistema de Gestión de la Seguridad y Salud en el Trabajo establecidas por la Ley, por la empresa y/o por el cliente.</label>
          </div>
         <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("resultado",$errors) !!}</p>
        </div>
      </div>
          <hr>
          <br>


                   <div class="col-md-12 col-sm-12 tabla1">
                      <div class="form-check"><label>
                        Yo {{$candidatos->nombres.' '.$candidatos->primer_apellido.' '.$candidatos->segundo_apellido}},
                        identificado con Cédula de ciudadanía N° {{$candidatos->numero_id}},
                        dejo constancia de que recibí inducción en Seguridad y Salud en el Trabajo;
                        me permito informar que se me dieron a conocer Políticas del SGSST y
                        normas de seguridad. Entiendo que el objetivo de estas normas de
                        seguridad es el de evitar la ocurrencia de accidentes de trabajo y/o
                        enfermedades laborales.<br>
                        Me comprometo a cumplir las normas de seguridad estipuladas y las que
                        estén definidas en la empresa usuaria donde labore, con el único propósito
                        de evitar que me ocurran accidentes a mí o a mis compañeros de trabajo; a
                        informar los accidentes de trabajo inmediatamente ocurran al supervisor,
                        jefe inmediato o encargado de SST de la empresa usuaria; a notificar
                        cualquier condición insegura que se presente en mi lugar de trabajo y a no
                        cometer actos inseguros que pongan en riesgo mi salud y mi vida. </label> </div>
                        <br>
                   </div>

        <div id="mensaje-error" class="alert alert-danger danger" role="alert" style="display: none;">
          <strong id="error"></strong>
        </div>

      <p class="direction-botones-center set-margin-top">
        <button class="btn-quote" id="guardar_evaluacion" type="submit">
         <i class="fa fa-floppy-o"></i>&nbsp;Guardar </button>
      </p>
    </div>

     <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
       <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Firma</h4>
          </div>

           <div class="modal-body" style="height:400px;overflow:auto;">
            <div id="texto" style="padding:10px;text-align:justify;margin:10px;font-family:arial;">
                <div class="col-md-12 form-group">
                      <div class="form-check"><p>
                        Yo {{$candidatos->nombres.' '.$candidatos->primer_apellido.' '.$candidatos->segundo_apellido}},
                        identificado con Cédula de ciudadanía N° {{$candidatos->numero_id}},
                        dejo constancia de que recibí inducción en Seguridad y Salud en el Trabajo;
                        me permito informar que se me dieron a conocer Políticas del SGSST y
                        normas de seguridad. Entiendo que el objetivo de estas normas de
                        seguridad es el de evitar la ocurrencia de accidentes de trabajo y/o
                        enfermedades laborales.<br>
                        Me comprometo a cumplir las normas de seguridad estipuladas y las que
                        estén definidas en la empresa usuaria donde labore, con el único propósito
                        de evitar que me ocurran accidentes a mí o a mis compañeros de trabajo; a
                        informar los accidentes de trabajo inmediatamente ocurran al supervisor,
                        jefe inmediato o encargado de SST de la empresa usuaria; a notificar
                        cualquier condición insegura que se presente en mi lugar de trabajo y a no
                        cometer actos inseguros que pongan en riesgo mi salud y mi vida. </p> </div>
                </div>
                  <p>Firma en el recuadro en señal de aceptacion</p>
              {!! Form::hidden("id",null,["id"=>"fr_id"]) !!}

              <table class="col-md-12 col-xs-12 col-sm-12 center table" bgcolor="#f1f1f1">
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
            </div>
           </div>
                       
            <div class="modal-footer">
              <button type="button" class="btn btn-success guardarFirma" disabled>Firmar</button>
            </div>
        
        </div>
       </div>
      </div>

    {{-- Modal con aceptación de políticas --}}

        <script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/ga.js') }}" type="text/javascript"></script>
        
        <script src="{{ asset('public/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/js/jquery_custom.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/js/wow.min.js') }}" type="text/javascript"></script>

        <script type="text/javascript">
          
        $(function (){
            //Define the swal toast
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

              var canvas1 = document.getElementById('canvas');
              var canvas = canvas1.toDataURL();

               cand_id = $("#fr_id").val();
                
               estado = 1;

              var token = ('_token','{{ csrf_token() }}');
               
                        $.ajax({
                            type: 'POST',
                            data: {
                              id_evaluacion : cand_id,
                              _token : token,
                              firma : canvas
                            },
                            url: "{{ route('firma_evaluacion_sst') }}",
                            beforeSend: function(response) {
                              
                            },
                            success: function(response) {
                             //console.log(response);
                             //window.open(response.ruta, '_blank');
                             window.location.href  = response.ruta; //"{{route('datos_basicos')}}";
                            }
                        });
          });

        });

    
    $(document).ready(function(){
      
        $("#aceptar").on("click", function() {
          
           if($(this).is(":checked")){

          //  $("#guardar_evaluacion").removeProp('disabled');
          
           }else{
            //
            // $("#guardar_evaluacion").prop('disabled',true);
           }

        });

      $(document).on("click", "#guardar_evaluacion", function (e) {
                e.preventDefault();
        
            $(this).prop("disabled", true)
            var formData = new FormData(document.getElementById("fr_evaluacion"));
            $.ajax({
                url: "{{route('guardar_evaluacion_sst')}}",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
                
            }).done(function (res) {
                var res = $.parseJSON(res);
              //$("#guardar_nueva_prueba").removeAttr("disabled");
                var id_c = res.id;

                if(res.success) {

                    if(res.paso == 1){ //prueba definitiva 6gh
                     
                      swal("Felicitaciones",res.mensaje, "success", {
                        
                        buttons: {
                          cancelar: { text: "Firmar",className:'btn btn-success' },
                                  //  agregar: { text: "Siguiente Sección",className:'btn btn-warning' },
                        },
                      }).then((value) => {
                      
                        switch (value) {
                      
                            case "cancelar":
                              
                              $("#myModal").modal('show');
                              $("#fr_id").val(id_c);
                              //swal("Ok","Datos Guardados!!","warning");
                              //window.location.href= '{{route("datos_basicos")}}';
                             //CODIGO DE NO AGREGADO O LO QUE QUIERAS HACER
                            break;
                        }
                      });
                   }else{
                      
                      swal("Debes repetir la evaluación",res.mensaje, "danger", {
                        
                        buttons: {
                          cancelar: { text: "Reintentar Evaluación",className:'btn btn-success' },
                                  //  agregar: { text: "Siguiente Sección",className:'btn btn-warning' },
                        },
                      }).then((value) => {
                      
                        switch (value) {
                      
                          case "cancelar":
                           //swal("Ok","Datos Guardados!!","warning");
                            location.reload();
                            //CODIGO DE NO AGREGADO O LO QUE QUIERAS HACER
                          break;
                        }
                      });
                      
                    }
                   
                } else {
                    $("#modal_peq").find(".modal-content").html(res.view);
                }

           });
         return false;
      });

                $(window).scroll(function(){
                    if ($(this).scrollTop() > 100) {
                        $('.scrollup').fadeIn();
                    } else {
                        $('.scrollup').fadeOut();
                     }
                });
                
                $('.scrollup').click(function(){
                    $("html, body").animate({ scrollTop: 0 }, 600);
                    return false;
                });

            });
        </script>
    </body>
</html>