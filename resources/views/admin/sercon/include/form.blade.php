<div class="clearfix"></div>
@if(Session::has("mensaje_success"))
    <div class="col-md-12" id="mensaje-resultado">
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{Session::get("mensaje_success")}}
        </div>
    </div>
@endif

<div class="row">
    <div class="col-md-6 form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Código:</label>       
        {!! Form::text("codigo",null,["class"=>"form-control","placeholder"=>"Código", "required" => "required"]); !!}
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("codigo",$errors) !!}</p>    
    </div>

    <div class="col-md-6 form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Descripción:</label>       
        {!! Form::text("descripcion",null,["class"=>"form-control","placeholder"=>"descripción", "required" => "required"]); !!}
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("descripcion",$errors) !!}</p>    
    </div>

    <div class="col-md-6 form-group">
        <label class="col-sm-2 control-label" for="cliente_id">Cliente:</label>

        {!! Form::select('cliente_id', $clientes, null, ['class' => 'form-control selectpicker', "data-live-search" => "true", "required" => "required"]) !!}

        <p class="error text-danger direction-botones-center" style="{{ ($errors->has('cliente_id') ? '' : 'display: none;') }}">
            {!! FuncionesGlobales::getErrorData("cliente_id", $errors) !!}
        </p>
    </div>

</div>

<div class="clearfix" ></div>