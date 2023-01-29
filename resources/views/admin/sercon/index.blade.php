@extends("admin.layout.master")
@section("contenedor")

{{-- Header --}}
@include('admin.layout.includes._section_header_breadcrumb', ['page_header' => 'Lista SERCON'])

@if(Session::has("mensaje_success"))
<div class="col-md-12" id="mensaje-resultado">
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{Session::get("mensaje_success")}}
    </div>
</div>
@endif
{!! Form::model(Request::all(),["id"=>"admin.sercon.index","method"=>"GET"]) !!}
<div class="row">
    <div class="col-md-6 form-group">
        <label for="cliente_id">Cliente:</label>
        
        {!! Form::select("cliente_id", $clientes, null, ["class" => "form-control selectpicker | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "id" => "cliente_id", "data-live-search" => "true"]); !!}
    </div>

    <div class="col-md-6 form-group">
        <label for="active">Estado:</label>
        
        {!! Form::select("active", ["" => "Seleccionar", "1" => "Activo", "0" => "Inactivo"] , null, ["class" => "form-control selectpicker | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "id" => "active"]); !!}
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-right">
        <button type="submit" class="btn btn-success | tri-px-2 tri-br-2 tri-border--none tri-transition-300 tri-green">
            Buscar <i aria-hidden="true" class="fa fa-search"></i>
        </button>

        <a class="btn btn-danger | tri-px-2 tri-br-2 tri-border--none tri-transition-300 tri-red" href="{{ route('admin.sercon.index') }}">
            Limpiar
        </a>

        {!! FuncionesGlobales::valida_boton_req("admin.sercon.nuevo","Nuevo","link","btn btn-success | tri-px-2 tri-br-2 tri-border--none tri-transition-300 tri-green") !!}

        {{--
        {!! FuncionesGlobales::valida_boton_req("admin.sercon.editar","Editar","link","btn btn-warning",'onclick="return conf_registro(\'id[]\', this)"') !!}

        {!! FuncionesGlobales::valida_boton_req("admin.sercon.cambiar_estado","Cambiar estado","link","btn btn-danger",'onclick="return redireccionar_registro(\'id[]\', this,\'url-cambiar-estado\')"') !!}
        --}}
    </div>
</div>
{!! Form::close() !!}

<div class="row">
    <div class="col-md-12 mt-2">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Cliente</th>
                            <th>Estado</th>
                            <th>Acción</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if($listas->count() == 0)
                        <tr>
                            <td colspan="5" class="text-center">No se encontraron registros</td>
                        </tr>
                        @endif
                        @foreach($listas as $lista)
                        <tr>
                            {{--
                            <td class="text-center">
                                {!! Form::checkbox("id[]",$lista->id,null,["data-url"=>route('admin.sercon.editar',["id"=>$lista->id]), "data-url-cambiar-estado"=>route('admin.sercon.cambiar_estado',["id"=>encrypt($lista->id)])]) !!}
                            </td>
                            --}}

                            <td class="text-center">
                                {{$lista->codigo}}
                            </td>
                            
                            <td class="text-center">
                                {{$lista->descripcion}}
                            </td>

                            <td class="text-center">
                                {{$lista->cliente}}
                            </td>

                            <td class="text-center">
                                @if($lista->active == 1)
                                <span class="label label-success">Activo</span>
                                @else
                                <span class="label label-danger">Inactivo</span>
                                @endif
                            </td>

                            <td>
                                {!! FuncionesGlobales::valida_boton_req(
                                    "admin.sercon.editar",
                                    "Editar",
                                    "link",
                                    "btn btn-primary | tri-br-2 tri-fs-12 tri-txt-purple tri-bg-white tri-bd-purple tri-transition-300 tri-hover-out-purple",
                                    '',
                                    "editar_$lista->id",
                                    ['id' => $lista->id]
                                ) !!}

                                {!! FuncionesGlobales::valida_boton_req(
                                    "admin.sercon.cambiar_estado",
                                    "Cambiar estado",
                                    "link",
                                    "btn btn-primary | tri-br-2 tri-fs-12 tri-txt-purple tri-bg-white tri-bd-purple tri-transition-300 tri-hover-out-purple",
                                    '',
                                    "cambiar_encrypt($lista->id)", ['id' => encrypt($lista->id)]
                                ) !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {!! $listas->appends(Request::all())->render() !!}
</div>
@stop