<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        
        <title> Entrevista Semiestructurada</title>
        
        <style type="text/css">
            @page { margin: 50px 70px; }

           @if(route('home') != "https://pta.t3rsc.co")
            .page-break {
                page-break-after: always;
            }
           @endif

            table {
              border-collapse: collapse;
              width: 100%;
              padding: 0;
              margin: 0;
              border: none !important;
            }

            .table1 {
              border-collapse: collapse;
              width: 100%;
              padding: 0;
              margin: 0;
            }

            .table1, th, td {
              border: 1px solid #cacaca;
              padding: 5px;
            }

            h3{
              color: #377cfc;
            }

            #g-tr{
              margin-bottom: 90px;
              padding-bottom: 90px;
            }

            body {
              font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
              font-size: 16px;
              background-color: #FFFFFF;
            }

            hr.style2 {
              border: 0;
              height: 1px;
              background: #377cfc;
              background-image: -webkit-linear-gradient(left, #9bc1d1, #377cfc, #9bc1d1);
              background-image: -moz-linear-gradient(left, #9bc1d1, #377cfc, #9bc1d1);
              background-image: -ms-linear-gradient(left, #9bc1d1, #377cfc, #9bc1d1);
              background-image: -o-linear-gradient(left, #9bc1d1, #377cfc, #9bc1d1);
              width: 50%;
              color: #377cfc;
            }

            hr.style3 {
                border-top: 3px double;
                color: #377cfc;
                width: 50%;
            }

            h2,.blue {
                color: #377cfc;
            }

            th{
              text-align: left !important;
              width: 50%;
            }

            td{
               width: 50%;
            }

            .colum1 tr td:nth-child(1),.colum1 tr th{
                background-color: #fafafa;
                font-weight: bold;
            }

            .titulo-center {
                text-align: center;
            }

            footer{
                position: fixed;
                bottom: 0;
            }

            /* Justificar parrafo */
            p{
                text-align: justify;
            }

            /* Pruebas */
            
            .subtitulo {
                padding-left: 50px;
            }

            .parrafo{
                padding-left: 65px
            }

            .logo_derecha{
              
              position: absolute;
              right: 0;
            }

            .colorText{
                text-decoration: none; color: #377cfc;
            }

            .imgRadius{
                border-radius: 350%;
            }

            .textCenter{
                text-align: center;
            }

            .textLeft{
                text-align: left;
            }

           @if(route('home') != "https://pta.t3rsc.co")
           
            .breakAlways{
                page-break-after: always;
            }
           @endif
        </style>

    </head>
    <body>
                      
        
        <h3 class="textCenter"></h3>

         {{--<a type="button" style="width: 100%;text-decoration:none;color:white" class="btn btn-sm btn-info" href="{{route("admin.entrevista_semi_pdf",["user_id"=>$candidato_req->req_candidato_id])}}" target="_blank">
                          Ver entrevista(s)
          </a>--}}
          {{$familia}}

            @if(route('home') == "https://nases.t3rsc.co" || route('home') == "http://nases.t3rsc.co" || route('home') == "https://demo.t3rsc.co" || route('home') == "http://demo.t3rsc.co")


                    <h3 class="textCenter">II. Datos generales del candidato</h3>

                            <table>
                                <tr>
                                    <th >Nombre</th>
                                    <td class="textCenter" style="border: solid #e4e4e4 1px; width:30%;">
                                        {{ $entrevistas_semi->nombres_apellidos }}
                                    </td>
                                    <th class="textCenter">Documento Identidad</th>
                                    <td class="textCenter" style="border: solid #e4e4e4 1px">{{ $entrevistas_semi->numero_id }}</td>
                                </tr>

                                <tr>
                                    <th class="textCenter">Edad</th>
                                    <td class="textCenter" style="border: solid #e4e4e4 1px">{{ $edad }}</td>
                                    <th class="textCenter">Fecha Nacimiento</th>
                                    <td class="textCenter" style="border: solid #e4e4e4 1px">{{ $datos_basicos->fecha_nacimiento }}</td>
                                </tr>

                                <tr>
                                    <th class="textCenter">Ciudad Nacimiento</th>
                                    <td class="textCenter" style="border: solid #e4e4e4 1px">{{ $txtLugarNacimiento }}</td>
                                    <th class="textCenter">Ciudad Residencia</th>
                                    <td class="textCenter" style="border: solid #e4e4e4 1px">{{ $txtLugarResidencia }}</td>
                                </tr>

                                <tr>
                                    <th class="textCenter">Dirección</th>
                                    <td class="textCenter" style="border: solid #e4e4e4 1px">{{ $datos_basicos->direccion }}</td>
                                    <th class="textCenter">Localidad</th>
                                    <td class="textCenter" style="border: solid #e4e4e4 1px">{{ $datos_basicos->localidad }}</td>
                                </tr>

                                <tr>
                                    <th class="textCenter">Barrio</th>
                                    <td class="textCenter" style="border: solid #e4e4e4 1px">{{ $datos_basicos->barrio }}</td>
                                    <th class="textCenter">Celular</th>
                                    <td class="textCenter" style="border: solid #e4e4e4 1px">{{ $datos_basicos->telefono_movil }}</td>
                                </tr>

                                <tr>
                                    <th class="textCenter">Teléfono</th>
                                    <td class="textCenter" style="border: solid #e4e4e4 1px">{{ $datos_basicos->telefono_fijo }}</td>
                                    <th class="textCenter">Correo</th>
                                    <td class="textCenter" style="border: solid #e4e4e4 1px">{{ $datos_basicos->email }}</td>
                                </tr>
                            </table>

                          

                        @else

                               
                               <h3 class="textCenter">
                                ENTREVISTA SEMIESTRUCTURADA
                               </h3>

                               <br><br>

                                <h3 class="textCenter"> Información del cliente</h3>
                                
                                <table>
                                    <tr>
                                      <th>Cliente </th>
                                      <td>{{$reqcandidato->cliente_nombre}}</td>
                                    </tr>

                                    <tr>
                                      <th>N° Req</th>
                                      <td >{{ $reqcandidato->requerimiento_id }}</td>
                                    </tr>

                                </table>

                                <br><br>

                                <h3 class="textCenter">Información del Candidato</h3>
                                
                                <table>
                                    
                                    <tr>
                                      <th> Nombres y apellidos: </th>
                                      <td > {{ $entrevistas_semi->nombres_apellidos }} </td>

                                       <th> Cédula: </th>
                                       <td> {{ $entrevistas_semi->cedula }} </td>
                                    </tr>

                                    <tr>
                                      <th> N° Celular:  </th>
                                      <td > {{ $entrevistas_semi->celular }} </td>

                                      <th> Estado civil: </th>
                                      <td > {{ $entrevistas_semi->estado_civil }}  </td>
                                    </tr>

                                    <tr>
                                      <th> Fecha de Nacimiento: </th>
                                      <td > {{ $entrevistas_semi->fecha_nacimiento }}</td>

                                      <th> Edad: </th>
                                      <td > {{ $entrevistas_semi->edad }}</td>
                                    </tr>

                                    <tr>
                                      <th> Dirección: </th>
                                      <td >{{ $entrevistas_semi->direccion }}</td>

                                      <th>  Barrio </th>
                                      <td > {{ $entrevistas_semi->barrio }}</td>
                                    </tr>

                                    <tr>
                                      <th> Libreta Militar : </th>
                                      <td> {{ $entrevistas_semi->libreta_militar }}</td>
                                      <th></th>
                                      <td></td>
                                    </tr>

                                </table>

                                <br><br>

                              @if($entrevistas_semi->vive_con)

                                <h3 class="textCenter"> Grupo Familiar</h3>
                                 <?php $vive = json_decode($entrevistas_semi->vive_con); ?>

                                 @foreach($vive as $key=> $value)
                                 
                                 <table>

                                    <tr>
                                      <th colspa="2" style="border: none !important;"> Vive con: </th>
                                    </tr>

                                    <tr>
                                     <th>
                                      Parentesco:</th>
                                     <td>{{ $value->parentesco}} </td>
                                    </tr>

                                    <tr>
                                     <th>
                                     Nombre:</th>
                                     <td>{{ $value->nombre}} </td>
                                    </tr>

                                    <tr>
                                     <th>
                                     Edad:</th>
                                     <td> {{ $value->edad}} </td>
                                    </tr>

                                    <tr>
                                     <th>
                                     Ocupación:</th>
                                     <td>{{ $value->ocupacion}}  </td>
                                    </tr>
                                  </table>
                                  <br>

                                 @endforeach

                                <br><br>
                                @endif

                                @if($entrevistas_semi->hijos)
                                 <div class="breakAlways"></div>

                                 <?php $hijo = json_decode($entrevistas_semi->hijos); ?>
                                 
                                  @foreach($hijo as $key=> $value)
                                    
                                   <table>
                                   
                                    <tr>
                                     <th colspan="2" style="border: none !important;"> Hijos que no convivan con el candidato: </th>

                                    </tr>

                                    <tr>
                                     <th> Nombre </th>
                                     <td>{{ $value->nombre}} </td>
                                    </tr>

                                    <tr>
                                     <th> Edad: </th>
                                     <td>{{ $value->edad}}  </td>
                                    </tr>

                                    <tr>
                                     <th> Ocupación: </th>
                                     <td>{{ $value->ocupacion}}  </td>
                                    </tr>

                                    <tr>
                                     <th> Con quien vive: </th>
                                     <td> {{ $value->con_quien }} </td>
                                    </tr>

                                    <tr>
                                     <th> Cada cuanto le visita: </th>
                                     <td>{{ $value->cada_cuanto}}  </td>
                                    </tr>

                                    <tr>
                                     <th> Apoyo económico: </th>
                                     <td> {{ $value->apoyo_economico}} </td>
                                    </tr>
                                   
                                   </table>
                                   <br>                                   
                                  @endforeach

                                
                                <br><br>
                                @endif

                            @if( $entrevistas_semi->tiene_familiares )
                                <div class="breakAlways"></div>

                                <?php $familiares_empresa = json_decode($entrevistas_semi->familiares); ?>
                                 
                                @foreach($familiares_empresa as $key=> $value)
                                    
                                   <table>
                                   
                                    <tr>
                                     <th colspan="2" style="border: none !important;"> Familiares laborando actualmente dentro de la empresa usuaria </th>

                                    </tr>

                                    <tr>
                                     <th> Nombre </th>
                                     <td>{{ $value->nombre}} </td>
                                    </tr>

                                    <tr>
                                     <th> Apellido: </th>
                                     <td>{{ $value->apellido}}  </td>
                                    </tr>

                                    <tr>
                                     <th> Cargo: </th>
                                     <td>{{ $value->cargo}}  </td>
                                    </tr>

                                    <tr>
                                     <th> Área: </th>
                                     <td> {{ $value->area }} </td>
                                    </tr>
                                   
                                   </table>
                                   <br>                                   
                                @endforeach
                            @endif

                              @if($entrevistas_semi->titulos != "" || !is_null($entrevistas_semi->titulos))

                                <h3 class="textCenter"> Información educativa </h3>
                                
                                 <?php $titulo = json_decode($entrevistas_semi->titulos); ?>
                                 
                                  @foreach($titulo as $key=> $value)
                    
                                <table>
                                    <tr>
                                      <th> Título: </th>
                                      <td >{{$value->nombre}} </td>
                                    </tr>

                                    <tr>
                                      <th> Institución: </th>
                                      <td> {{$value->edad}} </td>
                                    </tr>

                                    <tr>
                                      <th> Año: </th>
                                      <td>{{$value->ocupacion}} </td>
                                    </tr>

                                    <tr>
                                      <th> Ciudad de graduación: </th>
                                      <td>{{$value->ciudad}}</td>
                                    </tr>
                                </table>
                                  <br>
                                  @endforeach

                                <br><br>
                              @endif

                                <h3 class="textCenter"> Proyectos </h3>
                                
                                <table>
                                  @if($entrevistas_semi->proyecto1)
                                   <tr><th>1)</th><td> {{ $entrevistas_semi->proyecto1 }}</td></tr>
                                  @endif
                                  
                                  @if($entrevistas_semi->proyecto2)
                                   <tr><th>2)</th><td> {{ $entrevistas_semi->proyecto2 }}</td></tr>
                                  @endif

                                  @if($entrevistas_semi->proyecto3)
                                   <tr><th>3)</th><td> {{ $entrevistas_semi->proyecto3 }}</td></tr>
                                  @endif

                                </table>

                                <br><br>

                               @if($entrevistas_semi->experiencias != "" || !is_null($entrevistas_semi->experiencias))
                              
                                <h3 class="textCenter"> Información laboral </h3>

                                 <?php $laboral = json_decode($entrevistas_semi->experiencias); ?>
                                  
                                  <table>
                                   <tr>
                                    <th> ¿El candidato cuenta con experiencia laboral? </th>
                                    <td>SI </td>
                                   </tr>
                                  </table>
                                 
                                  @foreach($laboral as $key=> $value)
                    
                                  <table>
                                    
                                    <tr>
                                     <th >Empresa</th><td>{{$value->empresa}}</td>
                                    </tr>
                                    <tr>
                                     <th >Cargo</th><td>{{$value->cargo}}</td>
                                    </tr>

                                    <tr>
                                     <th>Jefe inmediato</th><td>{{$value->jefe_inmediato}}</td>
                                    </tr>

                                    <tr>
                                     <th>Salario</th><td>{{$value->salario}}</td>
                                    </tr>

                                    <tr>
                                     <th>Beneficios</th><td>{{$value->beneficios}}</td>
                                    </tr>

                                    <tr>
                                     <th>Horario</th><td>{{$value->horario}}</td>
                                    </tr>

                                    <tr>
                                     <th>Ingreso</th><td>{{$value->ingreso}}</td>
                                    </tr>

                                    <tr>
                                     <th>Retiro</th><td>{{$value->retiro}}</td>
                                    </tr>
                                    
                                    <tr>
                                     <th>Motivo del retiro</th><td>{{$value->motivo_retiro}}</td>
                                    </tr>

                                    <tr>
                                     <th>Funciones</th><td>{{$value->funciones}}</td>
                                    </tr>

                                  </table>
                                  <br>
                                 @endforeach
                                  
                                  <br>

                                  @endif
                                  
                                  <table>
                                    <tr>
                                     <th> Disponibilidad para viajar o traslado de ciudad:</th><td>{{ $entrevistas_semi->disponibilidad }}</td>
                                    </tr>

                                    <tr>
                                     <th> Reporte o novedades en Datacredito o Cifin:</th><td>{{ $entrevistas_semi->reporte }}</td>
                                    </tr>

                                    <tr>
                                     <th> Nivel de endeudamiento:</th><td>{{ $entrevistas_semi->nivel_endeudamiento }}</td>
                                    </tr>

                                    <tr>
                                     <th> Multas o comparendos:</th><td>{{ $entrevistas_semi->multas }}</td>
                                    </tr>
                                  </table>

                                <br><br>
                                <h3 class="textCenter"> Información estado de salud </h3>
                                
                                <table>

                                    <tr>
                                      <th> ¿Ha tenido alguna enfermedad? </th>
                                      <td> {{ $entrevistas_semi->enfermedades }}</td>
                                    </tr>

                                    <tr>
                                     <th>¿Le han practicado alguna cirugía?</th><td>{{ $entrevistas_semi->cirugias }}</td>
                                    </tr>
                                    <tr>
                                     <th>¿ Posee alergias, fobias o consume algún medicamento u otros? </th><td>{{ $entrevistas_semi->alergias }}</td>
                                    </tr>

                                    <tr>
                                     <th> ¿Ha tenido fiebre, tos, dolor de garganta, malestar general o dificultad para respirar en los últimos 14 días? en el caso de indicar que SI indique cual </th><td>{{ $entrevistas_semi->covid1}}</td>
                                    </tr>
                                    
                                    <tr>
                                     <th> ¿Ha tenido contacto estrecho con alguna persona que haya llegado de otro país en los últimos 14 días o con alguna persona diagnosticada como caso sospechoso o confirmado de COVID 19?</th><td>{{ $entrevistas_semi->covid2}}</td>
                                    </tr>

                                    <tr>
                                     <th> ¿Vive con personas que trabajen en servicios de salud?</th><td>{{ $entrevistas_semi->covid3}}</td>
                                    </tr>

                                    <tr>
                                        <th>
                                            ¿Ha sido diagnosticado con COVID-19?
                                        </th>

                                        <td>
                                            @if( $entrevistas_semi->diagnosticado_covid19 == 1 )
                                                SI
                                            @else
                                                NO 
                                            @endif
                                        </td>
                                    </tr>

                                    @if( $entrevistas_semi->diagnosticado_covid19 == 1 )
                                        <tr>
                                            <th>
                                                ¿En qué fecha fue diagnosticado?
                                            </th>

                                            <td>
                                                {{$entrevistas_semi->fecha_diagnosticado_covid19}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                ¿Posee alguna secuela generada por COVID-19?
                                            </th>

                                            <td>
                                                @if( $entrevistas_semi->secuela_covid19 == 1 )
                                                    SI
                                                @else
                                                    NO 
                                                @endif
                                            </td>
                                        </tr>
                                        @if( $entrevistas_semi->secuela_covid19 == 1 )
                                            <tr>
                                                <th>
                                                    ¿Cuál?
                                                </th>

                                                <td>
                                                    {{$entrevistas_semi->cual_secuela_covid19}}
                                                </td>
                                            </tr>
                                        @endif
                                    @endif

                                    <tr>
                                        <th>
                                            ¿Se encuentra vacunado contra COVID-19?
                                        </th>

                                        <td>
                                            @if( $entrevistas_semi->vacunado_contra_covid19 == 1 )
                                                SI
                                            @else
                                                NO 
                                            @endif
                                        </td>
                                    </tr>

                                    @if( $entrevistas_semi->vacunado_contra_covid19 == 1 )
                                        <tr>
                                            <th>
                                                ¿Con cuántas dosis de vacuna contra COVID-19 cuenta?
                                            </th>

                                            <td>
                                                {{$entrevistas_semi->cuantas_dosis_vacuna_covid19}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                ¿En qué fechas se aplicó cada dosis?
                                            </th>

                                            <td>
                                                {{$entrevistas_semi->fechas_vacunas_covid19}}
                                            </td>
                                        </tr>
                                    @endif

                                </table>

                                <br><br>
                                <div class="breakAlways"></div>
                                <h3 class="textCenter">Evaluación</h3>
                                <table>
                                    <tr>
                                      <th> Nombre Evaluación </th>
                                      <th> Descripción       </th>
                                      <th> Sin Evaluar       </th>
                                      <th> Inferior requerido</th>
                                      <th> Acorde requerido  </th>
                                      <th> Superior requerido</th>
                                    </tr>
                                        
                                        <tr>
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">PRESENTACIÓN PERSONAL</td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:40% !important;">Vestimenta, aseo y apariencia personal</td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[1] == 1)
                                                    <p>SI</p>
                                                @endif</td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[1] == 2)
                                                    <p>SI</p>
                                                @endif</td>

                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[1] == 3)
                                                    <p>SI</p>
                                                @endif</td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[1] == 4)
                                                    <p>SI</p>
                                                @endif</td>
                                        </tr>

                                        <tr>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">COMPORTAMIENTO VERBAL</td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:40% !important;">Vocabulario empleado, fluidéz verbal, hilación y coherencias en las ideas.</td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;"> @if($entrevistas_semi->getCompetencias()[2] == 1)
                                            <p>SI</p>
                                          @endif</td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">
                                            @if($entrevistas_semi->getCompetencias()[2] == 2)
                                              <p>SI</p>
                                            @endif
                                          </td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[2] == 3)
                                                    <p>SI</p>
                                                @endif</td>

                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[2] == 4)
                                                    <p>SI</p>
                                                @endif</td>
                                          
                                        </tr>

                                        <tr>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;"> COMPORTAMIENTO NO VERBAL </td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:40% !important;">Contacto visual, gestos, movimientos de las manos y disposición corporal.</td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[3] == 1)
                                                    <p>SI</p>
                                                @endif</td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[3] == 2)
                                                    <p>SI</p>
                                                @endif</td>

                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[3] == 3)
                                                    <p>SI</p>
                                                @endif</td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[3] == 4)
                                                    <p>SI</p>
                                                @endif</td>
                                        </tr>

                                        <tr>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;"> AUTOESTIMA </td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:40% !important;"> Auto-estima, auto concepto, auto eficacia y auto imagen. </td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[4] == 1)
                                                    <p>SI</p>
                                                @endif</td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[4] == 2)
                                                    <p>SI</p>
                                                @endif</td>

                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[4] == 3)
                                                    <p>SI</p>
                                                @endif</td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[4] == 4)
                                                    <p>SI</p>
                                                @endif</td>
                                        </tr>

                                        <tr>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;"> PROYECCIÓN </td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:40% !important;"> Establecimiento de sus metas personales, laborales, académicas, comportamientos proactivos. </td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[5] == 1)
                                                    <p>SI</p>
                                                @endif</td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[5] == 2)
                                                    <p>SI</p>
                                                @endif</td>

                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[5] == 3)
                                                    <p>SI</p>
                                                @endif</td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[5] == 4)
                                                    <p>SI</p>
                                                @endif</td>
                                        </tr>

                                        <tr>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;"> HABILIDAD DE AFRONTAMIENTO </td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:40% !important;"> Capacidad para adaptarse a nuevas situaciones, empleo de fortalezas, académicas, comportamientos proactivos para resolución de conflictos y facilidad en la toma de decisiones. </td>

                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[6] == 1)
                                                    <p>SI</p>
                                                @endif</td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[6] == 2)
                                                    <p>SI</p>
                                                @endif</td>

                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[6] == 3)
                                                    <p>SI</p>
                                                @endif</td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[6] == 4)
                                                    <p>SI</p>
                                                @endif</td>
                                        </tr>

                                        <tr>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;"> HABILIDADES SOCIALES </td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:40% !important;"> Empatía, amabilidad, iniciativa y facilidad en la interacción. </td>

                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[7] == 1)
                                                    <p>SI</p>
                                                @endif</td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[7] == 2)
                                                    <p>SI</p>
                                                @endif</td>

                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[7] == 3)
                                                    <p>SI</p>
                                                @endif</td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[7] == 4)
                                                    <p>SI</p>
                                                @endif</td>
                                        </tr>

                                        <tr>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;"> MOTIVACIÓN </td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:40% !important;"> Interés por el cargo, interés en la organización y dinamismo. </td>

                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[8] == 1)
                                                    <p>SI</p>
                                                @endif</td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[8] == 2)
                                                    <p>SI</p>
                                                @endif</td>

                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[8] == 3)
                                                    <p>SI</p>
                                                @endif</td>
                                          
                                          <td style="border: solid #e4e4e4 1px; width:30% !important;">@if($entrevistas_semi->getCompetencias()[8] == 4)
                                                    <p>SI</p>
                                                @endif</td>
                                        </tr>

                                </table>

                            <br><br>
                            <h3 class="textCenter"> Especificaciones para el cargo </h3>
                                
                                <table>
                    
                                    <tr>
                                      <th > Fortalezas </th>
                                      <td> {{ $entrevistas_semi->fortalezas}}</td>
                                    </tr>

                                    <tr>
                                     <th > Oportunidades de mejora </th><td>{{ $entrevistas_semi->opor_mejora}}</td>
                                    </tr>
                                    @if($entrevistas_semi->proyectos != null && $entrevistas_semi->proyectos != '')
                                      <tr>
                                       <th > Proyectos y/o expectativas </th><td>{{ $entrevistas_semi->proyectos}}</td>
                                      </tr>
                                    @endif

                                    <tr>
                                     <th > Valores y/o compromisos </th><td>{{ $entrevistas_semi->valores}}</td>
                                    </tr>
                                    
                                    <tr>
                                     <th > ¿Por qué el candidato es idóneo para el cargo? </th><td>{{ $entrevistas_semi->candidato_idoneo}}</td>
                                    </tr>

                                    
                                    <tr>
                                     <th > Gastos mensuales: (Valor y en que los invierte) </th><td>{{ $entrevistas_semi->gastos_mensuales}}</td>
                                    </tr>

                                    <tr>
                                     <th > Ingresos adicionales:</th><td>{{ $entrevistas_semi->ingresos_adicionales}}</td>
                                    </tr>

                                    <tr>
                                     <th > Pasatiempos: </th><td>{{ $entrevistas_semi->pasatiempos}}</td>
                                    </tr>

                                </table>
                                <br><br>
                                <table>
                    
                                    <tr>
                                      <th> Informe y concepto de Aptitud:</th>
                                      <td> {{ $entrevistas_semi->concepto_entre}}</td>
                                    </tr>
                                    <tr>
                                      <th> Apto</th>
                                      <td>{{($entrevistas_semi->apto == 1)? 'SI':'NO'}}</td>
                                    </tr>
                                    <tr>
                                      <th> Aplazado</th>
                                      <td> {{($entrevistas_semi->aplazado == 1)? 'SI':'NO'}}</td>
                                    </tr>
                                    <tr>
                                      <th> Pendiente</th>
                                      <td> {{($entrevistas_semi->pendiente == 1)? 'SI':'NO'}}</td>
                                    </tr>
                                </table>

                              <br><br>

                              <table>
                                <tr>
                                 <th> Entrevistador:</th>
                                 <td> {{ $entrevistas_semi->getNamePsicologo()}}</td>
                                </tr>
                              </table>
                                
                             @endif

                            {{-- *********para Soluciones ************** --}}
</body>