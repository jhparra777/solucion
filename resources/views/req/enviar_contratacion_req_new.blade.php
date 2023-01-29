@extends("req.modals._modal_plantilla")

@section("title")
  @if( count($candidato) > 0)
      <h4>
          <strong>
              Envío a contratación
          </strong>
      </h4>
      <h5>
          <strong>Candidato</strong> {{ $candidato->nombres." ".$candidato->primer_apellido}} | <strong>{{$candidato->tipo_id_desc}}</strong> {{$candidato->numero_id }}
      </h5>
  @elseif( count($candi_no_cumplen) > 0 )
      <h4>
          <strong>No se puede enviar a contratar al candidato</strong>
      </h4>
  @endif
@stop

@section("body")
  {!! Form::model(Request::all(),["id"=>"fr_contratar_req"]) !!}
  {!! Form::hidden("candidato_req",$candidato->req_candidato,["id"=>"candidato_req_fr"]) !!}
  {!! Form::hidden("cliente_id",null) !!}

    @if($contra_clientes != null)
      <div class="col-md-6 form-group">
        <label class="control-label"> Fecha Ingreso* </label>
        {!! Form::text ("fecha_inicio_contrato",$contra_clientes->fecha_ingreso_contra,["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300","id"=>"fecha_inicio_contrato"]); !!}
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("fecha_ingreso_contra",$errors) !!}</p>
      </div>

      <div class="col-md-6 form-group">
        <label for="inputEmail3" class="control-label"> Fecha Retiro* </label>
        {!! Form::text ("fecha_fin_contrato",$contra_clientes->fecha_fin_contrato,["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300","id"=>"fecha_fin_contrato"]); !!}
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("fecha_fin_contrato",$errors) !!}</p>
      </div>

      <div class="col-md-12 form-group">
        <label for="inputEmail3" class=" control-label"> Observaciones* </label>
        {!! Form::textarea("observaciones",$contra_clientes->observaciones,["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300","rows"=>'2']); !!}
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("observaciones",$errors) !!}</p>
      </div>

      <div class="col-md-6 form-group">
          <label for="inputEmail3" class="control-label"> Centro de costos* </label>
          {!! Form::select("centro_costos", $centros_costos, $contra_clientes->centro_costos, ["class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300","id" => "centro_costos"]); !!}
          <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("observaciones",$errors) !!}</p>
      </div>

      <div class="col-md-6 form-group">
          <label for="inputEmail3" class="control-label">Quién autorizó por parte del cliente* </label>
          {!! Form::select ("user_autorizacion",$usuarios_clientes,$contra_clientes->user_autorizacion,["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300"]); !!}
          <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("user_autorizacion",$errors) !!}</p>
      </div>
    @else

      <div class="col-md-6 form-group">
        <label class="control-label"> Fecha Ingreso* </label>
          {!! Form::text("fecha_inicio_contrato",null,["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300","id"=>"fecha_inicio_contrato"]); !!}
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("fecha_inicio_contrato",$errors) !!}</p>
      </div>
    
      <div class="col-md-6 form-group">
        <label class="control-label"> Fecha Retiro  * </label>
          {!! Form::text ("fecha_fin_contrato",null,["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300","id"=>"fecha_fin_contrato"]); !!}
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("fecha_fin_contrato",$errors) !!}</p>
      </div>    
      
      <div class="col-md-12 form-group">
          <label > Observaciones* </label>
          {!! Form::textarea("observaciones",null,["class"=>"form-control || tri-br-1 tri-fs-12 tri-input--focus tri-transition-300","rows"=>'2']);!!}
          <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("observaciones",$errors) !!}</p>
      </div>

      <div class="col-md-6 form-group">
        <label class="control-label"> Centro de costos* </label>
          {!! Form::select("centro_costos", $centros_costos, $requerimiento->centro_costo_id, ["class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300","id" => "centro_costos"]); !!}
          <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("observaciones",$errors) !!}</p>
      </div>
    

      <div class="col-md-6 form-group">
          <label class="control-label">Quién autorizó por parte del cliente* </label>
            {!! Form::select ("user_autorizacion",$usuarios_clientes,$user_id,["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300"]); !!}
          <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("user_autorizacion",$errors) !!}</p>
      </div>
    @endif
  
  {!! Form::close() !!}

  <div class="clearfix"></div>
  </div>
@stop

@section("footer")
  <button type="button" class="btn btn-success | tri-px-2 tri-br-2 tri-border--none tri-transition-200 tri-green" id="confirmar_contratacion" >Confirmar</button>
@stop

<script>

$(function () {

  var confDatepicker = {
   altFormat: "yy-mm-dd",
   dateFormat: "yy-mm-dd",
   changeMonth: true,
   changeYear: true,
   buttonImage: "img/gifs/018.gif",
   buttonImageOnly: true,
   autoSize: true,
   dayNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
   monthNamesShort: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
   dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
   yearRange: "1930:2050",
   minDate:new Date()
  };
    
    $("#fecha_fin_contrato, #fecha_inicio_contrato").datepicker(confDatepicker);

         jQuery(document).on('change', '#fecha_inicio_contrato', (event) => {
        const element = event.target;
        
        jQuery('#fecha_fin_contrato').datepicker('option', 'minDate', element.value);
    });


  });
</script>
