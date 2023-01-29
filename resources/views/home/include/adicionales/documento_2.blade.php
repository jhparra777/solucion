<div class="encabezado">
	{{--<p>Ciudad y Fecha : {{$requerimiento->ciudad}} {{$fecha}}</p>
	
	<p style="text-transform: uppercase;">{{$user->name}}</p>
	
	<p>Identificado con CÉDULA CIUDADANÍA :{{$user->numero_id}}</p>--}}

	<table style="width: 100%;border: 1px solid black;padding: 1em;border-collapse: collapse;text-align: center;">
		<tr>
			<td rowspan="2" style="width: 100px;border: 1px solid black;">
				@if($requerimiento->logo!=null)
					<img style="max-width: 100px" src='{{ asset("configuracion_sitio/$requerimiento->logo") }}'>
				@else

					@if(isset(FuncionesGlobales::sitio()->logo))
                  		@if(FuncionesGlobales::sitio()->logo != "")


                 			<img class="img-fluid"
		                        width="150"
		                        height="43" 
		                        src="{{ url('configuracion_sitio')}}/{!! ((FuncionesGlobales::sitio()->logo)) !!}" >
                		@else
                 
							<img class="img-fluid"
		                        src="{{ url("img/logo.png")}}"
		                        width="150"
		                        height="43"  >
                		@endif
              
			  		@endif
			  	@endif
			</td>
			<td colspan="3" style="font-weight: bold;padding: .5em;"> COMPROMISO DEFINICIÓN SITUACIÓN MILITAR </td>
		</tr>
		<tr>
			<td style="border: 1px solid black;"> Código:  SEFM21 </td>
			<td style="border: 1px solid black;"> Versión:1.0 </td>
			<td style="border: 1px solid black;"> Vigencia:14/11/2017 </td>
		</tr>
	</table>
</div>
	
<br>

<div>
	<strong style="font-weight: bold;"> Señores: </strong><br>
    <strong style="font-weight: bold;"> SOLUCIONES INMEDIATAS S.A. </strong>
	<br>

	<strong style="font-weight: bold;"> Ciudad </strong> <strong> {{$requerimiento->agencia_req()}}</strong><br><br>

    <p style="text-align: justify; font-size: 14px;">
    	Yo, <span id ="nombre" style="text-transform: uppercase;">{{$candidato->fullname()}}</span>,  portador de {{ucwords(mb_strtolower($candidato->dec_tipo_doc))}} No. {{$candidato->numero_id}} de @if($lugarexpedicion!=null) {{$lugarexpedicion->value}} @endif , por medio del presente documento, y con soporte en lo resuelto en el artículo 20 de la Ley 1780 de 2016 Parágrafo 1 y el artículo 42 parráfo 2 de la Ley 1861 de 2017, certifico bajo la gravedad del juramento que, en un término de treinta (30) días hábiles contados a mi contratación entregare a la compañía, certificado provisional en linea por unica vez del tramite para definir mi situación Militar ante el Ministerio de Defensa Nacional, Ejercito Nacional dentro de los tiempos previstos por la norma en mención. Salvaguardando así a la compañía de cualquier sanción establecida en la ley 1861 de 2017 artículo 46 literal d).                                                      
    	<br>
		Reconozco que, si lo aquí afirmado no se efectúa, estaría incurso en la causal de terminación de cualquier contrato de trabajo que se llegare a celebrar con la empresa, al tenor del literal a)  numeral 1 del artículo 62 del C.S.T.
	</p>
	<br>
	<p style="font-weight: bold;">Cordialmente,</p>
	<br><br>
	<div>
		<p style="font-weight: bold;"> Firma: </p> 
	    
		<p>@if(isset($firma)) <img src="{{$firma}}" width="200" height="90" style="margin:0;">@endif 
		<br><br>________________________</p><br>
	    <p style="font-weight: bold;">{{ucwords(mb_strtolower($candidato->dec_tipo_doc))}}:{{$candidato->numero_id}}</p>
	</div>

	<br>
    <p>Se firma en {{ucwords(mb_strtolower($requerimiento->ciudad_req()))}} a los <?php setlocale(LC_TIME, 'es_ES.UTF-8'); echo strftime(" %d dias del mes de %B del año %Y") ?>.</p>
  
</div>
