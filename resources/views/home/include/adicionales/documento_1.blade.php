<div>
	<div class="text-left">
        @if(isset($sitio))
            <img src="{{ asset('configuracion_sitio/'.$sitio->logo) }}" width="150" height="43">
        @endif
    </div>
  <br>
	<div>

	  	<h2 style="font-weight: bold;text-align: center;">
	  		@if( $requerimiento->tipo_contrato_id == 1 )
	  			OTRO SI AL CONTRATO DE TRABAJO SUSCRITO A TÉRMINO INDEFINIDO
	  		@else
	  			OTRO SI AL CONTRATO DE TRABAJO SUSCRITO POR DURACION DE OBRA O LABOR DETERMINADA PARA TRABAJADORES EN MISION
	  		@endif
		</h2>

	</div>
	<br>
	<br>

	<div>
	  <p style="text-align: justify;padding-bottom: 3em;line-height: 2em;"> Entre los suscritos SOLUCIONES INMEDIATAS SA. Con NIT 800.199.453-1, quien en adelante se denominara el EMPLEADOR y {{$candidato->fullname()}} identificado con Cédula No  {{$candidato->numero_id}}, Quien en sucesivo denominara EL TRABAJADOR, se han convenido de manera libre y espontánea:</p>
	</div>
	
	<div>
	<p style="text-align: justify;padding-bottom: 3em;line-height: 2em;">
	 <strong>ACUERDO CONFIDENCIALIDAD</strong>
	 <br><br>

     1. Que el TRABAJADOR suscribió un contrato de trabajo por 
     @if( $requerimiento->tipo_contrato_id == 1 )
     	término indefinido
     @else
     	obra o labor
     @endif 
     para prestar su servicio como trabajador en misión en la empresa usuaria {{(!empty($requerimiento->nombre_cliente_req()))?$requerimiento->nombre_cliente_req():''}}

	<br><br>
     
	 2. Que en virtud del contrato de trabajo vigente, el TRABAJADOR ha tenido y tendrá acceso a cierta información, la cual es confidencial de la empresa usuaria {{(!empty($requerimiento->nombre_cliente_req()))?$requerimiento->nombre_cliente_req():''}}, al igual que el conocimiento de los clientes actuales o potenciales de la USUARIA.
	<br><br>
     3. Que la información anteriormente referida es de suma importancia tanto para la empresa usuaria {{(!empty($requerimiento->nombre_cliente_req()))?$requerimiento->nombre_cliente_req():''}} como para sus clientes y que en esa medida la revelación, empleo o divulgación de la misma puede ser gravemente perjudicial para las mismas y, por lo tanto, tal información se define como DE USO EXCLUSIVO, INTERNO, CONFIDENCIAL Y ALTAMENTE RESTRINGIDO.
	<br><br>
     4. Que en razón de las anteriores consideraciones las Partes hemos decidido celebrar el presente Acuerdo de Exclusividad y Confidencialidad, el cual se regirá por las disposiciones establecidas en el capítulo 2º, título XVI de la decisión 486 de 2000 y la ley 1474 de 2011 artículo 18, en general por las normas aplicables a la materia, y especialmente por las siguientes:
	</p>

	<p style="text-align: justify;padding-bottom: 3em;line-height: 2em;">
	  
	  <strong> CLAUSULAS </strong>
	  <br><br>

		 <strong> PRIMERA. DEFINICIÓN DE INFORMACIÓN CONFIDENCIAL: </strong> se entiende como
		Información Confidencial, para los efectos del presente acuerdo:
		<br><br>
			1. La información que no sea pública y sea conocida por la el trabajador en misión con ocasión de estar en misión en las instalaciones en la empresa usuaria.
		<br><br>

			2. En el presente Acuerdo se haga referencia al término "Información confidencial" se entenderá todo tipo de información que tenga valor comercial y que pueda corresponder a (i)información técnica, incluyendo patentes, diseños industriales, derechos de autor, secretos comerciales, y otra información protegida, técnicas, bocetos, dibujos, modelos, inventos, conocimientos, procesos, aparatos, equipos, algoritmos, programas de computador, documentos con software fuente, y fórmulas relacionadas con productos y servicios que
		<br><br>

		saldrán en el futuro pero que se desarrollan actualmente o con productos que se planearán en el futuro de la Empresa, o (ii) información de carácter no técnico relacionada con los productos de la Empresa, incluyendo pero sin limitarse a los precios, márgenes, planes de mercadeo y estrategias, finanzas, datos financieros y contables, proveedores, clientes, listados de proveedores, datos de compra, planes de ventas y mercadeo, planes de negocios futuros y cualquier otra información que sea propiedad de y que tenga carácter confidencial para la empresa.
		<br><br>
			3. La que corresponda o deba considerarse como tal para garantizar el derecho constitucional a la intimidad, la honra y el buen nombre de las personas y deba guardarse la debida diligencia en su discreción y manejo en el desempeño de sus funciones.
		<br><br>
		 <strong> SEGUNDA. ORIGEN DE LA INFORMACIÓN CONFIDENCIAL:</strong> provendrá de documentos suministrados en el desarrollo del proyecto y que tiene que ver con las creaciones del intelecto, a la naturaleza, medios, formas de distribución, comercialización de productos o de prestación de servicios, transmitida verbal, visual o materialmente, por escrito en los documentos, medios electrónicos, discos ópticos, microfilmes, películas, e-mail u otros elementos similares suministrados de manera tangible o intangible, independiente de su fuente o soporte y sin que requiera advertir su carácter confidencial.
		<br><br>
		 <strong>TERCERA. OBLIGACIONES: </strong> de la parte receptora: Se considerará como parte receptora de la información confidencial al TRABAJADOR EN MISIÓN que recibe la información, o que tenga acceso a ella. La parte receptora se obliga a:
		<br><br>

			1. Mantener la información confidencial segura, usarla solamente para los propósitos relacionados con él, en caso de ser solicitada, devolverla toda (incluyendo copias de esta) en el momento en que ya no requiera hacer uso de la misma o cuando termine la relación, caso en el cual, deberá entregar dicha información antes de la terminación de la vinculación.
			<br><br>
			2. Proteger la información confidencial, sea verbal, escrita, visual, tangible, intangible o que por cualquier otro medio reciba, siendo legitima poseedora de la misma empresa, restringiendo su uso exclusivamente a las personas que tengan absoluta necesidad de conocerla.
			<br><br>
			3. Abstenerse de publicar la información confidencial que conozca, reciba o intercambie con ocasión de las reuniones sostenidas.
			<br><br>
			4. Usar la información confidencial que se le entregue, únicamente para los efectos señalados al momento de la entrega de dicha información.
			<br><br>
			5. Mantener la información confidencial en reserva hasta tanto adquiera el carácter de pública.
			<br><br>
			6. Responder por el mal uso que le den sus representantes a la información confidencial.
			<br><br>

			7. Guardar la reserva de la información confidencial como mínimo, con el mismo cuidado con la que protege la información confidencial.
			<br><br>
			8. La parte receptora o trabajador en misión se obliga a no transmitir, comunicar revelar o de cualquier otra forma divulgar total o parcialmente, pública o privadamente, la información confidencial sin el previo consentimiento por escrito por parte de la empresa.
			<br><br>

		Parágrafo: Cualquier divulgación autorizada de la información confidencial a terceras personas estará sujeta a las mismas obligaciones de confidencialidad derivadas del presente Acuerdo y la parte receptora deberá informar estas restricciones incluyendo la identificación de la información como confidencial.
		<br><br>
		 <strong> CUARTA. OBLIGACIONES DE LA PARTE REVELADORA: </strong> Son obligaciones de la parte reveladora:
		<br><br>
			1. Mantener la reserva de la información confidencial hasta tanto adquiera el carácter de pública.
			<br><br>
			2. Documentar toda la información confidencial que transmita de manera escrita, oral o visual, mediante documentos, medios electrónicos, discos ópticos, microfilmes, películas, e- mails u otros elementos similares o en cualquier forma tangible o no, incluidos los mensajes de datos, como registro de la misma para la determinación de su alcance, e indicar específicamente y de manera clara e inequívoca el carácter confidencia de la información suministrada de la parte receptora.
			<br><br>
		 <strong> QUINTA. EXCLUSIONES A LA CONFIDENCIALIDAD: </strong> El trabajador en misión queda relevada o eximida de la obligación de confidencialidad, únicamente en los siguientes casos:
		<br><br>
			1. Cuando la información confidencial haya sido o sea de dominio público. Si la información se hace de dominio público durante el plazo del presente acuerdo, por un hecho ajeno al trabajador en misión, esta conservará su deber de reserva sobre la información que no haya sido afectada.
			<br><br>
			2. Cuando la información confidencial deba ser revelada por sentencia en firme de un tribunal o autoridades competentes en desarrollo de sus funciones que ordenen el levantamiento de la reserva y soliciten el suministro de esta información. No obstante, en este caso la parte reveladora será la encargada de dar cumplimiento a la orden, restringiendo la divulgación a la información estrictamente necesaria, y en el evento de que la confidencialidad se mantenga, no eximirá a la parte receptora del deber de reserva.
			<br><br>
			3. Cuando el trabajador en misión pruebe que la información confidencial ha sido obtenida por otras fuentes.
			<br><br>
			4. Cuando la información confidencial ya la tenía en su poder la parte receptora antes de la entrega de la información reservada.
			<br><br>

		<strong> SEXTA. RESPONSABILIDAD: </strong> La parte que contravenga el acuerdo será responsable ante la otra parte o ante los terceros de buena fe sobre los cuales se demuestre que se han visto afectados por la inobservancia del presente acuerdo, por los perjuicios morales y económicos que estos puedan sufrir como resultado del incumplimiento de las obligaciones aquí contenidas.
		<br><br>
		<strong> SEPTIMA. CONTINUIDAD: </strong> El presente Acuerdo regirá todas las comunicaciones entre las partes. El Destinatario entiende que las obligaciones que se encuentran bajo el Párrafo 2 ("Obligaciones de Confidencialidad y No Uso de la Información") continuarán vigentes después de la terminación de cualquier otro tipo de relación entre las partes. A partir de la terminación de cualquiera de las relaciones entre las partes, el Destinatario entregará oportunamente a la Empresa, sin retener ninguna copia, todos los documentos y cualquier otro tipo de materiales que se le hayan entregado al Destinatario por parte de Empresa.
		<br><br>

		<strong> OCTAVA. Solución de controversias: </strong> Las partes se comprometen a esforzarse en resolver mediante los mecanismos alternativos de solución de conflictos cualquier diferencia que surja con motivo de la ejecución del presente acuerdo. En caso de no llegar a una solución directa para la controversia planteada, someterán la cuestión controvertida a las leyes colombianas y a la jurisdicción competente en el momento de presentarse la diferencia.
		<br><br>
		 <strong> NOVENA. Legislación aplicable: </strong> Este acuerdo se regirá por las leyes de la República de Colombia y se interpretará de acuerdo con las mismas.
		<br><br>
		 <strong> DÉCIMO. MEDIDAS CAUTELARES:</strong> Toda violación de cualquiera de las promesas o acuerdos contenidos en el presente dará como resultado daños y perjuicios irreparables a la Empresa para los cuales no habrá remedio apropiado en derecho, y la Empresa tendrá por lo tanto derecho a medidas cautelares y/o a que se decrete una ejecución específica, y cualquier otro tipo de medida que corresponda (incluyendo indemnización económica por daños y perjuicios en caso de que aplique).
		<br><br>
		<strong> DÉCIMO PRIMERA. ACUERDO COMPLETO:</strong> El presente Acuerdo constituye el acuerdo completo con respecto a la Información Confidencial que se revele en virtud del mismo y remplaza a todos y cada uno de los acuerdos orales o escritos previos o actuales con respecto a dicha Información Confidencial.
		<br><br>
		El presente Acuerdo solo podrá modificarse mediante acuerdo escrito por parte de los representantes autorizados de las partes.
		<br><br>
		 <strong> DÉCIMO SEGUNDA. ACEPTACIÓN DEL ACUERDO: </strong>Las partes han leído y estudiado de manera detenida los términos y el contenido del presente Acuerdo y por tanto manifiestan estar conformes y aceptan todas las condiciones.
		<br><br>
		Se firma en {{ucwords(mb_strtolower($requerimiento->ciudad_req()))}} a los ({{date('d')}}) días del mes de <?php setlocale(LC_TIME, 'es_ES.UTF-8'); echo strftime("%B de %Y") ?> </p>
	</div>
	<br><br>
	<div style="">
	  <table class="tabla" width="80%" style="border: none !important;">
       <tr>
        <td width="40%">
		 <p>Por la parte receptora:</p><br>
		 <p> @if(isset($firma)) <img src="{{$firma}}" width="220" style="margin:0;"> @endif 
		  <br> ________________________________</p>
		  <p> {{$candidato->fullname()}}  </p>
		  <p> {{ucwords(mb_strtolower($candidato->dec_tipo_doc))}} No:{{$candidato->numero_id}}</p>
		</td>
       </tr>
	  </table>
	</div>
</div>