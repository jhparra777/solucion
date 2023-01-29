<!-- Inicio contenido principal -->
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <h4 class="modal-title"> EVALUACIÓN DE INDUCCIÓN Y RE-INDUCCIÓN EN SST PERSONAL EN MISION </h4>
</div>
<div class="modal-body">
  {!! Form::open(["id"=>"fr_evaluacion"]) !!}
  {!! Form::hidden("candidato_req",$candidato->req_candidato,["id"=>"candidato_req_fr"]) !!}
    Desea enviar a realizar Evaluación SST?
  {!! Form::close() !!}
    
   <div class="hidden">
    
     <p> Lea con detenimiento el folleto de inducción en Seguridad y Salud en el Trabajo y responda las siguientes preguntas marcando la respuesta correcta. Tenga en cuenta que debe responder correctamente un mínimo de seis ( 6 ) preguntas para aprobar la evaluación. </p>
    
    <div class="col-md-12 form-group">
      <label for="inputEmail3" class="col-sm-12 control-label"> ¿Qué se busca con la implementación de la Política de Gestión Integral? </label>
        <div class="form-check">
         <input class="form-check-input" name="resp1" type="checkbox" value="a" id="opuno">
          <label class="form-check-label" for="opuno"> a. Obtener préstamos de entidades financieras para el crecimiento de la empresa. </label>
        </div>

        <div class="form-check">
         <input class="form-check-input" type="checkbox" name="resp1" id="opdos" value="b">
           <label class="form-check-label" for="opdos"> b. Imponer sanciones al personal que incumpla las normas de la empresa. </label>
        </div>

        <div class="form-check">
         <input class="form-check-input" type="checkbox" name="resp1" id="optres" value="c">
           <label class="form-check-label" for="optres"> c. Asegurar el bienestar laboral, la eficacia de las operaciones y
            la satisfacción de las empresas usuarias. </label>
        </div>

        <div class="form-check">
         <input class="form-check-input" type="checkbox" name="resp1" id="opcuatro" value="d">
           <label class="form-check-label" for="opcuatro"> d. Reducir costos y aumentar la rentabilidad de la empresa. </label>
        </div>

        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("fuentes_publicidad_id",$errors) !!}</p>
    </div>
    
      <div class="col-md-12 form-group">
       <label for="inputEmail3" class="col-sm-12 control-label"> ¿Qué es un accidente de trabajo? </label>
        
        <div class="form-check">
         <input class="form-check-input" name="resp2" type="checkbox" value="a" id="2opuno">
          <label class="form-check-label" for="2opuno"> a. Todo suceso repentino que sobrevenga por causa o con ocasión del trabajo, y que produzca en el trabajador una lesión orgánica, una perturbación funcional o psiquiátrica, una invalidez o la muerte. </label>
        </div>

        <div class="form-check">
         <input class="form-check-input" type="checkbox" name="resp2" id="2opdos" value="b">
           <label class="form-check-label" for="2opdos"> b. Aquel que se produce cuando el trabajador se traslada del trabajo a su vivienda en transporte público. </label>
        </div>

        <div class="form-check">
         <input class="form-check-input" type="checkbox" name="resp2" id="2optres" value="c">
           <label class="form-check-label" for="2optres"> c. Aquel que se produce en cumplimiento de las tareas asignadas por mis amigos del trabajo. </label>
        </div>

        <div class="form-check">
         <input class="form-check-input" type="checkbox" name="resp2" id="2opcuatro" value="d">
           <label class="form-check-label" for="2opcuatro"> d. Todas las anteriores. </label>
        </div>
       <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspecto_familiar",$errors) !!}</p>
      </div>
       
         <div class="col-md-12 form-group">
          <label for="inputEmail3" class="col-sm-12 control-label"> ¿Qué es una enfermedad laboral? </label>
                  
        <div class="form-check">
         <input class="form-check-input" name="resp3" type="checkbox" value="a" id="3opuno">
          <label class="form-check-label" for="3opuno"> a. Es un incidente que se presenta dentro y fuera del lugar de trabajo.</label>
        </div>

        <div class="form-check">
         <input class="form-check-input" type="checkbox" name="resp3" id="3opdos" value="b">
           <label class="form-check-label" for="3opdos"> b. La contraída como resultado de la exposición a factores de riesgo inherentes a la actividad laboral o del medio en el que el trabajador se ha visto obligado a trabajar </label>
        </div>

        <div class="form-check">
         <input class="form-check-input" type="checkbox" name="resp3" id="3optres" value="c">
           <label class="form-check-label" for="3optres"> c. Es una lesión que se presenta dentro del lugar de trabajo. </label>
        </div>

        <div class="form-check">
         <input class="form-check-input" type="checkbox" name="resp3" id="3opcuatro" value="d">
           <label class="form-check-label" for="3opcuatro"> d. Ninguna de las anteriores.. </label>
        </div>
            <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspecto_academico",$errors) !!}</p>
        </div>
      
    @if(route('home') != "https://temporizar.t3rs.co") 
        <div class="col-md-12 form-group">
         <label for="inputEmail3" class="col-sm-12 control-label"> ¿Cuál es el procedimiento a seguir en caso de accidente de trabajo? </label>
          <div class="form-check">
           <input class="form-check-input" name="resp4" type="checkbox" value="a" id="4opuno">
            <label class="form-check-label" for="4opuno"> a. Conservar la calma.</label>
          </div>

          <div class="form-check">
          <input class="form-check-input" type="checkbox" name="resp4" id="4opdos" value="b">
            <label class="form-check-label" for="4opdos"> b. La contraída como resultado de la exposición a factores de riesgo inherentes a la actividad laboral o del medio en el que el trabajador se ha visto obligado a trabajar </label>
          </div>

          <div class="form-check">
          <input class="form-check-input" type="checkbox" name="resp4" id="4optres" value="c">
            <label class="form-check-label" for="4optres"> c. Es una lesión que se presenta dentro del lugar de trabajo. </label>
          </div>

          <div class="form-check">
          <input class="form-check-input" type="checkbox" name="resp4" id="4opcuatro" value="d">
            <label class="form-check-label" for="4opcuatro"> d. Ninguna de las anteriores.. </label>
          </div>
            <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspectos_experiencia",$errors) !!}</p>
        </div>
       
        <div class="col-md-12 form-group">
         <label for="inputEmail3" class="col-sm-12 control-label"> ¿Qué significa la sigla EPP? </label>
             
          <div class="form-check">
           <input class="form-check-input" name="resp5" type="checkbox" value="a" id="5opuno">
            <label class="form-check-label" for="5opuno"> a. Elementos de Protección Personal </label>
          </div>

          <div class="form-check">
          <input class="form-check-input" type="checkbox" name="resp5" id="5opdos" value="b">
            <label class="form-check-label" for="5opdos"> b. Equipos de Producción de Plásticos. </label>
          </div>

          <div class="form-check">
          <input class="form-check-input" type="checkbox" name="resp5" id="5optres" value="c">
            <label class="form-check-label" for="5optres"> c. Elementos de Protección Colectiva. </label>
          </div>
            
            <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspectos_personalidad",$errors) !!}</p>
        </div>

        <div class="col-md-12 form-group">
          <label for="inputEmail3" class="col-sm-12 control-label"> ¿Cuál de los siguientes principios NO hace parte de la Política de Seguridad Vial? </label>
          
          <div class="form-check">
           <input class="form-check-input" name="resp6" type="checkbox" value="a" id="6opuno">
            <label class="form-check-label" for="6opuno"> a. Conducir más de 8 horas seguidas </label>
          </div>

          <div class="form-check">
           <input class="form-check-input" type="checkbox" name="resp6" id="6opdos" value="b">
            <label class="form-check-label" for="6opdos"> b. Se debe cumplir siempre con los límites de velocidad. </label>
          </div>

          <div class="form-check">
           <input class="form-check-input" type="checkbox" name="resp6" id="6optres" value="c">
            <label class="form-check-label" for="6optres"> c. Se debe verificar el buen funcionamiento del vehículo (carro o moto) antes de cada uso, y reportar novedades o fallas que presente el mismo. </label>
          </div>

          <div class="form-check">
           <input class="form-check-input" type="checkbox" name="resp6" id="6optres" value="d">
            <label class="form-check-label" for="6optres"> d. Está prohibido usar teléfono celular mientras se conduce </label>
          </div>

            <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("fortalezas_cargo",$errors) !!}</p>
        </div>
        
        <div class="col-md-12 form-group">
          <label for="inputEmail3" class="col-sm-12 control-label"> ¿Cuáles son las prohibiciones contenidas en la Política de prevención del consumo de alcohol, sustancias psicoactivas y tabaco? </label>
                     
          <div class="form-check">
           <input class="form-check-input" name="resp7" type="checkbox" value="a" id="7opuno">
            <label class="form-check-label" for="7opuno"> a. Tener un amigo dedicado a la venta de cigarrillos. </label>
          </div>

          <div class="form-check">
           <input class="form-check-input" type="checkbox" name="resp7" id="7opdos" value="b">
            <label class="form-check-label" for="7opdos"> b. Está prohibido presentarse al sitio de trabajo bajo la influencia de bebidas alcohólicas, sustancias psicoactivas, o que generen dependencia o alteren el normal estado de conciencia, el estado de ánimo, la percepción, la capacidad de reacción o que pueda influenciar negativamente en su conducta. </label>
          </div>

          <div class="form-check">
           <input class="form-check-input" type="checkbox" name="resp7" id="7optres" value="c">
            <label class="form-check-label" for="7optres"> c. Está prohibida la indebida utilización de medicamentos formulados o el uso, posesión, distribución, transporte o comercialización, tanto de bebidas alcohólicas, como de sustancias psicoactivas, o que generen dependencia o alteren el normal estado de conciencia, el estado de ánimo, la percepción y la capacidad de reacción, en funciones del trabajo, en actividades de carácter deportivo, recreativo o cultural, así como dentro de las instalaciones de la compañía, instalaciones de sus empresas usuarias o vehículos que estén al servicio de Soluciones Inmediatas S.A. o de sus empresas usuarias. </label>
          </div>

          <div class="form-check">
           <input class="form-check-input" type="checkbox" name="resp7" id="7optres" value="d">
            <label class="form-check-label" for="7optres"> d. b y c son verdaderas </label>
          </div>

           <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("oportunidad_cargo",$errors) !!}</p>
        </div>
      
    @endif

    <div class="col-md-12 form-group">
      <label for="inputEmail3" class="col-sm-12 control-label"> ¿Cuál de las siguientes NO es una responsabilidad de los trabajadores frente al Sistema de Gestión de la Seguridad y Salud en el Trabajo? </label>
          
          <div class="form-check">
           <input class="form-check-input" name="resp8" type="checkbox" value="a" id="8opuno">
            <label class="form-check-label" for="8opuno"> a. Suministrar información clara, veraz y completa de su estado de salud. </label>
          </div>

          <div class="form-check">
           <input class="form-check-input" type="checkbox" name="resp8" id="8opdos" value="b">
            <label class="form-check-label" for="8opdos"> b. Comprar o arrendar vivienda cerca a la sede de la empresa usuaria. </label>
          </div>

          <div class="form-check">
           <input class="form-check-input" type="checkbox" name="resp8" id="8optres" value="c">
            <label class="form-check-label" for="8optres"> c. Participar en las actividades y capacitaciones del Sistema de Gestión de la Seguridad y Salud en el Trabajo. </label>
          </div>

          <div class="form-check">
           <input class="form-check-input" type="checkbox" name="resp8" id="8optres" value="d">
            <label class="form-check-label" for="8optres"> d. Reportar inmediatamente cualquier incidente o accidente de trabajo que me ocurra. </label>
          </div>

          <div class="form-check">
           <input class="form-check-input" type="checkbox" name="resp8" id="8optres" value="e">
            <label class="form-check-label" for="8optres"> d. Reportar inmediatamente cualquier incidente o accidente de trabajo que me ocurra. </label>
          </div>

          <div class="form-check">
           <input class="form-check-input" type="checkbox" name="resp8" id="8optres" value="f">
            <label class="form-check-label" for="8optres"> e. Utilizar y mantener adecuadamente las instalaciones de la Empresa, los elementos de protección personal y los equipos de trabajo.</label>
          </div>

          <div class="form-check">
           <input class="form-check-input" type="checkbox" name="resp8" id="8optres" value="g">
            <label class="form-check-label" for="8optres"> g. Cumplir con las normas, reglamentos e instrucciones del Sistema de Gestión de la Seguridad y Salud en el Trabajo establecidas por la Ley, por la empresa y/o por el cliente.</label>
          </div>
         
         <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("resultado",$errors) !!}</p>
    </div>
  

                        <address class="hidden"> Yo _________________________________________________________,
                        identificado con Cédula de ciudadanía N°________________________,
                        dejo constancia de que recibí inducción en Seguridad y Salud en el Trabajo;
                        me permito informar que se me dieron a conocer Políticas del SGSST y
                        normas de seguridad. Entiendo que el objetivo de estas normas de
                        seguridad es el de evitar la ocurrencia de accidentes de trabajo y/o
                        enfermedades laborales.
                        Me comprometo a cumplir las normas de seguridad estipuladas y las que
                        estén definidas en la empresa usuaria donde labore, con el único propósito
                        de evitar que me ocurran accidentes a mí o a mis compañeros de trabajo; a
                        informar los accidentes de trabajo inmediatamente ocurran al supervisor,
                        jefe inmediato o encargado de SST de la empresa usuaria; a notificar
                        cualquier condición insegura que se presente en mi lugar de trabajo y a no
                        cometer actos inseguros que pongan en riesgo mi salud y mi vida. </address>


    <br>
   </div>

    <div class="clearfix"></div>

   {{--   <div class="col-sm-6 col-lg-6">
        <div class="form-group">
            <label for="trabajo-empresa-temporal" class="col-md-5 control-label">¿Asistió?:</label>
            <div class="col-md-7">
                {!! Form::checkbox("asistio",1,null,["class"=>"checkbox-preferencias" ]) !!}

            </div>
        </div>
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("apto",$errors) !!}</p>
    </div> --}}

    <div class="clearfix"></div>
    {!! Form::close() !!}
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
  <button type="button" class="btn btn-success" data-gestion="0" id="confirmar_evaluacion" >Confirmar</button>
</div>