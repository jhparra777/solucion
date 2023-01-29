<!DOCTYPE html>
<html lang="es">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title> Evaluación SST</title>
    </head>
  
    <style>

        body{
          font-family: Verdana, arial, sans-serif;
          font-size: 14px;
        }

        .tabla1, .tabla3{
          border-collapse: collapse;
        }

        .tabla2{
          border-collapse: collapse;
        }
      
        .tabla1, .tabla1 th, .tabla1 td,.tabla3 th, .tabla3 td {
            border: none;
            padding: 0;
            margin: 0;
        }

        .tabla2 td {
            padding: 0;
            margin: 0;
            font-size: 14px;
            border: 1px solid black;
        }

        .tabla2 th {
            background-color: #fdf099;
            font-size: 14px;
            font-weight: bold;
            border: 1px solid black;
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

        .p_1_{{$candidatos->preg_uno}} {
          background-color: #fdf099;
        }

        .p_2_{{$candidatos->preg_dos}} {
          background-color: #fdf099;
        }

        .p_3_{{$candidatos->preg_tres}} {
          background-color: #fdf099;
        }

        .p_4_{{$candidatos->preg_cuatro}} {
          background-color: #fdf099;
        }

        .p_5_{{$candidatos->preg_cinco}} {
          background-color: #fdf099;
        }

        .p_6_{{$candidatos->preg_seis}} {
          background-color: #fdf099;
        }

        .p_7_{{$candidatos->preg_siete}} {
          background-color: #fdf099;
        }

        .p_8_{{$candidatos->preg_ocho}} {
          background-color: #fdf099;
        }

        .text-center{
          text-align: center;
        }
        .text-justify{
          text-align: justify;
        }

    </style>

    <body>        
        {{--<p style="text-align: justify;">
            <label style="font-weight: bold;"> INSTRUCCIÓN: </label> <span style="font-size: 10px;"> La información que completará debe ser confiable, estrictamente ajustada a la realidad en todos sus
            datos y situación personal. La trayectoria laboral y formación académica será verificada en las instituciones y con las
            empresas validando fechas, cargos y motivos de salida. Las referencias laborales se aplicarán en el avance final del
            proceso, por lo que deben constar los jefes directos, una muestra de colegas y colaboradores, sus nombres serán
            verificados con las empresas previamente. Agradecemos su profesionalismo y colaboración. </span>
        </p>--}}
        <table width="100%">
          <tr>
            <td class="text-justify">
              <img alt="encabezado_sst" height="102" src="{{public_path('encabezado_sst.jpg')}}" width="650">
            </td>
          </tr>
        </table>
        <br/>

        <table class="table1" width="100%">
          <tr>
              <td colspan="2" style="text-align: center; width:90%; font-weight:bold; ">
                1) ¿Qué se busca con la implementación de la Política de Gestión Integral?
              </td>
          </tr>

          <tr>
              <td colspan="2" class="p_1_a" style="width:100%;"> 
                a. Obtener préstamos de entidades financieras para el crecimiento de la empresa. 
              </td>
          </tr>

          <tr>
              <td colspan="2" class="p_1_b" style="width:100%;"> 
                b. Imponer sanciones al personal que incumpla las normas de la empresa. 
              </td>
          </tr>

          <tr>
              <td colspan="2" class="p_1_c" style="width:100%;"> 
                c. Asegurar el bienestar laboral, la eficacia de las operaciones y la satisfacción de las empresas usuarias.
              </td>
          </tr>

          <tr>
              <td colspan="2" class="p_1_d" style="width:100%;">
               d. Reducir costos y aumentar la rentabilidad de la empresa.
              </td>
          </tr>

          <tr>
              <td colspan="2" style="text-align: center; width:90%; font-weight:bold;">
                <br/>
                2)¿Qué es un accidente de trabajo?
              </td>
          </tr>

          <tr>
              <td colspan="2" class="p_2_a" style="width:100%;"> 
                a. Todo suceso repentino que sobrevenga por causa o con ocasión del trabajo, y que produzca en el trabajador una lesión orgánica, una perturbación funcional o psiquiátrica, una invalidez o la muerte. 
              </td>
          </tr>

          <tr>
              <td colspan="2" class="p_2_b" style="width:100%;"> b. Aquel que se produce cuando el trabajador se traslada del trabajo a su vivienda en transporte público. </td>
          </tr>

          <tr>
              <td colspan="2" class="p_2_c" style="width:100%;"> 
                c. Aquel que se produce en cumplimiento de las tareas asignadas por mis amigos del trabajo. 
              </td>
          </tr>

          <tr>
              <td colspan="2" class="p_2_d" style="width:100%;"> 
                d. Todas las anteriores. 
              </td>
          </tr>

          

          <tr>
              <td colspan="2" style="text-align: center; width:90%; font-weight:bold;">
                <br/>
                3)¿Qué es una enfermedad laboral?
              </td>
          </tr>

          <tr>
              <td colspan="2" class="p_3_a" style="width:100%;">
                a. Es un incidente que se presenta dentro y fuera del lugar de trabajo. 
              </td>
          </tr>

          <tr>
              <td colspan="2" class="p_3_b" style="width:100%;"> 
                b. La contraída como resdivtado de la exposición a factores de riesgo inherentes a la actividad laboral o del medio en el que el trabajador se ha visto obligado a trabajar
              </td>
          </tr>

          <tr>
              <td colspan="2" class="p_3_c" style="width:100%;"> 
                c. Es una lesión que se presenta dentro del lugar de trabajo.
              </td>
          </tr>

          <tr>
              <td colspan="2" class="p_3_d" style="width:100%;"> 
                d. Ninguna de las anteriores. 
              </td>
          </tr>


          <tr>
              <td colspan="2" style="text-align: center; width:90%; font-weight:bold;">
                <br/>
                4)¿Cuál es el procedimiento a seguir en caso de accidente de trabajo? 
              </td>
          </tr>

          <tr>
              <td colspan="2" class="p_4_a" style="width:100%;"> a. Conservar la calma. </td>
          </tr>

          <tr>
              <td colspan="2" class="p_4_b" style="width:100%;">
                b. La contraída como resdivtado de la exposición a factores de riesgo inherentes a la actividad laboral o del medio en el que el trabajador se ha visto obligado a trabajar 
              </td>
          </tr>

          <tr>
              <td colspan="2" class="p_4_c" style="width:100%;"> c. Es una lesión que se presenta dentro del lugar de trabajo. </td>
          </tr>

          <tr>
              <td colspan="2" class="p_4_d" style="width:100%;"> d. Ninguna de las anteriores. </td>
          </tr>

          <tr>
              <td colspan="2" class="p_4_e" style="width:100%;"> e. Todas las anteriores. </td>
          </tr>

          <br/>

          <tr>
              <td colspan="2" style="text-align: center; width:90%; font-weight:bold;">
              <br/>
              5)¿Qué significa la sigla EPP? </td>
          </tr>

          <tr>
              <td colspan="2" class="p_5_a" style="width:100%;"> a. Elementos de Protección Personal </td>
          </tr>

          <tr>
              <td colspan="2" class="p_5_b" style="width:100%;"> b. Equipos de Producción de Plásticos. </td>
          </tr>

          <tr>
              <td colspan="2" class="p_5_c" style="width:100%;"> c. Elementos de Protección Colectiva. </td>
          </tr>
          
          <br/>

          <tr>
              <td colspan="2" style="text-align: center; width:90%; font-weight:bold;"> 
                <br/>
                6)¿Cuál de los siguientes principios NO hace parte de la Política de Seguridad Vial?
              </td>
          </tr>

          <tr>
              <td colspan="2" class="p_6_a" style="width:100%;"> a. Conducir más de 8 horas seguidas. </td>
          </tr>

          <tr>
              <td colspan="2" class="p_6_b" style="width:100%;"> b. Se debe cumplir siempre con los límites de velocidad. </td>
          </tr>

          <tr>
              <td colspan="2" class="p_6_c" style="width:100%;"> c. Se debe verificar el buen funcionamiento del vehícdivo (carro o moto) antes de cada uso, y reportar novedades o fallas que presente el mismo. </td>
          </tr>

          <tr>
              <td colspan="2" class="p_6_d" style="width:100%;"> d. Está prohibido usar teléfono celdivar mientras se conduce </td>
          </tr>

          <br/>

          <tr>
              <td colspan="2" style="text-align: center; width:90%; font-weight:bold;"> 
                <br/>
                7)¿Cuáles son las prohibiciones contenidas en la Política de prevención del consumo de alcohol, sustancias psicoactivas y tabaco? </td>
          </tr>

          <tr>
              <td colspan="2" class="p_7_a" style="width:100%;"> a. Tener un amigo dedicado a la venta de cigarrillos. </td>
          </tr>
          
          <tr>
              <td colspan="2" class="p_7_b" style="width:100%;"> b. Está prohibido presentarse al sitio de trabajo bajo la influencia de bebidas alcohólicas, sustancias psicoactivas, o que generen dependencia o alteren el normal estado de conciencia, el estado de ánimo, la percepción, la capacidad de reacción o que pueda influenciar negativamente en su conducta. </td>
          </tr>
                   
          <tr>
              <td colspan="2" class="p_7_c" style="width:100%;"> c. Está prohibida la indebida utilización de medicamentos formdivados o el uso, posesión, distribución, transporte o comercialización, tanto de bebidas alcohólicas, como de sustancias psicoactivas, o que generen dependencia o alteren el normal estado de conciencia, el estado de ánimo, la percepción y la capacidad de reacción, en funciones del trabajo, en actividades de carácter deportivo, recreativo o cdivtural, así como dentro de las instalaciones de la compañía, instalaciones de sus empresas usuarias o vehícdivos que estén al servicio de Soluciones Inmediatas S.A. o de sus empresas usuarias. </td>
          </tr>
          
          <tr>
              <td colspan="2" class="p_7_d" style="width:100%;"> d. b y c son verdaderas </td>
          </tr>
          
          <br/>
                
          <tr>
              <td colspan="2" style="text-align: center; width:90%; font-weight:bold;">
                <br/>
                8)¿Cuál de las siguientes NO es una responsabilidad de los trabajadores frente al Sistema de Gestión de la Seguridad y Salud en el Trabajo? </td>
          </tr>

          <tr>
              <td colspan="2" class="p_8_a" style="width:100%;"> a. Suministrar información clara, veraz y completa de su estado de salud. </td>
          </tr>
          
          <tr>
              <td colspan="2" class="p_8_b" style="width:100%;"> b. Comprar o arrendar vivienda cerca a la sede de la empresa usuaria. </td>
          </tr>
          
          <tr>
              <td colspan="2" class="p_8_c" style="width:100%;"> c. Participar en las actividades y capacitaciones del Sistema de Gestión de la Seguridad y Salud en el Trabajo. </td>
          </tr>
          
          <tr>
              <td colspan="2" class="p_8_d" style="width:100%;"> d. Reportar inmediatamente cualquier incidente o accidente de trabajo que me ocurra. </td>
          </tr>
          
          <tr>
              <td colspan="2" class="p_8_e" style="width:100%;"> e. Utilizar y mantener adecuadamente las instalaciones de la Empresa, los elementos de protección personal y los equipos de trabajo.</td>
          </tr>
          
          <tr>
              <td colspan="2" class="p_8_f" style="width:100%;"> f.Procurar el cuidado integral de su salud</td>
          </tr>
          
          <tr>
              <td colspan="2" class="p_8_g" style="width:100%;"> g. Cumplir con las normas, reglamentos e instrucciones del Sistema de Gestión de la Seguridad y Salud en el Trabajo establecidas por la Ley, por la empresa y/o por el cliente.</td>
          </tr>

          <tr>
              <td colspan="2" style="text-align:justify;">
                <br/><br/>
                Yo {{$candidatos->nombres.' '.$candidatos->primer_apellido.' '.$candidatos->segundo_apellido}},
                  identificado con Cédula de ciudadanía N° {{$candidatos->numero_id}},
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
          
          <tr>
                <td  style="margin: 4em;" width="70%">
                 <p> <img src="{{$candidatos->firma}}" width="180" style="margin:0;padding:0;"> <br>___________________________________</p>
		              <p>Nombre:  {{$candidatos->nombres.' '.$candidatos->primer_apellido.' '.$candidatos->segundo_apellido}} </p>
		              <p>C.C No: {{$candidatos->numero_id}}</p>
                  <p>fecha: <?php setlocale(LC_TIME, 'es_ES.UTF-8'); echo strftime(" %d de %B del %Y") ?></p>
                </td>
                <td> <p style="float:right;font-size: 20px;" width="30%">
                  Puntuación  <span style="text-align: right;"> {{(FuncionesGlobales::puntuacion_sst($candidatos))}}% </span> </p>
                </td>
            </tr>
          </table>
    </body>
</html>