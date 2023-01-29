<div>
  <div class="text-left">
      @if(isset($sitio))
        <img src="{{ asset('configuracion_sitio/'.$sitio->logo) }}" width="150" height="43">
      @endif
  </div>
	<br>
	<div>
		<h2 style="font-weight: bold;text-align: center;">OTRO SI AL CONTRATO DE TRABAJO SUSCRITO POR OBRA O LABOR DETERMINADA PARA TRABAJADORES EN MISIÓN </h2>
	</div>
	<br>
	<br>

	<div>
	  <p style="text-align: justify;padding-bottom: 3em;line-height: 2em;"> Entre los suscritos SOLUCIONES INMEDIATAS SA. Con NIT 800.199.453-1, quien en adelante se denominara el EMPLEADOR y {{$candidato->fullname()}} identificado con {{ucwords(mb_strtolower($candidato->dec_tipo_doc))}} No {{$candidato->numero_id}}, ha convenido de manera libre y espontánea modificar el contrato vigente de la siguiente manera:</p>

      <p style="text-align: justify;padding-bottom: 3em;line-height: 2em;"> Que a partir de su fecha de ingreso recibirá la suma de ${{$requerimiento->detalle_rodamiento}} por concepto de Auxilio de Rodamiento, los cuales no constituyen salario y por tanto no son base para prestaciones sociales y/o aportes a la seguridad social, dicho Auxilio se podrá aumentar, disminuir o cancelar según disposición del empleador.</p>
      <br>

      En constancia de lo anterior firman las partes el día <?php setlocale(LC_TIME, 'es_ES.UTF-8'); echo strftime(" %d de %B de %Y") ?>.

	</div>
	
<div>

   <br><br><br>
	 
	<div style="">
	  <table class="tabla" width="50%">
       <tr>
        <td width="40%">
          <p> EL EMPLEADOR: </p>
         <div style="">
          {{--style="width: 60%;"--}}
            <p> <img src="{{ asset('contratos/default.jpg') }}" width="180" style="margin:0;"> </p>
            <div style="">
            <p>________________________________</p>
            <!--- nombre y el cargo -->
             <p> Andrea del Pilar Ramirez </p>
             <p> Gerente de Gestión Humana </p>
            </div>
            <br>
         </div>
        </td>            
         <td width="20%"></td>

          <td width="25%" style="padding-left:200px;">
            <p style="margin-top: -45px;"> EL TRABAJADOR </p>
              <div >
               <p> @if(isset($firma)) <img src="{{$firma}}" width="180" height="60" style="margin:0;"> @endif </p>
		            <br><br>
                <p style="margin-top: 0px;"> ________________________________</p> {{--style="width: 60%;"--}}
                <br> {{$candidato->fullname()}} 
                <br>
                 {{ucwords(mb_strtolower($candidato->dec_tipo_doc))}}: {{$candidato->numero_id}}.
	              </div>
            </td>
          </tr>
      </table>
	</div>
 </div>
</div>